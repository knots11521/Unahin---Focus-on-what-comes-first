@props(['title' => 'Studio Admin'])

<div class="flex h-screen w-full relative" id="container">
    <aside id="left-sidebar"
        class="w-64 bg-slate-50/60 dark:bg-[#010409]/75 border-r sidebar-border flex flex-col shrink-0 z-10 transition-all duration-300 relative backdrop-blur-md">

        <button onclick="toggleSidebar('left')"
            class="app-btn app-btn-ghost absolute -right-3 top-16 p-1 shadow-sm z-30 rounded-full">
            <i data-lucide="chevron-left" class="w-3 h-3"></i>
        </button>

        <div class="p-4 flex items-center gap-3">
            <img src="{{ asset('images/unahin-logo.png') }}" alt="{{ $title }} logo" class="h-12 w-auto shrink-0">
            <span class="font-semibold text-base tracking-tight whitespace-nowrap">{{ $title }}</span>
        </div>

        <nav class="flex-1 px-3 space-y-1 mt-4">
            @php
                $navItems = [
                    ['route' => 'tasks.index', 'icon' => 'file-text', 'label' => 'Tasks'],
                    ['route' => 'profile.edit', 'icon' => 'user-cog', 'label' => 'Profile'],
                    ['route' => 'focus.suggest', 'icon' => 'lightbulb', 'label' => 'Focus'],
                    ['route' => 'about', 'icon' => 'info', 'label' => 'About'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium border transition-all
                    {{ $isActive
                        ? 'app-badge-primary shadow-sm text-brand-600 dark:text-brand-400 font-bold'
                        : 'sidebar-border bg-transparent text-slate-600 dark:text-slate-400 hover:bg-white/80 dark:hover:bg-[#21262d] hover:text-slate-900' }}"
                    style="border-radius: var(--ui-radius);">
                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 {{ $isActive ? 'text-brand-600' : '' }}"></i>
                    <span class="whitespace-nowrap">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t sidebar-border space-y-2">
            <button onclick="toggleTheme()"
                class="app-btn app-btn-ghost flex items-center justify-between w-full px-3 py-2 text-xs font-medium">
                <span class="flex items-center gap-2">
                    <i data-lucide="sun" class="w-3.5 h-3.5 block dark:hidden"></i>
                    <i data-lucide="moon" class="w-3.5 h-3.5 hidden dark:block"></i>
                    Theme
                </span>
            </button>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="app-btn w-full flex items-center text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors px-3 py-2 border sidebar-border"
                        style="border-radius: var(--ui-radius);">
                        <i data-lucide="log-out" class="w-3.5 h-3.5 mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    <main class="flex-1 h-full overflow-y-auto no-scrollbar bg-white dark:bg-[#0d1117] main-dotted-bg relative">
        <button id="btn-left-expand" onclick="toggleSidebar('left')"
            class="app-btn app-btn-ghost hidden absolute left-4 top-4 p-2 shadow-sm z-20">
            <i data-lucide="menu" class="w-5 h-5 text-slate-500"></i>
        </button>

        <div class="flex h-full">
            <div class="flex-1 h-full overflow-y-auto no-scrollbar bg-white dark:bg-[#0d1117] main-dotted-bg relative">
                <div class="w-full h-full">
                    {{ $slot }}
                </div>
            </div>

            {{ $rightSidebar ?? '' }}
        </div>
    </main>
</div>
