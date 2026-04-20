@php
    $task = $task ?? null;
    $selectedTags = old('tags', $task?->tagIds ?? []);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="md:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ old('title', $task?->title) }}" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                placeholder="What needs to be done?">
            @error('title')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Description
            </label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                placeholder="Add context or notes...">{{ old('description', $task?->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="space-y-6">
        <div>
            <label for="priority" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Priority <span class="text-red-500">*</span>
            </label>
            <select name="priority" id="priority" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-slate-300 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                <option value="">Select Priority</option>
                <option value="low" {{ old('priority', $task?->priority) === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task?->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority', $task?->priority) === 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="effort_level" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Effort Level <span class="text-red-500">*</span>
            </label>
            <select name="effort_level" id="effort_level" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-slate-300 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                <option value="">Select Effort Level</option>
                <option value="easy" {{ old('effort_level', $task?->effort_level) === 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="medium" {{ old('effort_level', $task?->effort_level) === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="hard" {{ old('effort_level', $task?->effort_level) === 'hard' ? 'selected' : '' }}>Hard</option>
            </select>
            @error('effort_level')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="space-y-6">
        <div>
            <label for="deadline" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Deadline
            </label>
            <input type="datetime-local" name="deadline" id="deadline"
                value="{{ old('deadline', $task?->deadline ? $task->deadline->format('Y-m-d\\TH:i') : '') }}"
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
            @error('deadline')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tags" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                Tags
            </label>
            <select name="tags[]" id="tags" multiple
                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#0d1117] border sidebar-border rounded-[10px] text-slate-900 dark:text-slate-300 focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all h-[105px]">
                @foreach($tags as $id => $name)
                    <option value="{{ $id }}" {{ in_array($id, $selectedTags) ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-tight">Hold Ctrl/Cmd to select multiple</p>
            @error('tags')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
            @error('tags.*')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-end items-center gap-4">
    <a href="{{ route('tasks.index') }}" class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors text-center">
        Cancel
    </a>
    <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3 bg-brand-600 text-white rounded-[10px] font-bold text-sm hover:bg-brand-700 shadow-lg shadow-brand-600/20 transition-all">
        <i data-lucide="{{ $submitIcon }}" class="w-4 h-4"></i>
        {{ $submitLabel }}
    </button>
</div>
