@extends('layouts.app')

@section('content')
    {{-- ✅ BACK BUTTON (ONLY FOR GUEST / LOGOUT USERS) --}}
    @if (!auth()->check())
        <div class="mb-6">
            <a href="/"
                class="app-btn app-btn-ghost inline-flex items-center gap-2 px-4 py-2 text-sm font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back
            </a>
        </div>
    @endif

    <div class="w-full max-w-[1400px] mx-auto animate-reveal p-4 md:p-8 lg:p-12">
        <header class="mb-12">
            <div class="flex items-center gap-4 mb-3">
                <div class="app-icon-chip p-3">
                    <i data-lucide="users" class="w-8 h-8 text-brand-600"></i>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                    Meet the Team
                </h1>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-2xl">
                The team behind Unahin.
            </p>
        </header>

        <div class="flex flex-wrap gap-6 items-stretch">

            <div
                class="app-card flex-[2_1_400px] group p-8 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                <div class="flex flex-col h-full">
                    <div class="flex items-center gap-5 mb-6">
                        <div
                            class="app-btn app-btn-primary w-16 h-16 flex items-center justify-center text-white">
                            <i data-lucide="code-2" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">Nathaniel Dalisay</h3>
                            <p class="text-xs font-bold text-brand-600 uppercase tracking-[0.2em]">Lead Full-Stack Developer
                            </p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed text-base">
                        Full-stack architect specializing in Laravel and modern UI/UX. Nathaniel drives the technical vision
                        and ensures seamless integration between logic and design.
                    </p>
                    <div class="mt-auto pt-8 flex gap-2">
                        <span
                            class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Laravel
                            11</span>
                        <span
                            class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">System
                            Arch</span>
                    </div>
                </div>
            </div>

            <div
                class="app-panel flex-[1_1_300px] group p-8 transition-all">
                <div class="flex flex-col h-full">
                    <div class="app-btn app-btn-primary w-14 h-14 flex items-center justify-center text-white mb-6">
                        <i data-lucide="palette" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-2">Ayin Amorganda</h3>
                    <p class="text-xs font-bold text-brand-600 uppercase tracking-widest mb-4">UI/UX Designer</p>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Design visionary focused on minimalist aesthetics and user-centric flows.
                    </p>
                </div>
            </div>

            <div
                class="app-btn app-btn-primary flex-[1_1_100%] xl:flex-[1_1_350px] p-8 text-white shadow-2xl order-last xl:order-none">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                    <i data-lucide="sparkles" class="w-6 h-6"></i>
                    Overview
                </h3>
                <p class="text-brand-100 text-sm leading-relaxed mb-8 opacity-90">
                    Unahin is a focused task management system built to help you act on what comes first.
                </p>
                <div class="space-y-4">
                    <div class="app-panel bg-white/10 border-white/10 p-4 flex items-center gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-200"></i>
                        <span class="text-xs font-medium">Context Smart Logic</span>
                    </div>
                    <div class="app-panel bg-white/10 border-white/10 p-4 flex items-center gap-3">
                        <i data-lucide="layout" class="w-5 h-5 text-brand-200"></i>
                        <span class="text-xs font-medium">Bento Fluid Layout</span>
                    </div>
                </div>
            </div>

            <div class="app-card flex-[1_1_300px] p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="app-btn app-btn-ghost w-12 h-12 flex items-center justify-center text-slate-900 dark:text-white">
                        <i data-lucide="database" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">Jay Ann Molines</h3>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">DBA & QA</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Data guardian ensuring system integrity and performance through rigorous testing.
                </p>
            </div>

            <div class="app-panel flex-[2_1_500px] p-8">
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    <div>
                        <h3
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 text-center md:text-left">
                            Powering the App</h3>
                        <div class="flex flex-wrap gap-3">
                            <div
                                class="app-card px-4 py-2 flex items-center gap-2">
                                <i data-lucide="server" class="w-4 h-4 text-red-500"></i>
                                <span class="text-sm font-bold">Laravel 11</span>
                            </div>
                            <div
                                class="app-card px-4 py-2 flex items-center gap-2">
                                <i data-lucide="wind" class="w-4 h-4 text-sky-400"></i>
                                <span class="text-sm font-bold">Tailwind</span>
                            </div>
                        </div>
                    </div>
                    <div class="min-w-[120px]">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Velocity</span>
                            <span class="text-brand-600 font-bold text-xs">94%</span>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-brand-600 h-full rounded-full" style="width: 94%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
