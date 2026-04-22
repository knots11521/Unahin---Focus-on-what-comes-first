<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="app-shell min-h-screen w-screen
    bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100
    font-sans transition-colors duration-300 antialiased">

    <!-- Toast container -->
    <div id="toast-container"></div>

    <!-- Flash messages trigger -->
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

    <!-- Global loader -->
    <div id="global-loader"
        class="fixed inset-0 bg-white/70 dark:bg-[#0d1117]/70 backdrop-blur-md z-[9999] flex items-center justify-center hidden">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-slate-300 border-t-brand-500 rounded-full animate-spin"></div>
            <p class="text-sm text-slate-600 dark:text-slate-300">Loading...</p>
        </div>
    </div>

    <!-- App wrapper -->
    <div class="flex h-screen w-screen overflow-hidden">

        <!-- Left sidebar -->
        @include('components.sidebar')

        <!-- Main area -->
        <main class="flex-1 flex flex-col min-w-0 h-screen relative">

            <!-- Header -->
            <header
                class="flex items-center justify-between p-4 lg:px-8 h-20
                glass sticky top-0 z-30
                border-b border-slate-200 dark:border-slate-800">

                <div class="flex items-center gap-4">
                    <button id="toggle-left"
                        class="p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm border
                        border-slate-200 dark:border-slate-700 hover:text-indigo-600 transition-colors">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <h2 class="font-bold hidden sm:block">Overview</h2>
                </div>
            </header>

            <!-- Scrollable content -->
            <div class="flex-1 overflow-y-auto no-scrollbar p-0 sm:p-4 md:p-6 lg:p-10">
                @yield('content')
            </div>
        </main>

        <!-- Right sidebar -->
        @include('components.right-sidebar')

        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity">
        </div>

        <!-- Fab -->
        <button id="toggle-right"
            class="fixed bottom-6 right-6 z-[60] w-14 h-14 bg-indigo-600 text-white
            rounded-2xl shadow-xl shadow-indigo-600/30
            flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
            <i data-lucide="sidebar" class="w-6 h-6"></i>
            <span class="absolute top-3 right-3 w-3 h-3 bg-red-500 border-2 border-indigo-600 rounded-full"></span>
        </button>
    </div>
</body>

</html>
