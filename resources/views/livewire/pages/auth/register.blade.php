<?php

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public School $school;
    public string $schoolData;
    public User $admin;
    public string $adminData;

    public string $name = '';
    public string $email = '';
    public string $address = '';
    public string $phone = '';
    public string $admin_name = '';
    public string $admin_email = '';
    public string $admin_phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . School::class],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'admin_phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $schoolData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ];

        $this->school = School::create($schoolData);

        $adminData = [
            'school_id' => $this->school->id,
            'role' => 'admin',
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'phone' => $validated['admin_phone'],
            'password' => $validated['password'],
        ];

        $this->admin = User::create($adminData);

        event(new Registered($this->school));
        event(new Registered($this->admin));

        Auth::login($this->admin);

        $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
    }
};
?>

<div>
    <form wire:submit="register" class="w-full sm:grid sm:grid-cols-1 sm:gap-4 sm:items-start">
        <x-text-heading-1 class="text-center font-semibold text-blue-900 underline underline-offset-2 decoration-solid">Pendaftaran Sekolah & Admin</x-text-heading-1>
        <div class="grid grid-cols-2 max-sm:grid-cols-1 gap-4">
            <!-- Name -->
            <div class="col-span-1">
                <x-input-label for="name" :value="__('School Name')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="col-span-1">
                <x-input-label for="email" :value="__('School Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="col-span-1">
                <x-input-label for="address" :value="__('School Address')" />
                <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text"
                    name="address" required autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="col-span-1">
                <x-input-label for="phone" :value="__('School Phone')" />
                <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" name="phone"
                    required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-2 max-sm:grid-cols-1 gap-4 mt-8">
            <!-- Admin Name -->
            <div class="col-span-1">
                <x-input-label for="admin_name" :value="__('Admin Name')" />
                <x-text-input wire:model="admin_name" id="admin_name" class="block mt-1 w-full" type="text"
                    name="admin_name" required autocomplete="admin_name" />
                <x-input-error :messages="$errors->get('admin_name')" class="mt-2" />
            </div>

            <!-- Admin Email Address -->
            <div class="col-span-1">
                <x-input-label for="admin_email" :value="__('Admin Email')" />
                <x-text-input wire:model="admin_email" id="admin_email" class="block mt-1 w-full" type="email"
                    name="admin_email" required autocomplete="admin_email" />
                <x-input-error :messages="$errors->get('admin_email')" class="mt-2" />
            </div>

            <div class="col-span-2 max-sm:col-span-1 grid grid-cols-3 max-sm:grid-cols-1 gap-4">
                <!-- Admin Phone -->
                <div class="mt-4">
                    <x-input-label for="admin_phone" :value="__('Admin Phone')" />
                    <x-text-input wire:model="admin_phone" id="admin_phone" class="block mt-1 w-full" type="text"
                        name="admin_phone" required autocomplete="admin_phone" />
                    <x-input-error :messages="$errors->get('admin_phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
