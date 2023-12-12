@extends('layout.app')
@section('content')

    <div class="vue-container" id="app">
        <p class="instructions">Commence par taper le titre d'une musique pour découvrir des indices:</p>
        <search-bar @send-comparaison="sendDeltaToComparaison"></search-bar>
        <comparaison :data="deltaToSend" @clear-history="$refs.historyComponent.clearHistory()"></comparaison>
        <history :data="deltaToSend" ref="historyComponent"></history>
    </div>
    @vite(['resources/js/pages/game.js'])
@endsection
