<tr class=" w-full overflow-hidden transition-[height] duration-300">
    <td colspan="4" class="p-0">
        <div
            class="border-t border-b border-gray-200 bg-gray-50/50 dark:border-neutral-700 dark:bg-neutral-800/50">
            <div class="px-6 py-4">
                <form class="grid grid-cols-4 gap-4">
                    <div class="col-span-2">
                        <label for="grade-name-{{ $grade->id }}"
                               class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Grade Name
                        </label>
                        <x-text-input
                            id="grade-name-{{ $grade->id }}"
                            type="text"
                            class="w-full"
                            placeholder="{{ $grade->name }}"
                            wire:model="grade_name.{{ $grade->id }}"
                        />
                        @error('grade_name.'.$grade->id)
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <x-primary-button
                            type="button"
                            wire:click="grade_update({{ $grade->id }})"
                            class="h-10 mt-6">
                            Save Update
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </td>
</tr>
