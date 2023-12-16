<!-- forgot-password.blade.php -->
@extends('layout.app')
@section('content')

<div class="neon-effect-magenta p-6 rounded-xl shadow-md max-w-lg mx-auto my-auto">
    <p class="instruction">

        {{ __('Mot de passe oublié? Pas de problème, notre équipe de dev fait tous son possible pour mettre en place un système de mail fonctionnel.') }}
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <p>
                {{ __('A venir prochainement') }}
            </p>
        </div>
    </form>
</div>
@endsection
