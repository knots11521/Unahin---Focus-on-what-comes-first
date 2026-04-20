<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FocusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function suggest()
    {
        $user = Auth::user();
        $pendingTasks = $user->pendingTasks()->with('tagAssignments')->get();

        // ❌ No tasks at all fallback
        if ($pendingTasks->isEmpty()) {
            return redirect()->route('tasks.index')
                ->with('info', 'No pending tasks to suggest. Great job!');
        }

        // Calculate priority scores for each task
        $scoredTasks = $pendingTasks->map(function ($task) {
            return [
                'task' => $task,
                'score' => $this->calculatePriorityScore($task),
                'explanation' => $this->generateExplanation($task),
            ];
        });

        // Sort by score descending and take top 3
        $recommendedTasks = $scoredTasks
            ->sortByDesc('score')
            ->take(3)
            ->values();

        // ✅ NEW: fallback if recommendations become empty (edge case safety)
        if ($recommendedTasks->isEmpty()) {
            $recommendedTasks = $scoredTasks
                ->sortByDesc('score')
                ->take(3)
                ->values();
        }

        // 🟡 Final safety fallback (very rare edge case)
        if ($recommendedTasks->isEmpty()) {
            $recommendedTasks = $pendingTasks->take(3)->map(function ($task) {
                return [
                    'task' => $task,
                    'score' => 0,
                    'explanation' => '📌 Default suggestion (no scoring data available)',
                ];
            });
        }

        return view('pages.focus.suggest', [
            'recommendations' => $recommendedTasks,
            'currentHour' => Carbon::now()->hour,
        ]);
    }

    private function calculatePriorityScore(Task $task): float
    {
        $score = 0;

        // Deadline urgency (0-40 points)
        if ($task->deadline) {
            $hoursUntilDeadline = max(0, Carbon::now()->diffInHours($task->deadline, false));

            if ($hoursUntilDeadline <= 6) {
                $score += 40;
            } elseif ($hoursUntilDeadline <= 24) {
                $score += 35;
            } elseif ($hoursUntilDeadline <= 48) {
                $score += 25;
            } elseif ($hoursUntilDeadline <= 168) {
                $score += 15;
            } else {
                $score += 5;
            }
        } else {
            $score += 10;
        }

        // Priority weight (0-30 points)
        $priorityScores = [
            'high' => 30,
            'medium' => 20,
            'low' => 10,
        ];
        $score += $priorityScores[$task->priority] ?? 20;

        // Effort level (0-30 points)
        $effortScores = [
            'easy' => 30,
            'medium' => 20,
            'hard' => 10,
        ];
        $score += $effortScores[$task->effort_level] ?? 20;

        // Time of day boost
        $currentHour = Carbon::now()->hour;

        if ($currentHour >= 6 && $currentHour <= 12) {
            if ($task->effort_level === 'hard') {
                $score += 15;
            } elseif ($task->effort_level === 'medium') {
                $score += 5;
            }
        } elseif ($currentHour > 12 && $currentHour < 18) {
            if ($task->effort_level === 'medium') {
                $score += 10;
            }
        } elseif ($currentHour >= 18 && $currentHour <= 22) {
            if ($task->effort_level === 'easy') {
                $score += 15;
            } elseif ($task->effort_level === 'medium') {
                $score += 5;
            }
        }

        // Overdue boost
        if ($task->deadline && $task->deadline->isPast()) {
            $score += 20;
        }

        return $score;
    }

    private function generateExplanation(Task $task): string
    {
        $reasons = [];

        if ($task->deadline) {
            $hoursUntilDeadline = max(0, Carbon::now()->diffInHours($task->deadline, false));

            if ($hoursUntilDeadline <= 6) {
                $reasons[] = '🔥 Critical - due within 6 hours';
            } elseif ($hoursUntilDeadline <= 24) {
                $reasons[] = '⚡ High urgency - due within 24 hours';
            } elseif ($hoursUntilDeadline <= 48) {
                $reasons[] = '⏰ Due within 48 hours';
            }
        }

        if ($task->priority === 'high') {
            $reasons[] = '🎯 High priority task';
        }

        $currentHour = Carbon::now()->hour;

        if ($currentHour >= 6 && $currentHour <= 12 && $task->effort_level === 'hard') {
            $reasons[] = '🌅 Perfect for morning focus';
        } elseif ($currentHour >= 18 && $currentHour <= 22 && $task->effort_level === 'easy') {
            $reasons[] = '🌙 Ideal for evening wind-down';
        }

        if ($task->deadline && $task->deadline->isPast()) {
            $reasons[] = '⚠️ Overdue - needs immediate attention';
        }

        if ($task->effort_level === 'easy') {
            $reasons[] = '⚡ Quick win - can be completed fast';
        }

        return implode(' + ', $reasons) ?: 'Balanced priority score';
    }
}
