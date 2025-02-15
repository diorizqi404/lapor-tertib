@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full flex items-center gap-x-3.5 py-2 px-2.5 bg-slate-400 text-sm text-gray-800 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-700 dark:text-white' // aktif
            : 'w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-300 '; // gak aktif

@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
