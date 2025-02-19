<?php

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Student;

new #[Layout('layouts.guest')] class extends Component {
    
    // Deklarasikan properti public agar bisa diakses oleh Livewire
    public string $notelp = '';
    public string $nis = '';

    public function rules()
    {
        return [
            'notelp' => ['required', 'numeric'],
            'nis' => ['required', 'numeric'],
        ];
    }

    public function login()
    {
        $this->validate();

        $student = Student::where('nis', $this->nis)
            ->where('parent_phone', $this->notelp)
            ->first();

        if ($student) {
            Session::put('student_id', $student->id);
            return redirect()->route('student.dashboard');
        } else {
            // Perbaiki typo route dari `studen.login` menjadi `student.login`
            return redirect()->route('student.login')->with('error', 'NIS atau No. Telp salah!');
        }
    }
};
?>

<div class="w-96 max-[500px]:w-64">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">
        <!-- No Telp Ortu -->
        <div>
            <x-input-label for="notelp" :value="__('No Telp Ortu')" />
            <x-text-input wire:model="notelp" id="notelp" type="number" name="notelp" required autofocus />
            <x-input-error :messages="$errors->get('notelp')" class="mt-2" />
        </div>

        <!-- NIS -->
        <div class="mt-4">
            <x-input-label for="nis" :value="__('Nomor Induk Siswa')" />
            <x-text-input wire:model="nis" id="nis" type="number" name="nis" required />
            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
