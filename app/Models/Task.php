<?php

namespace App\Models;

use App\Support\Tags;
use App\Support\TaskTagManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'deadline',
        'priority',
        'effort_level',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'completed_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tagAssignments(): HasMany
    {
        return $this->hasMany(TaskTag::class);
    }

    public function tags(): TaskTagManager
    {
        return new TaskTagManager($this);
    }

    /**
     * @return \Illuminate\Support\Collection<int, array{id:int,name:string,color:string,weight:int}>
     */
    public function getSystemTagsAttribute(): Collection
    {
        return $this->tags()->all();
    }

    /**
     * @return list<int>
     */
    public function getTagIdsAttribute(): array
    {
        return $this->tags()->ids();
    }

    public function hasTag(int|string $tagId): bool
    {
        return in_array((int) $tagId, $this->tagIds, true);
    }

    public function getTagWeightAttribute(): int
    {
        return array_sum(
            array_map(static fn (int $tagId) => Tags::weight($tagId), $this->tagIds)
        );
    }

    public function isCompleted(): bool
    {
        return $this->status === true;
    }

    public function isPending(): bool
    {
        return $this->status === false;
    }

    public function isOverdue(): bool
    {
        return $this->deadline && $this->deadline->isPast() && !$this->isCompleted();
    }

    public function getPriorityScoreAttribute(): float
    {
        $score = 0;

        // Deadline urgency (0-40 points)
        if ($this->deadline) {
            $hoursUntilDeadline = max(0, Carbon::now()->diffInHours($this->deadline, false));
            if ($hoursUntilDeadline <= 24) {
                $score += 40;
            } elseif ($hoursUntilDeadline <= 48) {
                $score += 30;
            } elseif ($hoursUntilDeadline <= 168) { // 7 days
                $score += 20;
            } else {
                $score += 10;
            }
        } else {
            $score += 15; // Default for tasks without deadline
        }

        // Priority weight (0-30 points)
        $priorityScores = [
            'high' => 30,
            'medium' => 20,
            'low' => 10,
        ];
        $score += $priorityScores[$this->priority] ?? 20;

        // Effort level penalty (0-30 points, easier tasks get more points)
        $effortScores = [
            'easy' => 30,
            'medium' => 20,
            'hard' => 10,
        ];
        $score += $effortScores[$this->effort_level] ?? 20;

        // Time of day adjustment
        $currentHour = Carbon::now()->hour;
        if ($currentHour >= 6 && $currentHour <= 12) {
            // Morning: favor hard tasks
            if ($this->effort_level === 'hard') {
                $score += 10;
            }
        } elseif ($currentHour >= 18 || $currentHour <= 22) {
            // Evening: favor easy tasks
            if ($this->effort_level === 'easy') {
                $score += 10;
            }
        }

        return $score;
    }

    public function getPriorityExplanationAttribute(): string
    {
        $explanations = [];

        if ($this->deadline) {
            $hoursUntilDeadline = max(0, Carbon::now()->diffInHours($this->deadline, false));
            if ($hoursUntilDeadline <= 24) {
                $explanations[] = 'High urgency - deadline within 24 hours';
            } elseif ($hoursUntilDeadline <= 48) {
                $explanations[] = 'Medium urgency - deadline within 48 hours';
            }
        }

        if ($this->priority === 'high') {
            $explanations[] = 'High priority task';
        }

        $currentHour = Carbon::now()->hour;
        if ($currentHour >= 6 && $currentHour <= 12 && $this->effort_level === 'hard') {
            $explanations[] = 'Fits your morning productivity pattern';
        } elseif (($currentHour >= 18 || $currentHour <= 22) && $this->effort_level === 'easy') {
            $explanations[] = 'Fits your evening productivity pattern';
        }

        return implode(' + ', $explanations) ?: 'Balanced priority score';
    }
}
