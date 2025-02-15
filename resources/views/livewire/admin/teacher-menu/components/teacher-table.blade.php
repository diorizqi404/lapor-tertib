@php
    $classBox = 'overflow-hidden my-8 bg-white border border-gray-200 rounded-xl shadow-md dark:bg-neutral-800 dark:border-neutral-700';
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
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-with-icons" type="button"
                    class="hs-dropdown-toggle py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                        viewBox="0 0 48 48">
                        <path fill="#169154" d="M29,6H15.744C14.781,6,14,6.781,14,7.744v7.259h15V6z">
                        </path>
                        <path fill="#18482a" d="M14,33.054v7.202C14,41.219,14.781,42,15.743,42H29v-8.946H14z">
                        </path>
                        <path fill="#0c8045" d="M14 15.003H29V24.005000000000003H14z"></path>
                        <path fill="#17472a" d="M14 24.005H29V33.055H14z"></path>
                        <g>
                            <path fill="#29c27f" d="M42.256,6H29v9.003h15V7.744C44,6.781,43.219,6,42.256,6z">
                            </path>
                            <path fill="#27663f" d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z">
                            </path>
                            <path fill="#19ac65" d="M29 15.003H44V24.005000000000003H29z"></path>
                            <path fill="#129652" d="M29 24.005H44V33.055H29z"></path>
                        </g>
                        <path fill="#0c7238"
                            d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z">
                        </path>
                        <path fill="#fff"
                            d="M9.807 19L12.193 19 14.129 22.754 16.175 19 18.404 19 15.333 24 18.474 29 16.123 29 14.013 25.07 11.912 29 9.526 29 12.719 23.982z">
                        </path>
                    </svg>
                    Actions
                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-36 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            wire:click="import()">
                            <x-heroicon-m-arrow-up-tray class="w-6 h-6" />
                            Import
                        </a>
                        <a class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            wire:click="import()">
                            <x-heroicon-m-arrow-down-tray class="w-6 h-6" />
                            Export
                        </a>
                    </div>
                </div>
            </div>

            <x-select wire:model.live="perPage"></x-select>
        </div>
        <!-- End Dropdown Menu -->

        <!-- Action Button -->
        <div class="flex justify-start items-center space-x-2 max-[800px]:mt-2">
            <!-- Delete -->
            @php
                $tooltip = empty($selected_id) ? 'true' : 'false';
            @endphp
            <x-danger-button wire:click.prevent="deleteBulk('')" withTooltip="{{ $tooltip }}">
                Delete ({{ count($selected_id) }})
            </x-danger-button>
            <!-- End Delete -->

            <x-primary-button withIcon="true" type="button" wire:click="create()">Add
                Teacher
            </x-primary-button>

            @if ($isModalOpen)
                @include('livewire.admin.teacher-menu.components.form')
            @endif

            @if ($isModalImportOpen)
                @include('livewire.admin.teacher-menu.components.import-excel')
            @endif
        </div>
        <!-- Action Button -->
    </div>
    <!-- End Header -->


    <!-- Table -->
    <div class="overflow-x-auto -m-1.5">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                        <th scope="col" class="ps-6 py-3 text-start">
                            #
                        </th>

                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Name
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Phone
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Gender
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Violations
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Last Update
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-end">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td class="size-px whitespace-nowrap">
                                <div class="ps-6 py-3">
                                    <label for="hs-at-with-checkboxes-1" class="flex">
                                        <input type="checkbox"
                                            class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-at-with-checkboxes-1" value="{{ $teacher->id }}"
                                            wire:key="{{ $teacher->id }}" wire:model.live="selected_id">
                                        <span class="sr-only">Checkbox</span>
                                    </label>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                    <div class="flex items-center gap-x-3">
                                        @php
                                            $defaultPhoto =
                                                $teacher->gender == 'L'
                                                    ? 'profile_photos/man.png'
                                                    : 'profile_photos/woman.png';
                                        @endphp
                                        <img class="inline-block size-[38px] rounded-full"
                                            src="{{ $teacher->photo ? Storage::url($teacher->photo) : Storage::url($defaultPhoto) }}"
                                            alt="Teacher Poto">
                                        <div class="grow">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $teacher->name }}</span>
                                            <span
                                                class="block text-sm text-gray-500 dark:text-neutral-500">{{ $teacher->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span
                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $teacher->phone }}</span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    @if ($teacher->gender === 'L')
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
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ \App\Models\Violation::where('teacher_id', $teacher->id)->count() }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="text-sm text-gray-500 dark:text-neutral-500">
                                        {{ \Carbon\Carbon::parse($teacher->updated_at)->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-1.5">
                                    <button type="button" wire:click.prevent="edit({{ $teacher->id }})"
                                        class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Table -->

    <!-- Pagination -->
    <div
        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
        {{ $teachers->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
    </div>
    <!-- End Pagination -->
</div>
