<div class="size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1">
    <div class="absolute inset-0 bg-neutral-500 opacity-50 backdrop-blur-sm"></div>
    <div class="mt-7 opacity-100 hs-overlay-open:duration-500 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-neutral-900">
            <div class="absolute top-2 end-2">
                <button wire:click.prevent="closeModalImport()" type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#hs-sign-out-alert">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>

            <div class="p-4 sm:p-10 overflow-y-auto">
                <form>
                    <div class="grid gap-y-4">

                        <!-- Form Group -->
                        <div>
                            <x-input-label :value="__('File Excel')"/>
                            <input type="file" wire:model="excel" name="excel"  class="block mt-1 w-full"/>
                            @error('excel') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <!-- End Form Group -->

                        <div class="mt-6 flex justify-center gap-x-4">
{{--                            <button type="button" wire:click.prevent="closeModal()"--}}
{{--                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">--}}
{{--                                Cancel--}}
{{--                            </button>--}}
                            <x-primary-button type="button" wire:click="importExcel()">
                               Start Import data
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
