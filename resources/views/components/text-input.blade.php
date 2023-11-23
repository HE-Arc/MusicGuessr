@props(['disabled' => false])

@php
$roundedInputClasses = 'border border-blue-500 bg-transparent text-gray-300 shadow-sm rounded-input';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $roundedInputClasses]) !!}>
