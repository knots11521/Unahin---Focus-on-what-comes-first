@extends('layouts.guest')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Create Account</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">Join Unahin and start with what matters most.</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name"
                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                class="w-full px-4 py-2.5 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                placeholder="Nathaniel Dalisay">
            @error('name')
                <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email"
                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                Email Address <span class="text-red-500">*</span>
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2.5 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                placeholder="nathaniel@example.com">
            @error('email')
                <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password"
                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2.5 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all"
                    placeholder="••••••••">
            </div>
            <div>
                <label for="password_confirmation"
                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                    Confirm <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2.5 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all"
                    placeholder="••••••••">
            </div>
        </div>
        @error('password')
            <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $message }}</p>
        @enderror

        <div class="pt-4">
            <button type="submit"
                class="w-full py-3 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-[12px] shadow-lg shadow-brand-500/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                CREATE ACCOUNT
            </button>
        </div>

        <div class="mt-6 pt-6 border-t sidebar-border text-center">
            <p class="text-sm text-slate-500">
                Already have an account?
                <a href="{{ route('login') }}"
                    class="font-bold text-brand-500 hover:text-brand-600 ml-1 transition-colors">Login here</a>
            </p>
        </div>
    </form>
@endsection
