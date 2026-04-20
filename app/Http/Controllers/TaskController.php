<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Support\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Auth::user()->tasks()->with('tagAssignments')->latest();

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->status === 'completed';
            $query->where('status', $status);
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereHas('tagAssignments', function ($q) use ($request) {
                $q->where('tag_id', (int) $request->tag);
            });
        }

        // Filter by deadline
        if ($request->filled('deadline')) {
            if ($request->deadline === 'overdue') {
                $query->where('deadline', '<', now())->where('status', false);
            } elseif ($request->deadline === 'today') {
                $query->whereDate('deadline', today());
            } elseif ($request->deadline === 'week') {
                $query->whereBetween('deadline', [now(), now()->addWeek()]);
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }

        $tasks = $query->paginate(10);
        $tags = Tags::all();

        return view('pages.tasks', compact('tasks', 'tags'));
    }

    public function create()
    {
        $tags = Tags::all();
        return view('pages.tasks.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date'],
            'priority' => ['required', 'in:low,medium,high'],
            'effort_level' => ['required', 'in:easy,medium,hard'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', Rule::in(Tags::ids())],
        ]);

        $task = Auth::user()->tasks()->create(Arr::except($validated, ['tags']));
        $task->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $task->load('tagAssignments');
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $tags = Tags::all();
        $task->load('tagAssignments');
        return view('pages.tasks.edit', compact('task', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date'],
            'priority' => ['required', 'in:low,medium,high'],
            'effort_level' => ['required', 'in:easy,medium,hard'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', Rule::in(Tags::ids())],
        ]);

        $task->update(Arr::except($validated, ['tags']));
        $task->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);

        $task->status = !$task->status;
        $task->completed_at = $task->status ? now() : null;
        $task->save();

        $message = $task->status ? 'Task marked as completed!' : 'Task marked as pending!';
        return redirect()->route('tasks.index')->with('success', $message);
    }
}
