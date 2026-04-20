<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');

            if (
                savedTheme === 'dark' ||
                (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="app-shell min-h-screen bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-sans transition-colors duration-300 antialiased">

    <div id="toast-container"></div>

    <div id="global-loader"
        class="fixed inset-0 bg-white/70 dark:bg-[#0d1117]/70 backdrop-blur-md z-[9999] flex items-center justify-center hidden">

        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-slate-300 border-t-brand-500 rounded-full animate-spin"></div>
            <p class="text-sm text-slate-600 dark:text-slate-300">Loading...</p>
        </div>
    </div>

    @auth
        <x-sidebar title="Unahin">
            <div class="flex flex-col h-full min-h-0">
                <div class="flex-1 min-h-0 overflow-y-auto p-6 lg:p-10">
                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast(@json(session('success')), 'success');
                            });
                        </script>
                    @endif

                    @if (session('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast(@json(session('error')), 'error');
                            });
                        </script>
                    @endif

                    @if (session('info'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast(@json(session('info')), 'info');
                            });
                        </script>
                    @endif

                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast(@json($errors->first()), 'error');
                            });
                        </script>
                    @endif

                    @yield('content')

                    <footer class="mt-20 pt-8 border-t sidebar-border pb-8 text-center text-slate-400 text-xs uppercase">
                        &copy; {{ date('Y') }} Unahin • Focus on what comes first.
                    </footer>
                </div>
            </div>

            <x-slot name="rightSidebar">
                <x-right-sidebar />
            </x-slot>
        </x-sidebar>
    @else
        <main
            class="app-shell min-h-screen w-full bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 transition-colors duration-300">
            <div class="w-full px-6 py-10 lg:px-10">
                @yield('content')
            </div>
        </main>
    @endauth

</body>

</html>
