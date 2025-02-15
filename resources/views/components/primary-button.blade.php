@props(['withIcon' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center px-4 py-2.5 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-sm text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    @if (filter_var($withIcon, FILTER_VALIDATE_BOOLEAN))
        <x-heroicon-o-pencil-square class="w-6 h-6 mr-2" />
    @endif
        
    {{ $slot }}
</button>
