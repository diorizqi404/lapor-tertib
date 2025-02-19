<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 dark:bg-neutral-800 dark:text-white">
    <!-- ========== MAIN CONTENT ========== -->

        <!-- Content -->
        <div class="w-full flex justify-center items-center">
                <!-- your content goes here ... -->
                  {{ $slot }}
        </div>
        <!-- End Content -->
        <!-- ========== END MAIN CONTENT ========== -->

        <x-chatbot />
        <script src="./node_modules/preline/dist/preline.js"></script>
        @livewireScripts
</body>

</html>
