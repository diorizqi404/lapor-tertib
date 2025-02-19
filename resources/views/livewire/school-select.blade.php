<div x-data="{ open: false }" class="relative">
    <div class="relative">
        <input type="text" wire:model.live="search" x-on:focus="open = true" placeholder="Select school name..."
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500" />

        @if ($selectedSchool)
            <div class="mt-2 p-2 bg-green-100 rounded-md">
                Dipilih: {{ $selectedSchool->name }}
            </div>
        @endif
    </div>

    @if (!empty($schools) && $search)
        <ul x-show="open" x-on:click.away="open = true"
            class="absolute z-10 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto">
            @foreach ($schools as $school)
                <li wire:click="selectSchool({{ $school->id }})" class="p-2 hover:bg-gray-100 cursor-pointer">
                    {{ $school->name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
