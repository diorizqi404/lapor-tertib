{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--        <!-- Scripts -->--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    </head>--}}
{{--    <body class="font-sans antialiased">--}}
{{--        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">--}}
{{--            <livewire:layout.dashboard-navigation />--}}
{{--            setelah livewire layout navigation--}}
{{--            <!-- Page Heading -->--}}
{{--            @if (isset($header))--}}
{{--                <header class="bg-white dark:bg-gray-800 shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

{{--            <!-- Page Content -->--}}
{{--            <main>--}}
{{--                {{ $slot }}--}}
{{--            </main>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary': '#60a5fa',
                        'primary-dark': '#3b82f6',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles for chart placeholders */
        .chart-placeholder {
            background-image: linear-gradient(to right, #60a5fa 0%, #93c5fd 100%);
        }

        .dark .chart-placeholder {
            background-image: linear-gradient(to right, #3b82f6 0%, #60a5fa 100%);
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <livewire:superadmin.sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <livewire:layout.dashboard-navigation/>
        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    // Theme toggle functionality
    const themeToggleBtn = document.getElementById('theme-toggle');
    themeToggleBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
    });

    // Sidebar toggle functionality (for mobile)
    const sidebarToggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('aside');
    sidebarToggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
</script>
</body>
</html>

