{{-- @php --}}
{{--    $classes = 'size-5'; --}}

{{-- @endphp --}}

@php
    $icon = 'w-6 h-6';
@endphp

<div id="hs-application-sidebar"
    class="hs-overlay  [--auto-close:xl]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-[260px] h-full
  hidden
  fixed inset-y-0 start-0 z-[60]
  bg-white border-e border-gray-200
  2xl:block 2xl:translate-x-0 2xl:end-auto 2xl:bottom-0
  dark:bg-neutral-800 dark:border-neutral-700"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4 flex items-center">
            <!-- Logo -->
            <x-application-logo class="w-10 h-10 fill-current text-orange-500 font-bold" />
            <!-- End Logo -->

            <div class="hidden xl:block ms-2">
            </div>
        </div>

        <!-- Content -->
        <div
            class="mt-8 h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="flex flex-col space-y-2">

                    @if (auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" wire:navigate>
                            <x-heroicon-o-home class="{{ $icon }}" />
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('admin.teacher')" :active="request()->routeIs('admin.teacher')" wire:navigate>
                            <x-heroicon-o-users class="{{ $icon }}" />
                            Teacher
                        </x-nav-link>

                        <x-nav-link :href="route('admin.academic')" :active="request()->routeIs('admin.academic')" wire:navigate>
                            <x-heroicon-o-academic-cap class="{{ $icon }}" />
                            Academic
                        </x-nav-link>

                        <x-nav-link :href="route('admin.student')" :active="request()->routeIs('admin.student')" wire:navigate>
                            <x-heroicon-o-user-group class="{{ $icon }}" />
                            Student
                        </x-nav-link>

                        <x-nav-link :href="route('admin.violation-category')" :active="request()->routeIs('admin.violation-category')" wire:navigate>
                            <x-heroicon-o-rectangle-stack class="{{ $icon }}" />
                            Violation Category
                        </x-nav-link>

                        <x-nav-link :href="route('admin.punishment')" :active="request()->routeIs('admin.punishment')" wire:navigate>
                            <x-heroicon-o-exclamation-circle class="{{ $icon }}" />
                            Punishment
                        </x-nav-link>

                        <x-nav-link :href="route('admin.violations')" :active="request()->routeIs('admin.violations')" wire:navigate>
                            <x-heroicon-o-rectangle-stack class="{{ $icon }}" />
                            Violation
                        </x-nav-link>

                        <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                            <x-heroicon-o-user-circle class="{{ $icon }}" />
                            Profile
                        </x-nav-link>
                    @endif
                </ul>
            </nav>
        </div>
        <!-- End Content -->
    </div>
</div>
