<tr class="w-full overflow-hidden transition-[height] duration-300 bg-gray-200">
    <td colspan="6" class="p-0 w-full">
        <div class="w-full border-t border-b border-gray-200  dark:border-neutral-700 dark:bg-neutral-800/50">
            <form class="grid grid-cols-4 gap-4 w-full p-4">
                <div class="col-span-1 mt-4">
                    <x-input-label class="text-xs">
                        Class Name
                    </x-input-label>
                    <x-text-input type="text " placeholder="ex: 1 or A" required
                        wire:model="class_name.{{ $c->id }}" />
                    @error('class_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative col-span-1 mt-6">
                    <select wire:model="class_dept_id.{{ $c->id }}"
                        class="peer p-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600 focus :pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2">
                        <option value="">Please select</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->initial }}</option>
                        @endforeach
                    </select>
                    <label
                        class="absolute bottom-1 start-0 p-4 h-full truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">Select
                        Department</label>
                    @error('class_dept_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative col-span-1 mt-6">
                    <select wire:model="class_grade_id.{{ $c->id }}"
                        class="peer p-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600 focus :pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2">
                        <option value="">Please select</option>
                        @foreach ($grades as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                    <label
                        class="absolute bottom-1 start-0 p-4 h-full truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 dark:text-neutral-500">
                        Select Grade
                    </label>
                    @error('class_grade_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-1">
                    <x-primary-button type="button" wire:click="class_update({{ $c->id }})" class="h-12 mt-6">
                        Update Class
                    </x-primary-button>
                </div>
            </form>
        </div>
    </td>
</tr>
