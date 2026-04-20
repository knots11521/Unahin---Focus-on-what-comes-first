<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-sans antialiased overflow-x-hidden">
    <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-50 flex items-center gap-2">
        <a href="{{ route('about') }}"
            class="p-2 rounded-xl border sidebar-border bg-white/50 dark:bg-[#161b22]/50 backdrop-blur-md hover:bg-white dark:hover:bg-[#21262d] transition-all shadow-sm text-xs font-medium text-slate-600 dark:text-slate-400 hover:text-brand-500 dark:hover:text-brand-400">
            About Us
        </a>

        <button onclick="toggleTheme()"
            class="p-2 rounded-xl border sidebar-border bg-white/50 dark:bg-[#161b22]/50 backdrop-blur-md hover:bg-white dark:hover:bg-[#21262d] transition-all shadow-sm">
            <i data-lucide="sun" class="w-4 h-4 sm:w-5 sm:h-5 block dark:hidden text-slate-600"></i>
            <i data-lucide="moon" class="w-4 h-4 sm:w-5 sm:h-5 hidden dark:block text-slate-400"></i>
        </button>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center py-12 main-dotted-bg relative">
        <div class="mb-8 flex flex-col items-center">
            <a href="/" class="flex flex-col items-center gap-3 group text-center">
                <img src="{{ asset('images/unahin-logo.png') }}" alt="Unahin logo"
                    class="h-20 sm:h-24 w-auto drop-shadow-sm transition-transform group-hover:scale-105">
                <h1 class="text-2xl font-bold tracking-tight text-slate-800 dark:text-white">
                    Unahin
                </h1>
                <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-slate-400">
                    Focus on what comes first.
                </p>
            </a>
        </div>

        <div
            class="w-[calc(100%-2rem)] sm:max-w-[380px] px-6 py-8 sm:px-8 sm:py-9 bg-white/70 dark:bg-[#161b22]/70 backdrop-blur-md border sidebar-border shadow-xl rounded-[10px] z-10">
            @yield('content')
        </div>

        <footer class="mt-8 text-center px-4">
            <p class="text-[9px] text-slate-400 uppercase tracking-[0.2em] font-bold">
                &copy; {{ date('Y') }} Unahin • Focus on what comes first.
            </p>
        </footer>
    </div>
</body>

</html>
