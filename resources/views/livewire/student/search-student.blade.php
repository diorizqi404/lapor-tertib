<div class="m-16 w-1/2 gap-8 ">
    <div class="p-8 grid grid-cols-2 max-lg:grid-cols-1 gap-4 bg-white shadow-lg rounded-lg">
        <div class="col-span-1">
            <x-text-heading-1 class="font-semibold">Cari data siswa</x-text-heading-1>
            <p class="text-gray-500 mt-2">
                Anda dapat mencari data siswa untuk melihat profil serta riwayat pelanggaran. Silakan isi kolom
                pencarian
                berikut.
            </p>
            <p class="text-red-500 mt-2">
                Jika data siswa tidak ditemukan, lupa NIS, atau ingin mengganti nomor telepon, silakan hubungi admin
                sekolah.
            </p>
        </div>
        <div class="col-span-1 space-y-4">
            <div class="">
                <x-input-label for="search" :value="__('Cari Sekolah')" class="p-0" />
                @livewire('school-select')
                @error('selectedSchool.id')
                    <x-input-error messages="{{ $message }}" />
                @enderror
            </div>
            <div class="">
                <x-input-label for="notelp" :value="__('Masukkan Nomor Telp Ortu')" class="p-0" />
                <x-text-input wire:model="notelp" id="notelp" class="block mt-1 w-full" type="text"  required />
                @error('notelp')
                    <x-input-error messages="{{ $message }}" />
                @enderror
            </div>
            <div class="">
                <x-input-label for="nis" :value="__('Masukkan Nomor Induk Siswa (NIS)')" class="p-0" />
                <x-text-input wire:model="nis" id="nis" class="block mt-1 w-full" type="number" 
                    min="0" required />
                @error('nis')
                    <x-input-error messages="{{ $message }}" />
                @enderror
            </div>
            <x-primary-button wire:click="searchStudent" class="mt-4">
                <x-heroicon-c-magnifying-glass class="h-5 w-5 mr-2" />
                Cari Siswa
            </x-primary-button>
            <span wire:loading="searchStudent">loading..</span>
        </div>
    </div>

    {{-- {{ $student->name }} --}}

</div>
