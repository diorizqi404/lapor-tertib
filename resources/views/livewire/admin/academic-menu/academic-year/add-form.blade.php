<div wire:ignore.self
     class="grid grid-cols-6 max-sm:grid-cols-1 gap-4 border border-gray-200 p-4 mt-4 rounded-xl overflow-hidden transition-[height] duration-500">
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Acacdemic Start Year
        </x-input-label>
        <x-text-input type="date" placeholder="ex: 2025" required
                      wire:model="academic_start_date"/>
        @error('academic_start_date') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Academic End Year
        </x-input-label>
        <x-text-input type="date" placeholder="ex: RPL" wire:model="academic_end_date" required/>
        @error('academic_end_date') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-2">
        <x-primary-button class="h-12 mt-6" type="button" wire:click="academic_store()">
            Add Academic Year
        </x-primary-button>
    </div>
</div>
