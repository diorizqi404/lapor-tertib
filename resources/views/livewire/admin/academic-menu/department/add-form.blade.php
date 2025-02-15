<div wire:ignore.self
     class="grid grid-cols-6 max-sm:grid-cols-1 gap-4 border border-gray-200 p-4 mt-4 rounded-xl overflow-hidden transition-[height] duration-500">
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Department Name
        </x-input-label>
        <x-text-input type="text " placeholder="ex: Rekayasa Perangkat Lunak" required
                      wire:model="dept_name"/>
        @error('dept_name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Department Initial
        </x-input-label>
        <x-text-input type="text " placeholder="ex: RPL" wire:model="dept_initial" required/>
        @error('dept_initial') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-2">
        <x-primary-button class="h-12 mt-6" type="button" wire:click="dept_store()">
            Add Department
        </x-primary-button>
    </div>
</div>
