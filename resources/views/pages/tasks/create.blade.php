@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto animate-reveal p-4 md:p-8">
    <header class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <i data-lucide="plus-circle" class="w-8 h-8 text-brand-600"></i>
            Create New Task
        </h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Fill in the details to add a new focus item to your list.</p>
    </header>

    <div class="bg-white dark:bg-[#161b22] border sidebar-border rounded-[10px] p-6 shadow-sm">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            @include('components.task-form', [
                'submitIcon' => 'save',
                'submitLabel' => 'Create Task',
            ])
        </form>
    </div>
</div>
@endsection
