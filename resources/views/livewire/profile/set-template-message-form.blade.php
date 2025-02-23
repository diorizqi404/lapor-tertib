<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public $message;
    public $default_template;

    public $selected_fields = [];

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $settings = Setting::where('school_id', Auth::user()->school_id)->first();

        if ($settings) {
            $this->selected_fields = $settings->message_template ?? [];
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateMessageTemplate(): void
    {
        $school_id = Auth::user()->school_id;

        $validated = $this->validate([
            'selected_fields' => ['array'],
        ]);

        Setting::updateOrInsert(
            ['school_id' => $school_id], // Kondisi pencarian
            ['message_template' => json_encode(array_values($this->selected_fields))], // Data yang diupdate/insert
        );

        $this->dispatch('message-updated');
    }
}; ?>

<section class="">
    <header>
        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
            {{ __('Templat Pesan') }}
        </h2>

        <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
            {{ __('Kustomisasi pesan yang akan dikirimkan ke orang tua. Centang pilihan dibawah untuk memilih.') }}
        </p>
    </header>

    <div class="py-2 w-full mx-auto">
        {{-- <h2 class="text-2xl font-semibold">Panduan Variabel Template Pesan WhatsApp</h2> --}}
        {{-- <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
            {{ __('Berikut merupakan variabel tersedia yang dapat anda gunakan, tidak wajib menyertakan semuanya.') }}
        </p> --}}


        <div class="grid grid-cols-2 gap-2 my-2">

            <label for="hs-vertical-checkbox-in-form1"
                class="max-w-xs flex p-3 w-full bg-white border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input type="checkbox" wire:model.defer="selected_fields" value="student_name"
                    class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-vertical-checkbox-in-form1">
                <span class="text-sm ms-3 dark:text-neutral-400">Nama Siswa</span>
            </label>

            <label for="hs-vertical-checkbox-in-form2"
                class="max-w-xs flex p-3 w-full bg-white border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input type="checkbox" wire:model.defer="selected_fields" value="violation_name"
                    class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-vertical-checkbox-in-form2">
                <span class="text-sm ms-3 dark:text-neutral-400">Nama Pelanggarannya</span>
            </label>

            <label for="hs-vertical-checkbox-in-form3"
                class="max-w-xs flex p-3 w-full bg-white border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input type="checkbox" wire:model.defer="selected_fields" value="teacher_name"
                    class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-vertical-checkbox-in-form3">
                <span class="text-sm ms-3 dark:text-neutral-400">Nama Guru Pelapor</span>
            </label>

            <label for="hs-vertical-checkbox-in-form4"
                class="max-w-xs flex p-3 w-full bg-white border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input type="checkbox" wire:model.defer="selected_fields" value="description"
                    class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-vertical-checkbox-in-form4">
                <span class="text-sm ms-3 dark:text-neutral-400">Deskripsi Pelanggaran</span>
            </label>

            <label for="hs-vertical-checkbox-in-form5"
                class="max-w-xs flex p-3 w-full bg-white border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <input type="checkbox" wire:model.defer="selected_fields" value="punishment"
                    class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-vertical-checkbox-in-form5">
                <span class="text-sm ms-3 dark:text-neutral-400">Menampilkan hukuman</span>
            </label>

            {{-- <div class="max-xl:col-span-2 bg-green-50 border border-green-500 rounded-lg h-min">
                <div class="flex justify-between h-min">
                    <div class="p-1 flex justify-start flex-wrap items-center space-x-2 pb-1">
                        <livewire:copy-to-clipboard text="{violation_name}" />
                        <h1 class="text-gray-900">Pelanggaran yang dilakukan</h1>
                    </div>
                    <button type="button" class="hs-collapse-toggle mr-2" id="hs-basic-collapse" aria-expanded="false"
                        aria-controls="hs-basic-collapse-heading" data-hs-collapse="#hs-basic-collapse-heading">
                        <x-heroicon-o-chevron-down class="w-5 h-5" />
                    </button>
                </div>

                <p id="hs-basic-collapse-heading"
                    class="hs-collapse hidden border-t border-green-500 text-gray-600 font-mono text-md p-2 overflow-hidden transition-[height] duration-300">
                    Melakukan pelanggaran {violation_name} -> Melakukan pelanggaran Datang Terlambat</p>
            </div>

            <div class="max-xl:col-span-2 bg-green-50 border border-green-500 rounded-lg h-min">
                <div class="flex justify-between h-min">
                    <div class="p-1 flex justify-start flex-wrap items-center space-x-2 pb-1">
                        <livewire:copy-to-clipboard text="{description}" />
                        <h1 class="text-gray-900">Deskripsi mengenai pelanggaran</h1>
                    </div>
                    <button type="button" class="hs-collapse-toggle mr-2" id="hs-basic-collapse" aria-expanded="false"
                        aria-controls="hs-basic-collapse-heading" data-hs-collapse="#description">
                        <x-heroicon-o-chevron-down class="w-5 h-5" />
                    </button>
                </div>

                <p id="description"
                    class="hs-collapse hidden border-t border-green-500 text-gray-600 font-mono text-md p-2 overflow-hidden transition-[height] duration-300">
                    Deskripsi: {description} -> Deskripsi: Tidak menggunakan dasi</p>
            </div>

            <div class="max-xl:col-span-2 bg-green-50 border border-green-500 rounded-lg h-min">
                <div class="flex justify-between h-min">
                    <div class="p-1 flex justify-start flex-wrap items-center space-x-2 pb-1">
                        <livewire:copy-to-clipboard text="{teacher_name}" />
                        <h1 class="text-gray-900">Guru yang melaporkan pelanggaran</h1>
                    </div>
                    <button type="button" class="hs-collapse-toggle mr-2" id="hs-basic-collapse" aria-expanded="false"
                        aria-controls="hs-basic-collapse-heading" data-hs-collapse="#teacher_name">
                        <x-heroicon-o-chevron-down class="w-5 h-5" />
                    </button>
                </div>

                <p id="teacher_name"
                    class="hs-collapse hidden border-t border-green-500 text-gray-600 font-mono text-md p-2 overflow-hidden transition-[height] duration-300">
                    Guru pelapor: {teacher_name} -> Guru pelapor: Suparno</p>
            </div>

            <div class="max-xl:col-span-2 bg-green-50 border border-green-500 rounded-lg h-min">
                <div class="flex justify-between h-min">
                    <div class="p-1 flex justify-start flex-wrap items-center space-x-2 pb-1">
                        <livewire:copy-to-clipboard text="{punishment}" />
                        <h1 class="text-gray-900">Hukuman yang diterima</h1>
                    </div>
                    <button type="button" class="hs-collapse-toggle mr-2" id="hs-basic-collapse" aria-expanded="false"
                        aria-controls="hs-basic-collapse-heading" data-hs-collapse="#punishment">
                        <x-heroicon-o-chevron-down class="w-5 h-5" />
                    </button>
                </div>

                <p id="punishment"
                    class="hs-collapse hidden border-t border-green-500 text-gray-600 font-mono text-md p-2 overflow-hidden transition-[height] duration-300">
                    Hukuman yang diterima: {punishment} -> Hukuman yang diterima: SP 1</p>
            </div> --}}

        </div>

        {{-- <div class="mt-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
            <p class="text-sm text-blue-800">
                <span class="font-semibold">Catatan:</span> Jika ingin enter, gunakan <code class="text-lg">\n</code>
                pada pesan
            </p>
        </div>
        <div class="mt-2 bg-red-50 p-4 rounded-lg border border-red-200">
            <p class="text-sm text-red-800">
                <span class="font-semibold">Catatan:</span> Variabel harus ditulis persis sama termasuk tanda kurung
                kurawal
            </p>
        </div> --}}
    </div>

    <form class="mt-6 space-y-6">
        <div class="">

            <div class="flex items-center gap-4">
                <x-primary-button wire:click.prevent="updateMessageTemplate()">{{ __('Save') }}</x-primary-button>

                <x-action-message class="me-3" on="message-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </div>
    </form>
</section>
