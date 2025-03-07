<div class="flex flex-col my-8  bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
    <!-- Header -->
    <div class="p-4 flex md:items-center border-b border-gray-200 dark:border-neutral-700">

        <div class="w-1/2 max-xl:w-full max-sm:w-full">
            <!-- Toggle Add Form -->
            <x-primary-button wire:ignore.self wire:click="openAddFormGrade()" withIcon="true" class="h-10">
                Add New Grade
            </x-primary-button>
            <!-- End Toggle Add Form -->

            <!-- Delete -->
            @if ($gradeSelected_id)
                <x-danger-button wire:click.prevent="grade_delete('')">
                    Delete ({{ count($gradeSelected_id) }})
                </x-danger-button>
            @endif
            <!-- End Delete -->

            {{-- Add Form --}}
            @if ($isAddFormGradeOpen)
                @include('livewire.admin.academic-menu.grade.add-form')
            @endif
            {{-- End Add Form --}}
        </div>
    </div>
    <!-- End Header -->
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">

            <!-- Table -->
            <div class="relative overflow-x-auto">
                @if (count($grades) === 0)
                    <x-empty-table class="h-full" />
                @else
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
                                            Grade Name
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-end">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($grades as $grade)
                                <tr class="group">
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <label for="grade-{{ $grade->id }}" class="flex">
                                                <input type="checkbox"
                                                    class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="grade-{{ $grade->id }}" value="{{ $grade->id }}"
                                                    wire:key="{{ $grade->id }}" wire:model.live="gradeSelected_id">
                                                <span class="sr-only">Select Grade</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $grade->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5 hs-accordion">
                                            <button type="button"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                                wire:click="openEditFormGrade({{ $grade->id }})">
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Form Row -->
                                @if ($isEditFormGradeOpen && $editingGradeId === $grade->id)
                                    @include('livewire.admin.academic-menu.grade.edit-form')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- End Table -->

            <!-- Footer -->
            {{-- <div
                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                {{ $grades->links() }}
            </div> --}}
            <!-- End Footer -->
        </div>
    </div>
</div>
