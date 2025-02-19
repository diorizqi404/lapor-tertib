@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-md mb-1 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
