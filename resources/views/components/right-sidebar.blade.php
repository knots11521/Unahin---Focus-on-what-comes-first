<aside id="right-sidebar"
    class="sidebar-transition fixed inset-y-0 right-0 z-50 w-80

    translate-x-full lg:translate-x-0

    lg:static
    transition-transform duration-300 ease-in-out

    bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800
    flex-shrink-0">

    <div class="flex flex-col h-full w-80 p-8">

        {{-- TITLE --}}
        <h3 class="font-black text-sm uppercase tracking-widest text-slate-400 mb-8">
            Quick Stats
        </h3>

        {{-- CONTENT --}}
        <div class="space-y-6 overflow-y-auto no-scrollbar">

            @auth

                {{-- COMPLETION RATE --}}
                <div class="p-4 rounded-[5px] bg-slate-50 dark:bg-slate-800/50">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            Completion Rate
                        </span>

                        <span class="text-sm font-bold text-teal-600 dark:text-teal-300">
                            {{ Auth::user()->completion_progress ?? 0 }}%
                        </span>
                    </div>

                    <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-[5px]">
                        <div class="bg-teal-600 dark:bg-teal-400 h-2 rounded-[5px] transition-all duration-500"
                            style="width: {{ Auth::user()->completion_progress ?? 0 }}%">
                        </div>
                    </div>
                </div>

                {{-- TODAY ACTIVITY --}}
                <div class="p-4 rounded-[5px] bg-slate-50 dark:bg-slate-800/50">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">
                        Today's Activity
                    </h3>

                    <div class="grid grid-cols-2 gap-2 text-center">

                        <div class="p-2 rounded-[5px] bg-white dark:bg-slate-900">
                            <div class="text-lg font-bold text-teal-600 dark:text-teal-300">
                                {{ Auth::user()->completedTasksToday() }}
                            </div>
                            <div class="text-[10px] text-slate-500 uppercase font-medium">
                                Completed
                            </div>
                        </div>

                        <div class="p-2 rounded-[5px] bg-white dark:bg-slate-900">
                            <div class="text-lg font-bold text-amber-600 dark:text-amber-300">
                                {{ Auth::user()->pendingTasks()->count() }}
                            </div>
                            <div class="text-[10px] text-slate-500 uppercase font-medium">
                                Pending
                            </div>
                        </div>

                    </div>
                </div>

                {{-- OVERVIEW --}}
                <div class="p-4 rounded-[5px] bg-slate-50 dark:bg-slate-800/50">
                    <h3 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                        Overview
                    </h3>

                    <div class="space-y-2 text-xs">

                        <div class="flex justify-between">
                            <span class="text-slate-500">Total Tasks</span>
                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                {{ Auth::user()->tasks()->count() }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">In Progress</span>
                            <span class="font-semibold text-amber-600 dark:text-amber-300">
                                {{ Auth::user()->pendingTasks()->count() }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">Finished</span>
                            <span class="font-semibold text-teal-600 dark:text-teal-300">
                                {{ Auth::user()->completedTasks()->count() }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="space-y-3">

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-[5px]
                        text-xs font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">

                        <i data-lucide="user-cog" class="w-4 h-4"></i>
                        Edit Profile
                    </a>

                    <a href="{{ route('focus.suggest') }}"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-[5px]
                        text-xs font-bold bg-indigo-600 text-white hover:bg-indigo-700 transition-all">

                        <i data-lucide="lightbulb" class="w-4 h-4"></i>
                        Get Suggestions
                    </a>

                </div>
            @endauth
        </div>
    </div>
</aside>
