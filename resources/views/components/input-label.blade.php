@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-md mb-2 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
