<div class="w-full max-w-[1400px] mx-auto animate-reveal p-4 md:p-8 lg:p-12">
    {{-- BACK BUTTON --}}
    @if (Route::currentRouteName() !== 'index')
        <div class="mb-6">
            <a href="{{ route('login') }}"
                class="app-btn app-btn-ghost inline-flex items-center gap-2 px-4 py-2 text-sm font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back
            </a>
        </div>
    @endif

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

        {{-- nat2 --}}
        <div class="app-card flex-[2_1_400px] group p-8 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
            <div class="flex flex-col h-full">
                <div class="flex items-center gap-5 mb-6">
                    <div class="app-btn app-btn-primary w-16 h-16 flex items-center justify-center text-white">
                        <i data-lucide="code-2" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">Nathaniel Dalisay</h3>
                        <p class="text-xs font-bold text-brand-600 uppercase tracking-[0.2em]">
                            Lead Full-Stack Developer
                        </p>
                    </div>
                </div>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed text-base">
                    Full-stack architect specializing in Laravel and modern UI/UX. Drives the technical vision
                    and ensures seamless integration between logic and design.
                </p>
                <div class="mt-auto pt-8 flex gap-2">
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Laravel 11</span>
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">System Arch</span>
                </div>
            </div>
        </div>

        {{-- ayin --}}
        <div class="app-card flex-[1_1_300px] group p-8 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
            <div class="flex flex-col h-full">
                <div class="flex items-center gap-5 mb-6">
                    <div class="app-btn app-btn-primary w-14 h-14 flex items-center justify-center text-white">
                        <i data-lucide="palette" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Ayin Amorganda</h3>
                        <p class="text-xs font-bold text-brand-600 uppercase tracking-widest">UI/UX Designer</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Design visionary focused on minimalist aesthetics and user-centric flows.
                </p>
                <div class="mt-auto pt-8 flex gap-2">
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">UI Design</span>
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">UX Flow</span>
                </div>
            </div>
        </div>

        {{-- Jay Ann --}}
        <div class="app-card flex-[1_1_300px] group p-8 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
            <div class="flex flex-col h-full">
                <div class="flex items-center gap-5 mb-6">
                    <div class="app-btn app-btn-primary w-14 h-14 flex items-center justify-center text-white">
                        <i data-lucide="database" class="w-7 h-7"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Jay Ann Molines</h3>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">DBA & QA</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Data guardian ensuring system integrity and performance through rigorous testing.
                </p>
                <div class="mt-auto pt-8 flex gap-2">
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Database</span>
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Testing</span>
                </div>
            </div>
        </div>

        {{-- Haji --}}
        <div class="app-card flex-[1_1_300px] group p-8 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
            <div class="flex flex-col h-full">
                <div class="flex items-center gap-5 mb-6">
                    <div class="app-btn app-btn-primary w-14 h-14 flex items-center justify-center text-white">
                        <i data-lucide="cpu" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Haji Sanches</h3>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                            Backend Support Engineer
                        </p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Supports backend logic and system optimization, helping maintain performance and reliability across
                    core features.
                </p>
                <div class="mt-auto pt-8 flex gap-2">
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Backend</span>
                    <span class="app-muted px-3 py-1 text-[10px] font-bold uppercase text-slate-500">Optimization</span>
                </div>
            </div>
        </div>

        {{-- System Overview --}}
        <div
            class="app-btn app-btn-primary flex-[1_1_100%] xl:flex-[1_1_350px] p-8 text-white shadow-2xl order-last xl:order-none">

            <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                <i data-lucide="sparkles" class="w-6 h-6"></i>
                Overview
            </h3>

            {{-- FEATURE CARDS --}}
            <div class="grid grid-cols-1 gap-4">

                {{-- CARD 1 --}}
                <div class="app-panel bg-white/10 border-white/10 p-4 flex items-start gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-200 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-semibold">Task Creation & Organization</p>
                        <p class="text-[11px] opacity-80">
                            Create and organize tasks with structured inputs, categorized using consistent system tags.
                        </p>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="app-panel bg-white/10 border-white/10 p-4 flex items-start gap-3">
                    <i data-lucide="brain" class="w-5 h-5 text-brand-200 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-semibold">Focus Suggestion</p>
                        <p class="text-[11px] opacity-80">
                            Recommends what to prioritize based on urgency, effort, and task data.
                        </p>
                    </div>
                </div>

                {{-- CARD 3 --}}
                <div class="app-panel bg-white/10 border-white/10 p-4 flex items-start gap-3">
                    <i data-lucide="layout" class="w-5 h-5 text-brand-200 mt-0.5"></i>
                    <div>
                        <p class="text-xs font-semibold">System & Experience</p>
                        <p class="text-[11px] opacity-80">
                            Full CRUD functionality with a clean and guided UX designed for clarity and minimal
                            friction.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="app-card flex-[2_1_500px] p-8">
            <div class="flex flex-col md:flex-row justify-between items-end gap-8 w-full">

                {{-- LEFT: TITLE + MAIN STACK --}}
                <div class="flex-1 w-full">
                    <h3
                        class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-5 text-center md:text-left">
                        Powering the App
                    </h3>

                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <div class="group flex items-center gap-3 bg-slate-50 dark:bg-slate-900/50 px-4 py-2.5 transition-all duration-300 hover:bg-white dark:hover:bg-slate-800 shadow-[sm] hover:shadow-md"
                            style="border-radius: 5px; border: 1px solid rgba(226, 232, 240, 0.4);">
                            <i data-lucide="server"
                                class="w-4 h-4 text-red-500 transition-transform group-hover:scale-110"></i>
                            <span class="text-sm font-bold tracking-tight text-slate-700 dark:text-slate-200">Laravel
                                11</span>
                        </div>

                        <div class="group flex items-center gap-3 bg-slate-50 dark:bg-slate-900/50 px-4 py-2.5 transition-all duration-300 hover:bg-white dark:hover:bg-slate-800 shadow-[sm] hover:shadow-md"
                            style="border-radius: 5px; border: 1px solid rgba(226, 232, 240, 0.4);">
                            <i data-lucide="wind"
                                class="w-4 h-4 text-sky-400 transition-transform group-hover:rotate-12"></i>
                            <span class="text-sm font-bold tracking-tight text-slate-700 dark:text-slate-200">Tailwind
                                CSS</span>
                        </div>

                        <div class="group flex items-center gap-3 bg-slate-50 dark:bg-slate-900/50 px-4 py-2.5 transition-all duration-300 hover:bg-white dark:hover:bg-slate-800 shadow-[sm] hover:shadow-md"
                            style="border-radius: 5px; border: 1px solid rgba(226, 232, 240, 0.4);">
                            <i data-lucide="layers"
                                class="w-4 h-4 text-indigo-500 transition-transform group-hover:-translate-y-1"></i>
                            <span class="text-sm font-bold tracking-tight text-slate-700 dark:text-slate-200">MVC
                                Architecture</span>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: PRINCIPLE --}}
                <div class="w-full md:w-auto min-w-[240px]">
                    <div class="space-y-3">
                        <span
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] block text-center md:text-right">
                            System Principle
                        </span>

                        <div class="relative overflow-hidden bg-blue-600 dark:bg-blue-700 p-[1px]"
                            style="border-radius: 5px;">
                            <div class="bg-white dark:bg-slate-950 px-5 py-4 flex items-center justify-center gap-3"
                                style="border-radius: 4px;">
                                <div class="h-1.5 w-1.5 rounded-full bg-blue-600 animate-pulse"></div>
                                <p
                                    class="text-sm font-bold italic text-slate-800 dark:text-slate-100 whitespace-nowrap">
                                    "Focus on what comes first."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
