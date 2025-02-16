<tr class=" w-full overflow-hidden transition-[height] duration-300">
    <td colspan="4" class="p-0">
        <div
            class="border-t border-b border-gray-200 bg-gray-50/50 dark:border-neutral-700 dark:bg-neutral-800/50">
            <div class="px-6 py-4">
                <form class="grid grid-cols-4 gap-4 w-full">
                    <div class="max-md:col-span-2 col-span-1">
                        <label for="dept-name-{{ $ay->id }}"
                               class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Academic Start Date
                        </label>
                        <x-text-input
                            id="dept-name-{{ $ay->id }}"
                            type="date"
                            class="w-full"
                            placeholder="{{ $ay->start_date }}"
                            wire:model="academic_start_date.{{ $ay->id }}"
                        />
                        @error('academic_start_date.'.$ay->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="max-md:col-span-2 col-span-1">
                        <label for="dept-initial-{{ $ay->id }}"
                               class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Academic End Date
                        </label>
                        <x-text-input
                            id="dept-initial-{{ $ay->id }}"
                            type="date"
                            class="w-full"
                            placeholder="{{ $ay->end_date }}"
                            wire:model="academic_end_date.{{ $ay->id }}"
                        />
                        @error('academic_end_date.'.$ay->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="max-md:col-span-2 col-span-1">
                        <x-primary-button
                            type="button"
                            wire:click="academic_update({{ $ay->id }})"
                            class="h-10 mt-6">
                            Save Update
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </td>
</tr>
