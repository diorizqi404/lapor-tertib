<tr class=" w-full overflow-hidden transition-[height] duration-300">
    <td colspan="5" class="p-0">
        <div class="border-t border-b border-gray-200 bg-gray-50/50 dark:border-neutral-700 dark:bg-neutral-800/50">
            <div class="px-6 py-4">
                <form class="grid grid-cols-8 gap-4">
                    <div class="col-span-2">
                        <x-input-label>
                            Category Name
                        </x-input-label>
                        <x-text-input type="text " placeholder="{{ $vcg->name }}" required
                            wire:model="name.{{ $vcg->id }}" />
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <x-input-label>
                            Points
                        </x-input-label>
                        <x-text-input type="text " placeholder="{{ $vcg->point }}" required
                            wire:model="point.{{ $vcg->id }}" />
                        @error('point')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-3">
                        <x-input-label>
                            Description
                        </x-input-label>
                        <x-text-input type="text " placeholder="{{ $vcg->description }}" required
                            wire:model="description.{{ $vcg->id }}" />
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <x-primary-button type="button" wire:click="update({{ $vcg->id }})" class="h-10 mt-7">
                            Save Update
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </td>
</tr>
