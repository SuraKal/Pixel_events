@props(['color'])

@php
    $classList = "bg-{$color}-100 text-{$color}-800  font-medium me-2 px-2.5 py-0.5 rounded dark:bg-{$color}-900 dark:text-{$color}-300 text-xs";
@endphp

<span {{ $attributes->merge(['class' => $classList]) }}>
    {{ $slot }}
</span>
