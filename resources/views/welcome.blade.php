@php
    $appName = 'LaporTertib';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') ===
            'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' &&
            window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>
</head>

<body class="font-sans ">
    <!-- ========== HEADER ========== -->
    <header
        class="sticky top-4 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full before:absolute before:inset-0 before:max-w-[66rem] before:mx-2 before:lg:mx-auto before:rounded-[26px] before:bg-white before:shadow-md">
        <nav
            class="relative max-w-[66rem] w-full py-2.5 ps-5 pe-2 md:flex md:items-center md:justify-between md:py-0 mx-2 lg:mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <!-- Logo -->
                    <x-application-logo class="w-10 h-10 fill-current text-orange-500 font-bold" />
                    <!-- End Logo -->
                    {{-- <h1>LaporTertib</h1> --}}
                </div>

                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full bg-blue-500 text-white disabled:opacity-50 disabled:pointer-events-none"
                        id="hs-navbar-floating-dark-collapse" aria-expanded="false"
                        aria-controls="hs-navbar-floating-dark" aria-label="Toggle navigation"
                        data-hs-collapse="#hs-navbar-floating-dark">
                        <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Collapse -->
            <div id="hs-navbar-floating-dark"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
                aria-labelledby="hs-navbar-floating-dark-collapse">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end py-2 md:py-0 md:ps-7">
                    <a class="p-3 ps-px sm:px-3 md:py-4 text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                        href="#features" aria-current="page">Features</a>
                    <a class="p-3 ps-px sm:px-3 md:py-4 text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                        href="#howto">How To?</a>
                    <a class="p-3 ps-px sm:px-3 md:py-4 text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                        href="{{ route('student.search') }}">Cari Siswa</a>

                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif

                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content">
        <!-- Hero -->
        <div
            class="my-[10%] relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
                <!-- Announcement Banner -->
                <div class="flex justify-center">
                    <a class="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 focus:outline-none focus:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-neutral-600 dark:focus:border-neutral-600"
                        href="#">
                        Demo Account is Available!
                        <span class="flex items-center gap-x-1">
                            <span
                                class="border-s border-gray-200 text-blue-600 ps-2 dark:text-blue-500 dark:border-neutral-700">Try
                                Now</span>
                            <svg class="shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- End Announcement Banner -->

                <!-- Title -->
                <div class="mt-5 max-w-4xl text-center mx-auto">
                    <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
                        Kelola dan Pantau Pelanggaran Siswa dengan Mudah
                    </h1>
                </div>
                <!-- End Title -->

                <div class="mt-5 max-w-3xl text-center mx-auto">
                    <p class="text-lg text-gray-600 dark:text-neutral-400">
                        {{ $appName }} membantu sekolah dalam mencatat dan memantau pelanggaran yang dilakukan oleh
                        siswa. Gratis dan dapat digunakan di berbagai jenjang pendidikan.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="mt-8 gap-3 flex justify-center">
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 focus:outline-none focus:from-violet-600 focus:to-blue-600 border border-transparent text-white text-sm font-medium rounded-full py-3 px-4"
                        href="#">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z">
                            </path>
                        </svg>
                        Daftar Sekarang!
                    </a>
                </div>
                <!-- End Buttons -->
            </div>
        </div>
        <!-- End Hero -->

        <!-- Features -->
        <div id="features" class="my-[10%] max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Tab Nav -->
            <nav class="max-w-6xl mx-auto flex flex-col sm:flex-row gap-y-px sm:gap-y-0 sm:gap-x-4" aria-label="Tabs"
                role="tablist" aria-orientation="horizontal">
                <button type="button"
                    class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 focus:outline-none focus:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 active"
                    id="tabs-with-card-item-1" aria-selected="true" data-hs-tab="#tabs-with-card-1"
                    aria-controls="tabs-with-card-1" role="tab">
                    <x-heroicon-o-chart-pie
                        class="shrink-0 hidden sm:block size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-white" />
                    <span class="mt-5">
                        <span
                            class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">
                            Dashboard Intuitif
                        </span>
                        <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">
                            Lihat statistik pelanggaran siswa dengan mudah dan cepat.
                        </span>
                    </span>
                </button>

                <button type="button"
                    class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 focus:outline-none focus:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    id="tabs-with-card-item-2" aria-selected="false" data-hs-tab="#tabs-with-card-2"
                    aria-controls="tabs-with-card-2" role="tab">
                    <x-heroicon-o-chat-bubble-left-right
                        class="shrink-0 hidden sm:block size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-white" />
                    <span class="mt-5">
                        <span
                            class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">
                            Notifikasi Whatsapp
                        </span>
                        <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">
                            Terima notifikasi pelanggaran siswa langsung ke WhatsApp Orang Tua.
                        </span>
                    </span>
                </button>

                <button type="button"
                    class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 focus:outline-none focus:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    id="tabs-with-card-item-3" aria-selected="false" data-hs-tab="#tabs-with-card-3"
                    aria-controls="tabs-with-card-3" role="tab">
                    <svg class="shrink-0 hidden sm:block size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-white"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                        <path d="M5 3v4" />
                        <path d="M19 17v4" />
                        <path d="M3 5h4" />
                        <path d="M17 19h4" />
                    </svg>
                    <span class="mt-5">
                        <span
                            class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">
                            Sistem Poin
                        </span>
                        <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">
                            Tiap pelanggaran memiliki poin dan dapat hukuman sesuai skala batas.
                        </span>
                    </span>
                </button>
            </nav>
            <!-- End Tab Nav -->

            <!-- Tab Content -->
            <div class="mt-12 md:mt-16">

                <div id="tabs-with-card-1" role="tabpanel" aria-labelledby="tabs-with-card-item-1">
                    <!-- Devices -->
                    <div class="max-w-[1140px] lg:pb-32 relative">
                        <!-- Browser Device -->
                        <figure
                            class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">

                            <div class="p-3 bg-gray-200 rounded-[1.2rem]">
                                <img class="max-w-full rounded-[1rem] h-auto"
                                    src="{{ Storage::url('resources/dashboar.jpeg') }}" alt="Features Image">
                            </div>
                        </figure>
                        <!-- End Browser Device -->
                    </div>
                    <!-- End Devices -->
                </div>

                <div id="tabs-with-card-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-2">
                    <!-- Devices -->
                    <div class="max-w-[1140px] lg:pb-32 relative">
                        <!-- Browser Device -->
                        <figure
                            class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">

                            <div class="p-3 bg-gray-200 rounded-[1.2rem]">
                                <img class="max-w-full rounded-[1rem] h-auto"
                                    src="{{ Storage::url('resources/1.jpg') }}" alt="Features Image">
                            </div>
                        </figure>
                        <!-- End Browser Device -->
                    </div>
                    <!-- End Devices -->
                </div>

                <div id="tabs-with-card-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-3">
                    <!-- Devices -->
                    <div class="max-w-[1140px] lg:pb-32 relative">
                        <!-- Browser Device -->
                        <figure
                            class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">

                            <div class="p-3 bg-gray-200 rounded-[1.2rem]">
                                <img class="max-w-full rounded-[1rem] h-auto"
                                    src="{{ Storage::url('resources/2.jpg') }}" alt="Features Image">
                            </div>
                        </figure>
                        <!-- End Browser Device -->
                    </div>
                    <!-- End Devices -->
                </div>

            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Features -->

        <!-- Approach -->
        <div id="howto" class="my-[10%] max-w-5xl px-4 xl:px-0 py-10 lg:pt-20  mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="font-semibold text-2xl md:text-4xl md:leading-tight">Bagaimana cara
                    menggunakannya?</h2>
                <p class="mt-1 text-neutral-400">
                    Hanya 4 langkah mudah untuk memulai menggunakan {{ $appName }}.
                </p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
                <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                    <img class="w-full object-cover rounded-xl"
                        src="https://images.unsplash.com/photo-1587614203976-365c74645e83?q=80&w=480&h=600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Features Image">
                </div>
                <!-- End Col -->

                <!-- Timeline -->
                <div>
                    <!-- Heading -->
                    <div class="mb-4">
                        <h3 class="text-blue-500 text-sm font-medium uppercase">
                            Steps
                        </h3>
                    </div>
                    <!-- End Heading -->

                    <!-- Item -->
                    <div class="flex gap-x-5 ms-1">
                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                            <div class="relative z-10 size-8 flex justify-center items-center">
                                <span
                                    class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 text-blue-500 font-semibold text-sm uppercase rounded-full">
                                    1
                                </span>
                            </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8 sm:pb-12">
                            <p class="text-sm lg:text-base text-gray-600">
                                <span class=" font-semibold">Tambahkan Guru:</span>
                                Guru akan melaporkan pelanggaran yang dilakukan oleh siswa.
                            </p>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5 ms-1">
                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                            <div class="relative z-10 size-8 flex justify-center items-center">
                                <span
                                    class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 text-blue-500 font-semibold text-sm uppercase rounded-full">
                                    2
                                </span>
                            </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8 sm:pb-12">
                            <p class="text-sm lg:text-base text-gray-600">
                                <span class=" font-semibold">Buat Struktur Akademik:</span>
                                Membuat tahun ajaran, tingkatan, kelas, dan atau departemen sebelum menambahkan siswa.
                            </p>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5 ms-1">
                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                            <div class="relative z-10 size-8 flex justify-center items-center">
                                <span
                                    class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 text-blue-500 font-semibold text-sm uppercase rounded-full">
                                    3
                                </span>
                            </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8 sm:pb-12">
                            <p class="text-sm lg:text-base text-gray-600">
                                <span class=" font-semibold">Tambahkan Siswa:</span>
                                Daftarkan siswa beserta nomor WhatsApp orang tua untuk mendapatkan notifikasi.
                            </p>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5 ms-1">
                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                            <div class="relative z-10 size-8 flex justify-center items-center">
                                <span
                                    class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 text-blue-500 font-semibold text-sm uppercase rounded-full">
                                    4
                                </span>
                            </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8 sm:pb-12">
                            <p class="text-sm lg:text-base text-gray-600">
                                <span class=" font-semibold">Buat Kategori Pelanggaran dan Hukuman:</span>
                                Tentukan kategori pelanggaran serta poinnya dan hukuman yang akan diberikan.
                            </p>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->

                    <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-100 border border-blue-400 font-medium text-sm text-blue-700 rounded-full focus:outline-none"
                        href="#">
                        <x-heroicon-m-pencil-square class="shrink-0 size-4" />
                        Catat Pelanggaran
                    </a>
                </div>
                <!-- End Timeline -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Approach -->

    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <footer class="relative overflow-hidden">
        <div class="relative z-10">
            <div class="w-full max-w-5xl px-4 xl:px-0 py-10 lg:pt-16 mx-auto">
                <div class="inline-flex items-center">
                    <!-- Logo -->
                    <x-application-logo class="w-10 h-10 fill-current text-orange-500 font-bold" />
                    <!-- End Logo -->

                    <div class="border-s border-neutral-700 ps-5 ms-5">
                        <p class="text-sm text-neutral-400">
                            © 2025 {{ $appName }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->

    <script>
        document.addEventListener("livewire:navigated", function() {
            window.HSStaticMethods.autoInit(["tabs"]);
        });
    </script>
</body>

</html>
