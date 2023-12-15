<!-- song_request.blade.php -->
@extends('layout.app')
@section('content')

<div class="neon-effect-magenta p-6 rounded-xl shadow-md max-w-lg mx-auto my-auto">
    <p class="instructions">Proposer une musique :</p>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="/song_requests">
        @csrf

        <!-- Song Name -->
        <div>
            <x-input-label for="song" :value="__('Titre de la musique')" />
            <x-text-input id="song" class="block mt-1 w-full" type="text" name="song_name" :value="old('song_name')" required autofocus />
            <x-input-error :messages="$errors->get('song_name')" class="mt-2" />
        </div>

        <!-- Artist Name -->
        <div class="mt-4">
            <x-input-label for="artist" :value="__('Nom de l\'artiste')" />
            <x-text-input id="artist" class="block mt-1 w-full" type="text" name="artist_name" :value="old('artist_name')" required />
            <x-input-error :messages="$errors->get('artist_name')" class="mt-2" />
        </div>

        <button type="submit" class="mt-4">Proposer</button>
    </form>
</div>

@endsection