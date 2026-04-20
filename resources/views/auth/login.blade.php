@extends('layouts.guest')

@section('content')
    <div class="mb-8">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Welcome Back</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">Please enter your details to sign in.</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="email"
                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                Email Address <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all placeholder:text-slate-400"
                    placeholder="nathaniel@example.com">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password"
                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    Password <span class="text-red-500">*</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs font-bold text-brand-500 hover:text-brand-600 transition-colors">
                        Forgot?
                    </a>
                @endif
            </div>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-3 rounded-[12px] border sidebar-border bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all"
                placeholder="••••••••">
            @error('password')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="remember"
                    class="w-4 h-4 rounded border-slate-300 text-brand-500 focus:ring-brand-500 transition-all">
                <span
                    class="text-sm text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300 transition-colors">Remember
                    me</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full py-3.5 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-[14px] shadow-lg shadow-brand-500/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-4 h-4"></i>
                SIGN IN
            </button>
        </div>

        <div class="mt-8 pt-6 border-t sidebar-border text-center">
            <p class="text-sm text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="font-bold text-brand-500 hover:text-brand-600 ml-1 transition-colors">Register here</a>
            </p>
        </div>
    </form>
@endsection
