<div class="m-8 w-1/2 max-xl:w-3/4 max-sm:w-[95%] space-y-8">
    <x-text-heading-1>Profil Siswa</x-text-heading-1>
    <x-primary-button type="button" wire:click="backToSearch">
        <x-heroicon-s-arrow-left class="w-5 h-5 mr-2" />
        Kembali
    </x-primary-button>
    <div class="p-8 grid grid-cols-3 max-lg:grid-cols-1 gap-4 bg-white shadow-lg rounded-lg">
        <div class="col-span-1 flex justify-center">
            <div class="rounded-lg bg-gray-100 p-2 shadow-lg w-fit flex">
                <img src="{{ $student->photo ? Storage::url($student->photo) : Storage::url('profile_photos/man.png') }}"
                    alt="{{ $student->name }}" class="w-48 h-auto rounded-md">
            </div>
        </div>
        <div class="col-span-2 grid grid-cols-3 space-y-4">
            <x-text-heading-1 class="font-semibold col-span-3">{{ $student->name }}</x-text-heading-1>
            <div class="col-span-1">
                <x-input-label :value="__('NIS')" class="mb-0 text-blue-900 text-sm font-semibold" />
                <h1 class="font-semibold text-lg">{{ $student->nis }}</h1>
            </div>
            <div class="col-span-1">
                <x-input-label :value="__('Tahun Ajaran')" class="mb-0 text-blue-900 text-sm font-semibold" />
                <h1 class="font-semibold text-lg">
                    {{ \Carbon\Carbon::parse($student->academicYear->start_date)->year }}/{{ \Carbon\Carbon::parse($student->academicYear->end_date)->year }}
                </h1>
            </div>
            <div class="col-span-1">
                <x-input-label :value="__('Kelas')" class="mb-0 text-blue-900 text-sm font-semibold" />
                {{-- @dd($student) --}}
                <h1 class="font-semibold text-lg">
                    {{ optional($student->class?->grade)->name ?? '' }}
                    {{ optional($student->class?->department)->initial ?? '' }}
                    {{ optional($student->class)->name ?? '' }}
                </h1>
            </div>
            <div class="col-span-1 w-fit">
                <x-input-label :value="__('Status Siswa')" class="mb-0 text-blue-900 text-sm font-semibold" />
                @if ($student->academicYear->status === 'active')
                    <h1
                        class="font-semibold text-base tracking-wider p-[1px] border-green-500 border text-center rounded-md bg-green-100">
                        Aktif
                    </h1>
                @else
                    <h1
                        class="font-semibold text-base tracking-wider p-[1px] border-green-500 border text-center rounded-md bg-green-100">
                        Lulus
                    </h1>
                @endif
            </div>
            <div class="col-span-1">
                <x-input-label :value="__('Total Poin')" class="mb-0 text-blue-900 text-sm font-semibold" />
                <h1 class="font-semibold text-lg">{{ $point }}</h1>
            </div>
            <div class="col-span-1">
                <x-input-label :value="__('Notelp Ortu')" class="mb-0 text-blue-900 text-sm font-semibold" />
                {{-- @dd($student) --}}
                <h1 class="font-semibold text-lg">
                    {{ $student->parent_phone }}
                </h1>
            </div>
            <div class="col-span-2">
                <x-input-label :value="__('Hukuman')" class="mb-0 text-blue-900 text-sm font-semibold" />
                {{-- @dd($student) --}}
                <h1 class="font-semibold text-lg">
                    {{ $punishment }}
                </h1>
            </div>
        </div>
    </div>

    <div class="p-8 grid gap-4 bg-white shadow-lg rounded-lg overflow-x-auto max-h-[500px] overflow-y-auto">
        @foreach ($violations as $v)
            <div class="border-b-2 border-gray-400 py-4  min-w-[500px] flex justify-between">
                <div class="w-fit">
                    <h1 class="text-xl font-semibold">{{ $v->violationCategory->name }}</h1>
                    <div class="w-auto flex space-x-2 mt-1">
                        <h1
                            class="font-semibold text-sm tracking-wider py-[2px] px-1 border-red-500 border text-center rounded-md bg-red-100">
                            {{ $v->violationCategory->point . ' ' . 'Poin' }}
                        </h1>
                        <h1
                            class="font-semibold text-sm tracking-wider py-[2px] px-1 border-green-500 border text-center rounded-md bg-green-100 flex">
                            <x-heroicon-s-calendar-date-range class="w-4 h-4 mr-1 mt-[2px]" />
                            {{ \Carbon\Carbon::parse($v->datetime)->format('H:i d M Y') }}
                        </h1>
                    </div>
                </div>
                <x-primary-button type="button"
                    class=""
                    aria-haspopup="dialog" aria-expanded="false"
                    data-hs-overlay="#hs-basic-modal-photo-{{ $v->id }}">
                    View Detail
                </x-primary-button>
                <div id="hs-basic-modal-photo-{{ $v->id }}"
                    class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
                    role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
                    <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
                                    Detail Violation
                                </h3>
                                <button type="button"
                                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                    aria-label="Close" data-hs-overlay="#hs-basic-modal-photo-{{ $v->id }}">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 overflow-y-auto space-y-2">
                                <h1 class="">Pelanggaran: <span
                                        class="font-semibold">{{ $v->violationCategory->name }}</span></h1>
                                <h1 class="">Poin: <span
                                        class="font-semibold">{{ $v->violationCategory->point }}</span></h1>
                                <h1 class="">Waktu Kejadian: <span
                                        class="font-semibold">{{ \Carbon\Carbon::parse($v->datetime)->format('H:i d M Y') }}</span>
                                </h1>
                                <h1 class="">Pelapor: <span class="font-semibold">{{ $v->teacher->name }}</span>
                                </h1>
                                <h1 class="">Deskripsi: <span class="font-semibold">{{ $v->description }}</span>
                                </h1>
                                <h1 class="">Foto Kejadian:</h1>
                                <img class="inline-block max-w-80" src="{{ Storage::url($v->photo) }}"
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
            </div>
        @endforeach
    </div>

</div>
