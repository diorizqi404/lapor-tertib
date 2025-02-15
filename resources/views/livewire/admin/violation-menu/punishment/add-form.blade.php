<div wire:ignore.self
     class="grid grid-cols-6 max-sm:grid-cols-1 gap-4 border border-gray-200 p-4 mt-4 rounded-xl overflow-hidden transition-[height] duration-500">
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Punishment Name
        </x-input-label>
        <x-text-input type="text " placeholder="ex: First Warning Letter" required wire:model="name"/>
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="max-md:col-span-3 col-span-2">
        <x-input-label>
            Min. Point
        </x-input-label>
        <x-text-input type="text " placeholder="ex: 50" wire:model="min_point" required/>
        @error('min_point') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-2">
        <x-primary-button class="h-12 mt-6" type="button" wire:click="store()">
            Add Punishment
        </x-primary-button>
    </div>
</div>
