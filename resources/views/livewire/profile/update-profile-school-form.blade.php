<?php
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $address = '';
    public string $phone = '';
    public ?string $existing_photo = null;
    public $photo; // Pastikan ini tidak dideklarasikan sebagai string

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $school = School::find(Auth::user()->school_id);

        if ($school) {
            $this->name = $school->name;
            $this->email = $school->email;
            $this->address = $school->address;
            $this->phone = $school->phone;
            $this->existing_photo = $school->photo ?? '';
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        DB::beginTransaction();

        try {
            $school = School::where('id', Auth::user()->school_id)
                ->lockForUpdate()
                ->firstOrFail(); // Lock row untuk mencegah race condition

            // Validasi input
            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(School::class)->ignore($school->id)],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            ]);

            // Simpan data ke database
            $school->fill([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
            ]);

            // Jika ada file yang diupload, simpan ke storage
            if ($this->photo) {
                $path = $this->photo->store('profile_photos', 'public');
                $school->photo = $path;
            }

            $school->save();

            DB::commit();

            // Dispatch event untuk notifikasi sukses
            $this->existing_photo = $school->photo;
            $this->dispatch('profile-updated', name: $school->name);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // Kembalikan error jika gagal
        }
    }

    protected $listeners = ['profile-updated' => 'refreshPhoto'];

    public function refreshPhoto()
    {
        $this->existing_photo = School::where('id', Auth::user()->school_id)->value('photo');
    }
};
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('School Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your school information profile.') }}
        </p>
    </header>

    <div class="grid grid-cols-3 max-lg:grid-cols-1 gap-8 my-8 w-full">
        <div class="col-span-1 space-y-4 flex justify-center items-center flex-col">
            <div class="rounded-lg bg-gray-100 p-2 shadow-lg w-fit flex">
                <img src="{{ $existing_photo ? Storage::url($existing_photo) . '?' . now()->timestamp : Storage::url('profile_photos/man.png') }}"
                    alt="school photo" class="w-64 h-auto rounded-md" wire:key="{{ now()->timestamp }}">

            </div>
            <div class="flex flex-col h-20">
                <input type="file" name="file-input" id="file-input" wire:model="photo"
                    class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400">
                <div class="flex mt-1">
                    <p class="text-gray-500 text-sm mr-2">Maximum file size 4 MB</p>
                    <div wire:loading wire:target="photo" class="text-sm text-blue-500">
                        Uploading...
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
        </div>

        <form wire:submit="updateProfileInformation" class="col-span-2 grid grid-cols-2 max-sm:grid-cols-1 mt-6 gap-4 h-fit">
            <div class="col-span-1">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="col-span-1">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="col-span-1">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input wire:model="address" id="address" name="address" type="text"
                    class="mt-1 block w-full" required autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div class="col-span-1">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input wire:model="phone" id="phone" name="phone" type="number" min="0"
                    class="mt-1 block w-full" required autocomplete="phone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div class="col-span-1 flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</section>
