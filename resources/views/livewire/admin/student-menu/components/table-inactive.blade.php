@php
$classBox = 'my-4 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700';
@endphp

<div class="flex flex-col {{ $classBox }}">

    <!-- Header -->
    <div class="flex justify-between max-[800px]:flex-col border-b border-gray-200 p-4">

        <!-- Search -->
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3.5 pb-1">
                <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </div>
            <input type="text" wire:model.live="keyword"
                class="w-64 max-[800px]:w-full py-2.5 ps-10 pe-16 block bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
                placeholder="Search">
        </div>
        <!-- End Search -->

        <!-- Dropdown Menu -->
        <div class="flex justify-start items-center space-x-2 max-[800px]:mt-2">

            <x-select wire:model.live="perPage"></x-select>
        </div>
        <!-- End Dropdown Menu -->

        @if (Auth::user()->role === 'admin')
            <!-- Action Button -->
            <div class="flex justify-start items-center space-x-2 max-[800px]:mt-2">
                <!-- Delete -->
                <x-danger-button wire:click="deleteAllInactive()" :disabled="$inactiveStudents->isEmpty()">
                    Delete all student
                </x-danger-button>
                <!-- End Delete -->

                @if ($isModalImportOpen)
                    @include('livewire.admin.student-menu.components.import-excel')
                @endif
            </div>
            <!-- Action Button -->
        @endif
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 w-full inline-block align-middle">
            @if (count($inactiveStudents) === 0)
                <x-empty-table class="h-full" />
            @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                        <tr>
                            <th scope="col" class="ps-6 py-3 text-start">
                                #
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        NIS
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Name
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Gender
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Parent Phone
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Total Violations
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Total Points
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Academic Year
                                    </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span
                                        class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                        Action
                                    </span>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach ($inactiveStudents as $student)
                            <tr>
                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 py-3">
                                        <label for="hs-at-with-checkboxes-1" class="flex">
                                            <input type="checkbox"
                                                class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                id="hs-at-with-checkboxes-1" value="{{ $student->id }}"
                                                wire:key="{{ $student->id }}" wire:model.live="selected_id">
                                            <span class="sr-only">Checkbox</span>
                                        </label>
                                    </div>
                                </td>

                                <td class="h-px w-24 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span
                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $student->nis }}</span>
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            @php
                                                $defaultPhoto =
                                                    $student->gender == 'L'
                                                        ? 'profile_photos/man.png'
                                                        : 'profile_photos/woman.png';
                                            @endphp
                                            <img class="inline-block size-[38px] rounded-full"
                                                src="{{ $student->photo ? Storage::url($student->photo) : Storage::url($defaultPhoto) }}"
                                                alt="Teacher Poto">
                                            <div class="grow">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $student->name }}
                                                </span>
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ $student->class?->grade?->name . ' ' . $student->class?->department?->initial . ' ' . $student->class?->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        @if ($student->gender === 'L')
                                            <span
                                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-200 text-blue-800 rounded-md dark:bg-teal-500/10 dark:text-teal-500">
                                                Male
                                            </span>
                                        @else
                                            <span
                                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-pink-200 text-pink-800 rounded-md dark:bg-teal-500/10 dark:text-teal-500">
                                                Female
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                            {{ $student->parent_phone }}
                                        </span>
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                            {{ \App\Models\Violation::where('student_id', $student->id)->count() }}
                                        </span>
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                            {{ \App\Models\Violation::where('student_id', $student->id)->sum('point') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="text-sm text-gray-500 dark:text-neutral-500">
                                            {{ $student->academicYear->full_name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-1.5">
                                        <button type="button" wire:click.prevent="edit({{ $student->id }})"
                                            class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- End Table -->

    <!-- Footer -->
    <div
        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
        {{ $inactiveStudents->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
    </div>
    <!-- End Footer -->
</div>
