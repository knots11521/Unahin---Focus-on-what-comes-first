<section id="right-sidebar"
    class="w-80 lg:w-96 bg-slate-50/50 dark:bg-[#010409]/75 border-l sidebar-border h-full flex flex-col p-6 shrink-0 z-10 transition-[width,padding] duration-300 relative backdrop-blur-md">

    <!-- FAB TOGGLE BUTTON -->
    <button id="btn-right-toggle" onclick="toggleSidebar('right')"
        class="app-btn app-btn-accent fixed bottom-6 right-6 p-3 rounded-full z-50 active:scale-95">
        <i id="icon-right-toggle" data-lucide="panel-right" class="w-5 h-5"></i>
    </button>

    <div class="flex items-center justify-between mb-8 px-2">
        <h2 class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest whitespace-nowrap">
            Quick Stats
        </h2>
    </div>

    <div class="space-y-4 overflow-y-auto no-scrollbar overflow-x-hidden">
        @auth
            <div class="app-card p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Completion Rate</span>
                    <span class="text-sm font-bold text-teal-700 dark:text-teal-300">
                        {{ Auth::user()->completion_progress ?? 0 }}%
                    </span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full">
                    <div class="bg-teal-700 dark:bg-teal-400 h-2 rounded-full transition-all duration-500"
                        style="width: {{ Auth::user()->completion_progress ?? 0 }}%"></div>
                </div>
            </div>

            <div class="app-card p-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Today's Activity</h3>
                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="app-muted p-2">
                        <div class="text-lg font-bold text-teal-700 dark:text-teal-300">
                            {{ Auth::user()->completedTasksToday() }}
                        </div>
                        <div class="text-[10px] text-slate-500 uppercase font-medium">Completed</div>
                    </div>
                    <div class="app-muted p-2">
                        <div class="text-lg font-bold text-amber-600 dark:text-amber-300">
                            {{ Auth::user()->pendingTasks()->count() }}
                        </div>
                        <div class="text-[10px] text-slate-500 uppercase font-medium">Pending</div>
                    </div>
                </div>
            </div>

            <div class="app-card p-4">
                <h3 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Overview</h3>
                <div class="space-y-2.5">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-500">Total Tasks</span>
                        <span class="font-semibold text-slate-900 dark:text-slate-100">
                            {{ Auth::user()->tasks()->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-500">In Progress</span>
                        <span class="font-semibold text-amber-600 dark:text-amber-300">
                            {{ Auth::user()->pendingTasks()->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-500">Finished</span>
                        <span class="font-semibold text-teal-700 dark:text-teal-300">
                            {{ Auth::user()->completedTasks()->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('profile.edit') }}"
                    class="app-btn app-btn-ghost mb-3 flex items-center justify-center gap-2 w-full px-4 py-3 text-xs font-bold shadow-sm active:scale-95">
                    <i data-lucide="user-cog" class="w-4 h-4"></i>
                    EDIT PROFILE
                </a>

                <a href="{{ route('focus.suggest') }}"
                    class="app-btn app-btn-accent flex items-center justify-center gap-2 w-full px-4 py-3 text-xs font-bold active:scale-95">
                    <i data-lucide="lightbulb" class="w-4 h-4"></i>
                    GET SUGGESTIONS
                </a>
            </div>
        @endauth

        {{ $slot ?? '' }}
    </div>
</section>
