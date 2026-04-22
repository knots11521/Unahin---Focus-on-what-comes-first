<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="app-shell bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-sans antialiased overflow-x-hidden transition-colors duration-300 flex flex-col min-h-screen">

    <!-- ✅ Navigation -->
    <nav
        class="fixed top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur-md dark:border-slate-800 dark:bg-slate-950/80">
        <div class="w-full max-w-[1400px] mx-auto flex h-16 items-center justify-between p-4 md:p-8 lg:px-12">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/unahin-logo.png') }}" alt="Logo" class="h-8 w-auto">
                <span class="text-xl font-bold tracking-tight">Unahin</span>
            </div>

            <div class="flex items-center gap-4">
                <button onclick="toggleTheme()"
                    class="app-btn app-btn-ghost p-2 shadow-sm rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i data-lucide="sun" class="w-4 h-4 sm:w-5 sm:h-5 block dark:hidden text-slate-600"></i>
                    <i data-lucide="moon" class="w-4 h-4 sm:w-5 sm:h-5 hidden dark:block text-slate-400"></i>
                </button>

                <div class="hidden items-center gap-4 sm:flex">
                    <a href="{{ route('login') }}" class="text-sm font-semibold">Login</a>
                    <a href="{{ route('register') }}"
                        class="app-btn app-btn-primary px-5 py-2 text-sm font-bold text-white transition-transform hover:scale-105">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ✅ Main Content -->
    <main class="flex-grow pt-16">
        <!-- 🔹 Hero Section -->
        <section class="w-full max-w-[1400px] mx-auto min-h-[80vh] flex items-center p-4 md:p-8 lg:p-12 animate-reveal">
            <div class="flex flex-col items-center gap-12 lg:flex-row w-full">

                <!-- Hero Text -->
                <div class="w-full space-y-8 lg:w-1/2 text-left">
                    <div class="space-y-6">
                        <h1 class="text-5xl font-black leading-tight sm:text-7xl">
                            Prioritize what <br>
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-500 bg-clip-text text-transparent">
                                comes first.
                            </span>
                        </h1>
                        <p class="max-w-lg text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                            Unahin is a modern task management system that guides your workflow.
                            Using our unique <span class="font-bold text-slate-900 dark:text-white">Focus
                                Suggestion</span>
                            feature, we analyze your deadlines and effort levels to show you exactly what to work on
                            right now.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('login') }}"
                            class="app-btn app-btn-primary px-8 py-4 font-bold text-white shadow-xl shadow-blue-500/20 transition-all">
                            Start Organizing
                        </a>
                        <div class="flex items-center gap-2 px-4 py-4 text-sm font-medium text-slate-500">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-500"></i>
                            Built with Laravel MVC
                        </div>
                    </div>
                </div>

                <div class="relative flex w-full justify-center lg:w-1/2 hidden sm:flex group">
                    <div
                        class="absolute -z-10 h-80 w-80 rounded-full bg-blue-500/10 blur-[120px] dark:bg-blue-600/5 transition-all duration-1000 group-hover:scale-150 group-hover:bg-blue-400/20">
                    </div>

                    <div class="relative flex h-64 w-64 items-center justify-center sm:h-80 sm:w-80 animate-float">

                        <img src="{{ asset('images/unahin-logo.png') }}" alt="Unahin System"
                            class="h-full w-full object-contain transition-all duration-700 ease-out 
                   drop-shadow-[0_10px_10px_rgba(0,0,0,0.1)] 
                   group-hover:scale-110 
                   group-hover:-rotate-3 
                   group-hover:drop-shadow-[0_35px_35px_rgba(59,130,246,0.3)]">

                        <div class="absolute inset-0 -z-10 scale-50 opacity-0 transition-all duration-700 group-hover:scale-100 group-hover:opacity-100"
                            style="background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);">
                        </div>
                    </div>

                    <style>
                        @keyframes float {

                            0%,
                            100% {
                                transform: translateY(0px) rotate(0deg);
                            }

                            50% {
                                transform: translateY(-25px) rotate(1.5deg);
                            }
                        }

                        .animate-float {
                            animation: float 6s ease-in-out infinite;
                        }
                    </style>
                </div>
            </div>
        </section>

        <!-- 🔹 About Section -->
        <x-about-page />
    </main>

    <!-- ✅ Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md">
        <div class="w-full max-w-[1400px] mx-auto py-6 px-4 text-center">
            <p class="text-[11px] text-slate-500 dark:text-slate-400 uppercase tracking-[0.2em] font-bold">
                &copy; {{ date('Y') }} Unahin • Focus on what comes first.
            </p>
        </div>
    </footer>
</body>

</html>
