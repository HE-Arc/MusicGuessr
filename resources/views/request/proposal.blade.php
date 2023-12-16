<!-- song_request.blade.php -->
@extends('layout.app')
@section('content')

<div class="p-6 rounded-xl shadow-md max-w-lg mx-auto my-auto">
    <p class="instructions">Proposer une musique à ajouter à la liste :</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="/song_requests" id="songRequestForm">
        @csrf

        <!-- Song Name -->
        <div>
            <x-input-label for="song" :value="__('Titre de la musique')" />
            <x-text-input id="song" class="block mt-1 w-full" type="text" name="song_name" :value="old('song_name')" required autofocus />
            <x-input-error :messages="$errors->get('song_name')" class="mt-2" />
            <span id="songErrorMessage" class="text-red-500"></span>
        </div>

        <!-- Artist Name -->
        <div class="mt-4">
            <x-input-label for="artist" :value="__('Nom de l\'artiste')" />
            <x-text-input id="artist" class="block mt-1 w-full" type="text" name="artist_name" :value="old('artist_name')" required />
            <x-input-error :messages="$errors->get('artist_name')" class="mt-2" />
            <span id="artistErrorMessage" class="text-red-500"></span>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="mt-4 btn btn-magenta">Proposer</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('songRequestForm').addEventListener('submit', function (event) {
        var songInput = document.getElementById('song');
        var artistInput = document.getElementById('artist');
        var songErrorMessage = document.getElementById('songErrorMessage');
        var artistErrorMessage = document.getElementById('artistErrorMessage');

        songErrorMessage.innerHTML = '';  // Réinitialise les messages d'erreur
        artistErrorMessage.innerHTML = '';

        if (songInput.value.length > 25) {
            songErrorMessage.innerHTML = 'Le titre de la musique ne peut pas dépasser 25 caractères.';
            event.preventDefault();
        }

        if (artistInput.value.length > 25) {
            artistErrorMessage.innerHTML = 'Le nom de l\'artiste ne peut pas dépasser 25 caractères.';
            event.preventDefault();
        }
    });
</script>
@endsection
