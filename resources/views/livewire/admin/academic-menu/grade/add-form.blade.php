<div wire:ignore.self
    class="grid grid-cols-6 max-sm:grid-cols-2 gap-4 border border-gray-200 p-4 mt-4 rounded-xl overflow-hidden transition-[height] duration-500">
    <div class="col-span-3">
        <x-input-label>
            Grade Name
        </x-input-label>
        <x-text-input type="text " placeholder="ex: 10 or X" required wire:model="grade_name" />
        @error('grade_name')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-span-3">
        <x-primary-button class="h-12 mt-6" type="button" wire:click="grade_store()">
            Add Grade
        </x-primary-button>
    </div>
</div>
