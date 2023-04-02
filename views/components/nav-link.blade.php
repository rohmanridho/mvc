@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-semibold leading-5 text-purple-900'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-400 hover:text-purple-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
