<section id="right-sidebar"
    class="w-80 lg:w-96 bg-slate-50/30 dark:bg-[#010409]/30 border-l sidebar-border h-full flex flex-col p-6 shrink-0 z-10 transition-[width,padding] duration-300 relative">

    <!-- FAB TOGGLE BUTTON -->
    <button id="btn-right-toggle" onclick="toggleSidebar('right')"
        class="fixed bottom-6 right-6 p-3 bg-teal-600 hover:bg-teal-700 text-white rounded-full shadow-lg shadow-teal-500/30 z-50 transition-all active:scale-95">
        <i id="icon-right-toggle" data-lucide="panel-right" class="w-5 h-5"></i>
    </button>

    <div class="flex items-center justify-between mb-8 px-2">
        <h2 class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest whitespace-nowrap">
            Quick Stats
        </h2>
    </div>

    <div class="space-y-4 overflow-y-auto no-scrollbar overflow-x-hidden">
        @auth
            <div class="bg-white dark:bg-[#161b22] rounded-lg border sidebar-border p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Completion Rate</span>
                    <span class="text-sm font-bold text-teal-600 dark:text-teal-400">
                        {{ Auth::user()->completion_progress ?? 0 }}%
                    </span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                    <div class="bg-teal-600 h-2 rounded-full transition-all duration-500"
                        style="width: {{ Auth::user()->completion_progress ?? 0 }}%"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#161b22] rounded-lg border sidebar-border p-4 shadow-sm">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Today's Activity</h3>
                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="p-2 rounded-lg bg-slate-50 dark:bg-[#0d1117] border sidebar-border">
                        <div class="text-lg font-bold text-teal-600 dark:text-teal-400">
                            {{ Auth::user()->completedTasksToday() }}
                        </div>
                        <div class="text-[10px] text-slate-500 uppercase font-medium">Completed</div>
                    </div>
                    <div class="p-2 rounded-lg bg-slate-50 dark:bg-[#0d1117] border sidebar-border">
                        <div class="text-lg font-bold text-red-500 dark:text-red-400">
                            {{ Auth::user()->pendingTasks()->count() }}
                        </div>
                        <div class="text-[10px] text-slate-500 uppercase font-medium">Pending</div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#161b22] rounded-lg border sidebar-border p-4 shadow-sm">
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
                        <span class="font-semibold text-blue-500">
                            {{ Auth::user()->pendingTasks()->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-500">Finished</span>
                        <span class="font-semibold text-teal-600">
                            {{ Auth::user()->completedTasks()->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('focus.suggest') }}"
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 text-xs font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow-md shadow-teal-500/20 transition-all active:scale-95">
                    <i data-lucide="lightbulb" class="w-4 h-4"></i>
                    GET SUGGESTIONS
                </a>
            </div>
        @endauth

        {{ $slot ?? '' }}
    </div>
</section>
