@extends('layouts.app')
@section('content')

<div class="requested-song-form-container">
    <p class="instructions">Proposer une musique :</p>
    <form method="POST" action="/song_requests">
        @csrf
        <input type="text" name="song_name" id="song" placeholder="Titre">
        <br>
        <input type="text" name="artist_name" id="artist" placeholder="Artiste">
        <br>
        <button type="submit">Proposer</button>
    </form>
    <!-- temporary, until navBar -->
    <a href="/">Retour au jeu</a>
</div>

@vite(['resources/js/pages/game.js'])
@endsection
