@php
    $classBox =
        'flex flex-col my-8  bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700';
@endphp

<div class="{{ $classBox }}">
    <!-- Header -->
    <div class="px-6 py-4 md:items-center border-b border-gray-200 dark:border-neutral-700">
        <!-- Toggle Add Form -->
        <x-primary-button wire:ignore.self wire:click="openAddForm()" withIcon="true" class="h-10">
            Category
        </x-primary-button>
        <!-- End Toggle Add Form -->

        <!-- Delete -->
        @if ($selected_id)
            <x-danger-button wire:click.prevent="delete('')">
                Delete ({{ count($selected_id) }})
            </x-danger-button>
        @endif
        <!-- End Delete -->

        {{-- Add Form --}}
        @if ($isAddFormOpen)
            @include('livewire.admin.violation-menu.category.add-form')
        @endif
        {{-- End Add Form --}}
    </div>
    <!-- End Header -->

    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">

            <!-- Table -->
            @if (count($violation_categories) === 0)
                <x-empty-table class="h-full" />
            @else
                <div class="relative overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <th scope="col" class="ps-6 py-3 text-start">
                                    <span class="sr-only">Select</span>
                                </th>
                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                            Category Name
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                            Violation Point
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                            Description
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-end">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($violation_categories as $vcg)
                                <tr class="group">
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <label for="class-{{ $vcg->id }}" class="flex">
                                                <input type="checkbox"
                                                    class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="class-{{ $vcg->id }}" value="{{ $vcg->id }}"
                                                    wire:key="{{ $vcg->id }}" wire:model.live="selected_id">
                                                <span class="sr-only">Select Category</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $vcg->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $vcg->point }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $vcg->description }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5 hs-accordion">
                                            <button type="button"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                                wire:click="openEditForm({{ $vcg->id }})">
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Form Row -->
                                @if ($isEditFormOpen && $editingId === $vcg->id)
                                    @include('livewire.admin.violation-menu.category.edit-form')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <!-- End Table -->

            <!-- Footer -->
            <div
                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                {{ $violation_categories->links() }}
            </div>
            <!-- End Footer -->
        </div>
    </div>
</div>
