<div
    class="grid grid-cols-8 gap-4 w-full border border-gray-200 p-4 mt-4 rounded-xl overflow-hidden transition-[height] duration-500">
    
    <!-- Input Category Name -->
    <div class="max-lg:col-span-6 max-sm:col-span-8 col-span-2">
        <x-input-label>Category Name</x-input-label>
        <x-text-input type="text" placeholder="ex: Late Arrival" required wire:model="name"/>
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Input Points -->
    <div class="max-lg:col-span-2 max-sm:col-span-8 col-span-1">
        <x-input-label>Points</x-input-label>
        <x-text-input type="text" placeholder="ex: 25" required wire:model="point"/>
        @error('point') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Input Description -->
    <div class="max-lg:col-span-6 max-sm:col-span-8 col-span-3">
        <x-input-label>Description</x-input-label>
        <x-text-input type="text" placeholder="ex: When Student Late Arrival" required wire:model="description"/>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Tombol Save -->
    <div class="max-lg:col-span-2 max-sm:col-span-8 col-span-2">
        <x-primary-button class="h-12 mt-6" type="button" wire:click="store()">
            Save Category
        </x-primary-button>
    </div>
</div>
