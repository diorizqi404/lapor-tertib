<nav class="flex items-center">
    @auth
        <div>
            <a class="group inline-flex items-center gap-x-2 py-2 px-3 border border-blue-400 transition duration-300 ease-in-out hover:bg-blue-400 hover:text-white font-medium text-sm text-blue-500 tracking-wider rounded-full focus:outline-none"
                href="{{ url('/dashboard') }}">
                Dashboard
            </a>
        </div>
    @else
        <div
            class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] p-3 ps-px sm:px-3 md:py-4">
            <button id="hs-dropdown-floating" type="button"
                class="hs-dropdown-toggle flex items-center w-full text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                Login
                <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 ms-auto md:ms-1 size-4"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>

            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 md:shadow-md rounded-lg before:absolute top-full before:-top-5 before:start-0 before:w-full before:h-5"
                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-floating-dark">
                <div class="py-1 md:px-1 space-y-1">
                    <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                        href="{{ route('login') }}">
                        Login Guru/Admin
                    </a>
                    <a class="flex items-center gap-x-3.5 py-2 md:px-3 rounded-lg text-sm hover:text-blue-400 focus:outline-none focus:text-blue-400"
                        href="#">
                        Login Siswa
                    </a>
                </div>
            </div>
        </div>

        @if (Route::has('register'))
            <div>
                <a class="group inline-flex items-center gap-x-2 py-2 px-3 border border-blue-400 transition duration-300 ease-in-out hover:bg-blue-400 hover:text-white font-medium text-sm text-blue-500 tracking-wider rounded-full focus:outline-none"
                    href="{{ route('register') }}">
                    Daftar Sekarang!
                </a>
            </div>
        @endif
    @endauth
</nav>
