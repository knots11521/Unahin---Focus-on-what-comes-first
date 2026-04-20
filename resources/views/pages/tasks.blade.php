@extends('layouts.app')

@section('content')
<div class="w-full max-w-[1400px] mx-auto animate-reveal p-4 md:p-8">
    <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="min-w-0">
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight">
                My Tasks
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Manage your workflow and focus areas.</p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('focus.suggest') }}" class="app-btn app-btn-soft flex items-center gap-2 px-4 py-2.5 font-bold text-sm">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                Suggest Task
            </a>
            <a href="{{ route('tasks.create') }}" class="app-btn app-btn-primary flex items-center gap-2 px-5 py-2.5 font-bold text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Task
            </a>
        </div>
    </header>

    <div class="app-panel p-4 mb-8">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="flex-[2_1_300px] relative group">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-brand-600 transition-colors"></i>
                <input type="text" name="search" placeholder="Quick search tasks..." value="{{ request('search') }}" onkeyup="searchTasks(event)"
                    class="app-input pl-11 pr-4 py-2.5 text-sm dark:text-white">
            </div>

            <div class="flex-[1_1_160px]">
                <select name="status" onchange="filterTasks(this)" class="app-input px-4 py-2.5 text-sm dark:text-slate-300">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="flex-[1_1_160px]">
                <select name="tag" onchange="filterTasks(this)" class="app-input px-4 py-2.5 text-sm dark:text-slate-300">
                    <option value="">All Tags</option>
                    @foreach($tags as $id => $name)
                        <option value="{{ $id }}" {{ request('tag') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-[1_1_160px]">
                <select name="deadline" onchange="filterTasks(this)" class="app-input px-4 py-2.5 text-sm dark:text-slate-300">
                    <option value="">All Deadlines</option>
                    <option value="overdue" {{ request('deadline') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                    <option value="today" {{ request('deadline') === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('deadline') === 'week' ? 'selected' : '' }}>This Week</option>
                </select>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($tasks as $task)
            <div class="app-card group p-5 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                <div class="flex flex-wrap md:flex-nowrap items-start gap-4">
                    <div class="pt-1">
                        <input type="checkbox" {{ $task->status ? 'checked' : '' }} onchange="toggleTask({{ $task->id }})" 
                            class="w-5 h-5 border-2 border-slate-300 dark:border-slate-700 text-brand-600 focus:ring-brand-500/20 transition-all cursor-pointer"
                            style="border-radius: 5px;">
                    </div>

                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold truncate transition-all {{ $task->status ? 'line-through text-slate-400' : 'text-slate-800 dark:text-slate-100' }}">
                            {{ $task->title }}
                        </h3>
                        
                        @if($task->description)
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-1">
                                {{ $task->description }}
                            </p>
                        @endif

                        <div class="flex flex-wrap items-center gap-y-3 gap-x-6 mt-4">
                            @if($task->deadline)
                                <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 {{ $task->isOverdue() ? 'text-red-500' : 'text-slate-400' }}"></i>
                                    <span class="{{ $task->isOverdue() ? 'text-red-500' : 'text-slate-500 dark:text-slate-400' }}">
                                        {{ $task->deadline->format('M j, Y') }}
                                        @if($task->isOverdue()) <span class="app-badge app-badge-danger ml-1 px-1.5 py-0.5 text-[9px]">Overdue</span> @endif
                                    </span>
                                </div>
                            @endif

                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-600 dark:text-amber-300"></i>
                                <span>{{ $task->priority }}</span>
                            </div>

                            @if($task->systemTags->count() > 0)
                                <div class="flex items-center gap-2">
                                    <i data-lucide="tag" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <div class="flex gap-1">
                                        @foreach($task->systemTags as $tag)
                                            <span class="text-[10px] px-2 py-0.5 border font-semibold" style="background-color: {{ $tag['color'] }}1a; color: {{ $tag['color'] }}; border-color: {{ $tag['color'] }}33; border-radius: 5px;">
                                                {{ $tag['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('tasks.edit', $task) }}" class="app-btn p-2 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 hover:text-brand-600 transition-colors" style="border-radius: var(--ui-radius);">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="app-btn p-2 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-400 hover:text-red-600 transition-colors" style="border-radius: var(--ui-radius);" onclick="return confirm('Delete this task?')">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="app-panel text-center py-20 border-2 border-dashed">
                <div class="app-muted w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="inbox" class="w-10 h-10 text-slate-300 dark:text-slate-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">No tasks found</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-2 max-w-xs mx-auto">Clear your filters or start fresh with a new entry.</p>
                <a href="{{ route('tasks.create') }}" class="app-btn app-btn-primary mt-6 inline-flex items-center gap-2 px-6 py-3 font-bold text-sm hover:scale-105 transition-transform">
                    <i data-lucide="plus" class="w-4 h-4"></i> Create First Task
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $tasks->links() }}
    </div>
</div>

<script>
function filterTasks(select) {
    const url = new URL(window.location);
    url.searchParams.set(select.name, select.value);
    window.location = url.toString();
}

function searchTasks(event) {
    if (event.key === 'Enter') {
        const url = new URL(window.location);
        url.searchParams.set('search', event.target.value);
        window.location = url.toString();
    }
}

function toggleTask(taskId) {
    fetch(`/tasks/${taskId}/toggle`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(() => window.location.reload())
    .catch(err => console.error('Toggle failed:', err));
}
</script>
@endsection
