@extends('layouts.app')

@section('content')
<div class="w-full max-w-5xl mx-auto animate-reveal p-4 md:p-8">
    <header class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <i data-lucide="user-cog" class="w-8 h-8 text-brand-600"></i>
                My Profile
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">
                Update your account details and keep your workspace identity up to date.
            </p>
        </div>

        <div class="app-card px-5 py-4">
            <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400 dark:text-slate-500">Account Snapshot</p>
            <div class="mt-3 space-y-2 text-sm">
                <div class="flex items-center justify-between gap-6">
                    <span class="text-slate-500 dark:text-slate-400">Total Tasks</span>
                    <span class="font-bold text-slate-900 dark:text-slate-100">{{ $user->tasks()->count() }}</span>
                </div>
                <div class="flex items-center justify-between gap-6">
                    <span class="text-slate-500 dark:text-slate-400">Completed</span>
                    <span class="font-bold text-teal-700 dark:text-teal-300">{{ $user->completedTasks()->count() }}</span>
                </div>
                <div class="flex items-center justify-between gap-6">
                    <span class="text-slate-500 dark:text-slate-400">Pending</span>
                    <span class="font-bold text-amber-600 dark:text-amber-300">{{ $user->pendingTasks()->count() }}</span>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 xl:grid-cols-[1.15fr_0.85fr] gap-6">
        <section class="app-card p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">Profile Details</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Change your display information here. Password updates are optional.
                </p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="app-input px-4 py-3 text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                        placeholder="Your full name">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="app-input px-4 py-3 text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                        placeholder="name@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="current_password" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                            Current Password
                        </label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="app-input px-4 py-3 text-slate-900 dark:text-slate-100"
                            placeholder="Required to change password">
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                            New Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="app-input px-4 py-3 text-slate-900 dark:text-slate-100"
                            placeholder="Leave blank to keep current password">
                        @error('password')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                        Confirm New Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="app-input px-4 py-3 text-slate-900 dark:text-slate-100"
                        placeholder="Repeat the new password">
                </div>

                <div class="pt-3 flex flex-col sm:flex-row gap-3">
                    <button
                        type="submit"
                        class="app-btn app-btn-primary inline-flex items-center justify-center gap-2 px-6 py-3 font-bold text-sm">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Save Changes
                    </button>
                    <a
                        href="{{ route('tasks.index') }}"
                        class="app-btn app-btn-ghost inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Back to Tasks
                    </a>
                </div>
            </form>
        </section>

        <aside class="space-y-6">
            <div class="app-panel p-6">
                <div class="app-icon-chip w-16 h-16 mb-4">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Account Security</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 leading-6">
                    Your current password is only needed when you want to set a new one. Leaving the password fields blank keeps it unchanged.
                </p>
            </div>

            <div class="app-card p-6">
                <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400 dark:text-slate-500">Workspace Identity</p>
                <div class="app-muted mt-4 p-4">
                    <p class="text-xs text-slate-500 dark:text-slate-400">Signed in as</p>
                    <p class="mt-1 text-lg font-bold text-slate-900 dark:text-slate-100 break-words">{{ $user->name }}</p>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 break-words">{{ $user->email }}</p>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
