<div class="size-full fixed top-0 left-0 z-[80] flex justify-center items-center" role="dialog" tabindex="-1">
    <div class="fixed inset-0 overflow-hidden bg-neutral-900 opacity-50 backdrop-blur-sm"></div>
    <div class="mt-7 opacity-100 hs-overlay-open:duration-500 ease-out transition-all sm:max-w-lg sm:w-full m-3">
        <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-neutral-900">
            <!-- Close Icon -->
            <div class="absolute top-2 end-2">
                <button wire:click.prevent="closeModal()" type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#hs-sign-out-alert">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <!-- End Close Icon -->

            <x-text-heading-1 class="text-center m-6">{{ $isEdit ? 'Edit Teacher' : 'Add Teacher' }}</x-text-heading-1>
            <div class="p-6 pt-0 overflow-y-auto">
                <div class="grid gap-y-4">
                    <!-- Form Group -->
                    <div>
                        <x-input-label for="name" class="block text-sm mb-2 dark:text-white" :value="'Full Name'" />
                        <div class="relative">
                            <x-text-input type="text" id="name" name="name" required autofocus
                                wire:model="name" />
                        </div>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <div class="flex justify-between space-x-2">
                        <!-- Form Group -->
                        <div class="w-1/2">
                            <x-input-label for="email" class="block text-sm mb-2 dark:text-white"
                                :value="'Email Address'" />
                            <div class="relative">
                                <x-text-input class="" type="email" id="email" name="email" required
                                    autofocus wire:model="email" />
                            </div>
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div class="w-1/2">
                            <x-input-label for="phone" class="block text-sm mb-2 dark:text-white"
                                :value="'Phone'" />
                            <div class="relative">
                                <x-text-input type="text" id="phone" name="phone" required autofocus
                                    wire:model="phone"></x-text-input>
                            </div>
                            @error('phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End Form Group -->
                    </div>

                    <!-- Form Group -->
                    <div>
                        <x-input-label for="password" class="block text-sm mb-2 dark:text-white" :value="'Password'" />
                        <div class="relative">
                            <x-text-input type="password" id="password" name="password" required autofocus
                                wire:model="password"></x-text-input>
                        </div>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <x-input-label for="photo" :value="__('Profile Photo')" />
                        @if ($isEdit && $existingPhoto)
                            <div class="mb-2">
                                <img src="{{ Storage::url($existingPhoto) }}" class="w-20 h-20 object-cover">
                            </div>
                        @endif
                        <div class="flex flex-col h-20">
                            <input type="file" name="file-input" id="file-input" wire:model="photo"
                                class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400">
                            <div class="flex mt-1">
                                <p class="text-gray-500 text-sm mr-2">Maximum file size 4 MB</p>
                                <div wire:loading wire:target="photo" class="text-sm text-blue-500">
                                    Uploading...
                                </div>
                            </div>
                        </div>
                        @if ($isEdit)
                            <small class="text-gray-500">Leave empty to keep current photo</small>
                        @endif
                        @error('photo')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <x-input-label for="gender" :value="__('Gender')" />
                        <div class="flex space-x-2">
                            <label for="hs-radio-in-form"
                                class="flex p-3 w-full bg-blue-100 border border-blue-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <input type="radio" name="hs-radio-in-form" wire:model="gender" value="L"
                                    class="shrink-0 mt-0.5 border-gray-400 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                    id="hs-radio-in-form">
                                <span class="text-sm text-gray-600 ms-3 dark:text-neutral-400">Male</span>
                            </label>

                            <label for="hs-radio-checked-in-form"
                                class="flex p-3 w-full bg-pink-100 border border-pink-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <input type="radio" name="hs-radio-in-form" wire:model="gender" value="P"
                                    class="shrink-0 mt-0.5 border-gray-400 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                    id="hs-radio-checked-in-form">
                                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Female</span>
                            </label>
                        </div>
                        @error('gender')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button" wire:click.prevent="closeModal()"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            Cancel
                        </button>
                        <x-primary-button type="button" wire:click.prevent="{{ $isEdit ? 'update' : 'store' }}">
                            {{ $isEdit ? 'Save Updates' : 'Save' }}
                            <!-- Loading Indicator -->
                            <x-icon-loading wire:target="{{ $isEdit ? 'update' : 'store' }}" />
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
