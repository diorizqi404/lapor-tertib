<div x-data="{ open: false }" class="relative">
    <div class="relative">
        <input type="text" wire:model.live="search" x-on:focus="open = true" placeholder="Select student name..."
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500" />

        @if ($selectedStudent)
            <div class="mt-2 p-2 bg-green-100 rounded-md">
                Dipilih: {{ $selectedStudent->name }}
                ({{ $selectedStudent->class->grade->name }}
                {{ $selectedStudent->class->department->initial ?? '' }}
                {{ $selectedStudent->class->name }})
            </div>
        @endif
    </div>

    @if (!empty($students) && $search)
        <ul x-show="open" x-on:click.away="open = true"
            class="absolute z-10 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto">
            @foreach ($students as $student)
                <li wire:click="selectStudent({{ $student->id }})" class="p-2 hover:bg-gray-100 cursor-pointer">
                    {{ $student->name }}
                    - {{ $student->nis }}
                    ({{ optional($student->class?->grade)->name ?? '' }}
                    {{ optional($student->class?->department)->initial ?? '' }}
                    {{ optional($student->class)->name ?? '' }})
                </li>
            @endforeach
        </ul>
    @endif
</div>
