<aside id="left-sidebar"
    class="sidebar-transition fixed inset-y-0 left-0 z-50 w-72

    -translate-x-full lg:translate-x-0   <!-- 🔥 FIX: proper default state -->

    transition-transform duration-300 ease-in-out

    lg:static

    bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800
    flex-shrink-0">

    <div class="flex flex-col h-full w-72 p-6">

        {{-- LOGO --}}
        <div class="flex items-center gap-3 mb-10">
            <div class="w-10 h-10 bg-indigo-600 rounded-[5px] flex items-center justify-center text-white shadow-lg">
                <img src="{{ asset('images/unahin-logo.png') }}" alt="Unahin Logo" class="w-6 h-6 object-contain">
            </div>

            <span class="font-black text-xl tracking-tight">Unahin</span>
        </div>

        {{-- NAVIGATION --}}
        <nav class="space-y-2 flex-1">

            @php
                $navItems = [
                    ['route' => 'tasks.index', 'icon' => 'file-text', 'label' => 'Tasks'],
                    ['route' => 'focus.suggest', 'icon' => 'lightbulb', 'label' => 'Focus'],
                    ['route' => 'profile.edit', 'icon' => 'user-cog', 'label' => 'Profile'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp

                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-[5px] font-semibold transition-all
                    {{ $isActive
                        ? 'bg-indigo-600 text-white shadow-md'
                        : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">

                    <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach

        </nav>

        {{-- FOOTER --}}
        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 space-y-3">

            {{-- THEME TOGGLE --}}
            <button onclick="toggleTheme()"
                class="flex items-center gap-3 w-full px-4 py-3 rounded-[5px] text-sm font-medium
                text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">

                <i data-lucide="sun" class="w-5 h-5 block dark:hidden"></i>
                <i data-lucide="moon" class="w-5 h-5 hidden dark:block"></i>

                Theme
            </button>

            {{-- LOGOUT --}}
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-3 rounded-[5px] text-sm font-medium
                        text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all">

                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            @endauth

        </div>

    </div>
</aside>
