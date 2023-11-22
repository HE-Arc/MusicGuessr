@extends('layout.app')
@section('content')
    <div class="vue-container" id="app">
        <p class="instructions">Commence par taper le titre d'une musique pour découvrir des indices:</p>
        <search-bar @send-comparaison="sendDeltaToComparaison"></search-bar>
        <comparaison :data="deltaToSend"></comparaison>
        <history :data="deltaToSend"></history>
    </div>
    <!-- temporary, until navBar -->
    <a href="/song_requests/create">Proposer une musique</a>

    @vite(['resources/js/pages/game.js'])
@endsection
