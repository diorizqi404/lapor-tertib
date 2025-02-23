<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/login', navigate: true);
    }
};
?>

<header
    class="z-10 sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap w-full bg-white border-b text-sm py-2.5 dark:bg-neutral-800 dark:border-neutral-700">
    <nav class="px-4 sm:px-6 flex justify-between items-center w-full mx-auto">

            <!-- Logo -->
            <x-application-logo class="w-auto h-8 fill-current text-orange-500 font-bold" />
            <!-- End Logo -->


        <div class="flex flex-row items-center justify-end gap-1">

            <!-- Dropdown -->
            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                <button id="hs-dropdown-account" type="button"
                    class="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:text-white"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    @php
                        $photo = 'profile_photos/man.png';
                    @endphp
                    <img class="shrink-0 size-[38px] rounded-full"
                        src="{{ Storage::url($photo) }}"
                        alt="Avatar">
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
                    <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                        <p class="text-sm text-gray-500 dark:text-neutral-500">Signed in as</p>
                        @if (Auth::check())
                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">{{ Auth::user()->email }}</p>
                        @endif
                    </div>
                    <div class="p-1.5 space-y-0.5">
                        <a wire:click="logout"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm cursor-pointer text-red-500 hover:bg-red-100 focus:outline-none focus:bg-red-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="h-5 w-5 text-red-500" />
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Dropdown -->
        </div>
        {{-- <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">

        </div> --}}
    </nav>
</header>
