@props(['disabled' => false])

@php
$roundedInputClasses = 'border border-blue-500 bg-transparent text-gray-300 shadow-sm neon-effect-cyan-off rounded';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $roundedInputClasses]) !!}>
