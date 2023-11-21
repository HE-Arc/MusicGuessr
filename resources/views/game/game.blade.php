@extends('layout.app')
@section('content')
    <div class="vue-container" id="app">
        <p class="instructions">Commence par taper le titre d'une musique pour découvrir des indices:</p>
        <search-bar @delta-with-answer-song="send-delta-to-comp"></search-bar>
        <h2>Musique à deviner</h2>
        <comparaison :></comparaison>
    </div>
    <!-- temporary, until navBar -->
    <a href="/song_requests/create">Proposer une musique</a>

    @vite(['resources/js/pages/game.js'])
@endsection
