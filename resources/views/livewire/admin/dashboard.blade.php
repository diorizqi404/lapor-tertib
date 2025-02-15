<div class="mx-auto px-4 py-4 space-y-8">
    <h1 class="text-4xl font-semibold">Hello, {{ auth()->user()->name }} 👋, How are you?</h1>

    <!-- Stat Section -->
    <div class="w-full grid grid-cols-4 max-[1200px]:grid-cols-2 max-[700px]:grid-cols-1 gap-4 mx-auto">
        <!-- Card -->
        @livewire('stat-card', [
            'icon' => '<svg class="shrink-0 size-8 text-blue-500 dark:text-neutral-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>',
            'title' => 'Total Teachers',
            'hint' => 'Total number of teacher',
            'value' => $totalTeachers,
        ])
        <!-- End Card -->

        <!-- Card -->
        @livewire('stat-card', [
            'icon' => '<svg class="shrink-0 size-8 text-blue-500 dark:text-neutral-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>',
            'title' => 'Total Student',
            'value' => $totalStudents,
        ])
        <!-- End Card -->

        <!-- Card -->
        @livewire('stat-card', [
            'icon' => '<svg class="shrink-0 size-8 text-blue-500 dark:text-neutral-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>',
            'title' => 'Total Category',
            'value' => $totalCategories,
        ])
        <!-- End Card -->

        <!-- Card -->
        @livewire('stat-card', [
            'icon' => '<svg class="shrink-0 size-8 text-blue-500 dark:text-neutral-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>',
            'title' => 'Total Violation',
            'value' => $totalViolations,
        ])
        <!-- End Card -->


    </div>
    <!-- End Stat Section -->

    <!-- Chart Section -->
    <livewire:dashboard-charts />
    <!-- End Chart Section -->






</div>
