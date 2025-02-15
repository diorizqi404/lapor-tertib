<tr class=" w-full overflow-hidden transition-[height] duration-300">
    <td colspan="4" class="p-0">
        <div
            class="border-t border-b border-gray-200 bg-gray-50/50 dark:border-neutral-700 dark:bg-neutral-800/50">
            <div class="px-6 py-4">
                <form class="grid grid-cols-4 gap-4 w-full">
                    <div class="col-span-2">
                        <label for="dept-name-{{ $dept->id }}"
                               class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Department Name
                        </label>
                        <x-text-input
                            id="dept-name-{{ $dept->id }}"
                            type="text"
                            class="w-full"
                            placeholder="{{ $dept->name }}"
                            wire:model="dept_name.{{ $dept->id }}"
                        />
                        @error('dept_name.'.$dept->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="max-md:col-span-2 col-span-1">
                        <label for="dept-initial-{{ $dept->id }}"
                               class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Department Initial
                        </label>
                        <x-text-input
                            id="dept-initial-{{ $dept->id }}"
                            type="text"
                            class="w-full"
                            placeholder="{{ $dept->initial }}"
                            wire:model="dept_initial.{{ $dept->id }}"
                        />
                        @error('dept_initial.'.$dept->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="max-md:col-span-2 col-span-1">
                        <x-primary-button
                            type="button"
                            wire:click="dept_update({{ $dept->id }})"
                            class="h-10 mt-6">
                            Save Update
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </td>
</tr>
