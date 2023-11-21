@extends('layout.app')
@section('content')
    <div class="vue-container" id="app">
        <p class="instructions">Commence par taper le titre d'une musique pour découvrir des indices:</p>
        <search-bar @send-comparaison="sendDeltaToComparaison"></search-bar>
        <h2>Musique à deviner</h2>
        <comparaison :data="deltaToSend"></comparaison>
        <h2>Propositions précédentes</h2>
        <history :data="deltaToSend"></history>
    </div>
    <!-- temporary, until navBar -->
    <a href="/song_requests/create">Proposer une musique</a>

    @vite(['resources/js/pages/game.js'])
@endsection
