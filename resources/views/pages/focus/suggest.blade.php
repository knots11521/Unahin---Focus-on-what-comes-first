@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto animate-reveal p-4 md:p-8">
    <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <i data-lucide="sparkles" class="w-8 h-8 text-teal-700 dark:text-teal-300"></i>
                What Should I Do?
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 max-w-xl">
                Based on your current tasks and productivity patterns, here are your top recommendations to focus on next.
            </p>
        </div>
    </header>

    @if($recommendations->count() > 0)
        <div class="space-y-6">
            @foreach($recommendations as $index => $recommendation)
                <div class="app-card group p-6 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="shrink-0">
                            <div class="app-icon-chip w-12 h-12 text-xl font-black">
                                {{ $index + 1 }}
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-1 leading-tight">
                                        {{ $recommendation['task']->title }}
                                    </h3>
                                    
                                    @if($recommendation['task']->description)
                                        <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 mb-4">
                                            {{ $recommendation['task']->description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-1 shrink-0">
                                    <a href="{{ route('tasks.edit', $recommendation['task']) }}" class="app-btn p-2 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 hover:text-brand-600 transition-colors" style="border-radius: var(--ui-radius);">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('tasks.destroy', $recommendation['task']) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="app-btn p-2 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-400 hover:text-red-600 transition-colors" style="border-radius: var(--ui-radius);" onclick="return confirm('Delete this task?')">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-y-3 gap-x-6 text-[11px] font-bold uppercase tracking-wider mb-6">
                                @if($recommendation['task']->deadline)
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5 {{ $recommendation['task']->isOverdue() ? 'text-red-500' : 'text-slate-400' }}"></i>
                                        <span class="{{ $recommendation['task']->isOverdue() ? 'text-red-500 font-black' : 'text-slate-500 dark:text-slate-400' }}">
                                            {{ $recommendation['task']->deadline->format('M j, Y') }}
                                            @if($recommendation['task']->isOverdue()) (Overdue) @endif
                                        </span>
                                    </div>
                                @endif

                                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                    <i data-lucide="flag" class="w-3.5 h-3.5 text-brand-500"></i>
                                    <span>{{ $recommendation['task']->priority }}</span>
                                </div>

                                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                    <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-600 dark:text-amber-300"></i>
                                    <span>{{ $recommendation['task']->effort_level }}</span>
                                </div>
                            </div>

                            <div class="app-muted p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Priority Score</span>
                                    <span class="text-lg font-black text-brand-600">{{ number_format($recommendation['score'], 1) }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <i data-lucide="info" class="w-4 h-4 text-brand-500 shrink-0 mt-0.5"></i>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-medium italic">
                                        "{{ $recommendation['explanation'] }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-center md:justify-start">
            <a href="{{ route('tasks.index') }}" class="app-btn app-btn-ghost flex items-center gap-2 px-6 py-3 font-bold text-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Dashboard
            </a>
        </div>
    @else
        <div class="app-panel text-center py-20 border-2 border-dashed">
            <div class="app-muted w-20 h-20 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="inbox" class="w-10 h-10 text-slate-300 dark:text-slate-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">No pending tasks</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-2 max-w-xs mx-auto">Create some tasks to get personalized focus recommendations!</p>
            <a href="{{ route('tasks.create') }}" class="app-btn app-btn-primary mt-6 inline-flex items-center gap-2 px-6 py-3 font-bold text-sm hover:scale-105 transition-transform">
                <i data-lucide="plus" class="w-4 h-4"></i> Create New Task
            </a>
        </div>
    @endif
</div>
@endsection
