@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto animate-reveal p-4 md:p-8">
    <header class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <i data-lucide="edit-3" class="w-8 h-8 text-brand-600"></i>
            Edit Task
        </h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Refine your task details and update your progress.</p>
    </header>

    <div class="bg-white dark:bg-[#161b22] border sidebar-border rounded-[10px] p-6 shadow-sm">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            @include('components.task-form', [
                'task' => $task,
                'submitIcon' => 'refresh-cw',
                'submitLabel' => 'Update Task',
            ])
        </form>
    </div>
</div>
@endsection
