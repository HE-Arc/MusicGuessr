@extends('layout.app')
@section('content')

<div class="requested-song-form-container">
    <p>Votre proposition a été enregistrée avec succès !</p>
    <p>Titre : {{ $title }}</p>
    <p>Auteur : {{ $author }}</p>
    <a href="{{ route('song_requests.create') }}">
        <button class="requested-song-form-container" type="button">Proposer une autre musique</button>
    </a>

    <a href="/">Retour au jeu</a>

</div>

@vite(['resources/js/pages/game.js'])
@endsection
