<?php
$classBox = 'my-8  bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700';
?>

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
            <x-danger-button wire:click.prevent="delete('')" withTooltip="{{ $tooltip }}">
                Delete ({{ count($selected_id) }})
            </x-danger-button>
            <!-- End Delete -->

            <x-primary-button withIcon="true" type="button" wire:click="create()">
                Violation
            </x-primary-button>

            @if ($isModalOpen)
                @include('livewire.admin.violation-menu.violation.components.form')
            @endif

            {{-- @if ($isModalImportOpen)
                @include('livewire.admin.violation-menu.violation.components.import-excel')
            @endif --}}
        </div>
        <!-- Action Button -->
    </div>
    <!-- End Header -->


    <!-- Table -->
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                        <th scope="col" class="ps-6 py-3 text-start">

                        </th>

                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Student Name
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Violation
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Datetime
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Description
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Photo
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Teacher Assigne
                                </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-end"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($violations as $v)
                        <tr>
                            <td class="size-px whitespace-nowrap">
                                <div class="ps-6 py-3">
                                    <label for="hs-at-with-checkboxes-1" class="flex">
                                        <input type="checkbox"
                                            class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-at-with-checkboxes-1" value="{{ $v->id }}"
                                            wire:key="{{ $v->id }}" wire:model.live="selected_id">
                                        <span class="sr-only">Checkbox</span>
                                    </label>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $v->student->name }}
                                    </span>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <div class="grow">
                                        <span
                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $v->ViolationCategory->name }}</span>
                                        <span
                                            class="block text-sm text-gray-500 dark:text-neutral-500">{{ $v->ViolationCategory->point }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ \Carbon\Carbon::parse($v->datetime)->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $v->description }}
                                    </span>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        <button type="button"
                                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                            aria-haspopup="dialog" aria-expanded="false"
                                            data-hs-overlay="#hs-basic-modal-photo-{{ $v->id }}">
                                            Open modal
                                        </button>
                                    </span>
                                </div>
                            </td>
                            <div id="hs-basic-modal-photo-{{ $v->id }}"
                                class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
                                role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
                                <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <div
                                            class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                            <h3 id="hs-basic-modal-label"
                                                class="font-bold text-gray-800 dark:text-white">
                                                Incident Photo
                                            </h3>
                                            <button type="button"
                                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                                aria-label="Close"
                                                data-hs-overlay="#hs-basic-modal-photo-{{ $v->id }}">
                                                <span class="sr-only">Close</span>
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M18 6 6 18"></path>
                                                    <path d="m6 6 12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4 overflow-y-auto">
                                            <img class="inline-block max-w-96" src="{{ Storage::url($v->photo) }}"
                                                alt="Incident Photo">
                                        </div>
                                        <div
                                            class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                                            <button type="button"
                                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                                data-hs-overlay="#hs-basic-modal-photo-{{ $v->id }}">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $v->teacher->name }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Table -->

    <!-- Footer -->
    <div
        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
        {{ $violations->links() }}

        {{--                            <div> --}}
        {{--                                <p class="text-sm text-gray-600 dark:text-neutral-400"> --}}
        {{--                                    <span class="font-semibold text-gray-800 dark:text-neutral-200">12</span> results --}}
        {{--                                </p> --}}
        {{--                            </div> --}}

        {{--                            <div> --}}
        {{--                                <div class="inline-flex gap-x-2"> --}}
        {{--                                    <button type="button" --}}
        {{--                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"> --}}
        {{--                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" --}}
        {{--                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" --}}
        {{--                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> --}}
        {{--                                            <path d="m15 18-6-6 6-6"/> --}}
        {{--                                        </svg> --}}
        {{--                                        Prev --}}
        {{--                                    </button> --}}

        {{--                                    <button type="button" --}}
        {{--                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"> --}}
        {{--                                        Next --}}
        {{--                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" --}}
        {{--                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" --}}
        {{--                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> --}}
        {{--                                            <path d="m9 18 6-6-6-6"/> --}}
        {{--                                        </svg> --}}
        {{--                                    </button> --}}
        {{--                                </div> --}}
        {{--                            </div> --}}
    </div>
    <!-- End Footer -->
</div>
