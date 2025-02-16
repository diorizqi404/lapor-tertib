<div>
    @php
        $classBox = "flex flex-col my-8  bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700"
    @endphp
    <div class="flex">
        <div class="flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button wire:ignore type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                    Academic Year Management
                </button>
                <button wire:ignore type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-3" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
                    Department Management
                </button>
                <button wire:ignore type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-3" aria-controls="segment-3" role="tab">
                    Grade Management
                </button>
                <button wire:ignore type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-3" aria-selected="false" data-hs-tab="#segment-4" aria-controls="segment-4" role="tab">
                    Class Management
                </button>
            </nav>
        </div>
    </div>

    <div class="mt-3">
        <div wire:ignore.self id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
            <p class="text-gray-500 dark:text-neutral-400">
                @include('livewire.admin.academic-menu.academic-year.academic_year')
            </p>
        </div>
        <div wire:ignore.self id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
            @include('livewire.admin.academic-menu.department.department')
        </div>
        <div wire:ignore.self id="segment-3" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
            @include('livewire.admin.academic-menu.grade.grade')
        </div>
        <div wire:ignore.self id="segment-4" class="hidden" role="tabpanel" aria-labelledby="segment-item-3">
            @include('livewire.admin.academic-menu.class.classes')
        </div>
    </div>
</div>
