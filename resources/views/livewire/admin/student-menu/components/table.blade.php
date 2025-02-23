@php
    $classBox =
        'my-4  bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700';
@endphp

<section>

    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('sync', () => {
        clearTimeout(timeout);
        shown = true;
        timeout = setTimeout(() => { shown = false }, 2000);
    })" x-show.transition.out.opacity.duration.1500ms="shown"
        x-transition:leave.opacity.duration.1500ms style="display: none;"
        class="p-4 bg-green-100 border border-green-400 rounded-lg text-green-600">
        @if ($is_sync)
            Sinkronisasi selesai. Tahun ajaran dan tingkatan telah diperbarui.
        @else
            Sinkronisasi selesai. Tidak ada perubahan tahun ajaran.
        @endif
    </div>

    <div class="flex flex-col {{ $classBox }}">

        <!-- Header -->
        <div class="flex justify-between max-[800px]:flex-col border-b border-gray-200 p-4">

            <!-- Search -->
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3.5 pb-1">
                    <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

       
                    {{-- <div class="hs-dropdown relative inline-flex">
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
                                    <path fill="#27663f"
                                        d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z">
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
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    </div> --}}
       

                {{-- <x-select wire:model.live="perPage"></x-select> --}}
            </div>
            <!-- End Dropdown Menu -->

            @if (Auth::user()->role === 'admin')
                <!-- Action Button -->
                <div class="flex justify-start items-center space-x-2 max-[800px]:mt-2">
                    <!-- Delete -->
                    @php
                        $tooltip = empty($selected_id) ? 'true' : 'false';
                    @endphp
                    <x-danger-button wire:click="delete()" withTooltip="{{ $tooltip }}">
                        Delete ({{ count($selected_id) }})
                    </x-danger-button>
                    <!-- End Delete -->

                    <x-primary-button withIcon="true" type="button" wire:click="create()">
                        Add Student
                    </x-primary-button>

                    @if (count($activeStudents) === 0)
                        <x-primary-button aria-haspopup="dialog" aria-expanded="false"
                            data-hs-overlay="#hs-basic-modal-sync"
                            class="h-12 bg-blue-500 hover:bg-blue-600 focus:bg-blue-600" disabled>
                            <x-heroicon-o-arrow-path class="w-5 h-5 mr-2" />
                            Sync Academic Year
                            <x-icon-loading wire:loading wire:target="syncYear" />
                        </x-primary-button>
                    @else
                        <x-primary-button aria-haspopup="dialog" aria-expanded="false"
                            data-hs-overlay="#hs-basic-modal-sync"
                            class="h-12 bg-blue-500 hover:bg-blue-600 focus:bg-blue-600">
                            <x-heroicon-o-arrow-path class="w-5 h-5 mr-2" />
                            Sync Academic Year
                            <x-icon-loading wire:loading wire:target="syncYear" />
                        </x-primary-button>
                    @endif

                    <div id="hs-basic-modal-sync"
                        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 size-full fixed top-16 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
                        role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
                        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                            <div
                                class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 relative">
                                <button type="button"
                                    class="absolute top-4 right-4 z-10 size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                    aria-label="Close" data-hs-overlay="#hs-basic-modal-sync">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                                <div class="p-4 my-4 flex flex-col justify-center items-center">
                                    <div class="p-4 bg-yellow-100 rounded-full">
                                        <x-heroicon-o-exclamation-triangle class="w-16 h-16 text-yellow-500" />
                                    </div>
                                    <h1 class="text-lg text-yellow-500 font-semibold mt-4">
                                        Apakah Anda yakin ingin melakukan sinkronisasi?
                                    </h1>
                                    <p class="text-gray-500 mt-2 text-sm text-center">
                                        Sinkronisasi akan memperbarui tahun ajaran berdasarkan tingkatan. Siswa yang
                                        berada
                                        di tingkatan tertinggi statusnya tidak aktif dan dianggap lulus. Pastikan Anda
                                        telah
                                        menyelesaikan pembuatan struktur akademik sebelum melakukan sinkronisasi.
                                    </p>
                                </div>
                                <div
                                    class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                                    <button type="button"
                                        class="py-3 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                        data-hs-overlay="#hs-basic-modal-sync">
                                        Batal
                                    </button>
                                    <x-primary-button wire:click.debounce.400ms="syncYear()"
                                        data-hs-overlay="#hs-basic-modal-sync"
                                        class="bg-blue-500 hover:bg-blue-600 focus:bg-blue-600">
                                        Saya Yakin
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($isModalOpen)
                        @include('livewire.admin.student-menu.components.form')
                    @endif

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
                @if (count($activeStudents) === 0)
                    <x-empty-table class="h-full" />
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                @if (Auth::user()->role === 'admin')
                                    <th scope="col" class="ps-6 py-3 text-start">
                                        #
                                    </th>
                                @endif

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

                                @if (Auth::user()->role === 'admin')
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-sm font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Action
                                            </span>
                                        </div>
                                    </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($activeStudents as $student)
                                <tr>
                                    @if (Auth::user()->role === 'admin')
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
                                    @endif

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
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $student->parent_phone }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ \App\Models\Violation::where('student_id', $student->id)->count() }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ \App\Models\Violation::where('student_id', $student->id)->sum('point') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                                {{-- {{ \Carbon\Carbon::parse($student->updated_at)->format('d M Y, H:i') }} --}}
                                                {{ $student->academicYear->full_name }}
                                            </span>
                                        </div>
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5">
                                                <button type="button" wire:click.prevent="edit({{ $student->id }})"
                                                    class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500">
                                                    Edit
                                                </button>
                                            </div>
                                        </td>
                                    @endif
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
            {{ $activeStudents->links('vendor.livewire.tailwind', data: ['scrollTo' => false]) }}
        </div>
        <!-- End Footer -->
    </div>
</section>
