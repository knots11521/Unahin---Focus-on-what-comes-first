<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app-shell bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-sans antialiased overflow-x-hidden">
    <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-50 flex items-center gap-2">
        <a href="{{ route('about') }}"
            class="app-btn app-btn-ghost p-2 text-xs font-medium shadow-sm">
            About Us
        </a>

        <button onclick="toggleTheme()"
            class="app-btn app-btn-ghost p-2 shadow-sm">
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
            class="app-panel w-[calc(100%-2rem)] sm:max-w-[380px] px-6 py-8 sm:px-8 sm:py-9 shadow-xl z-10">
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
