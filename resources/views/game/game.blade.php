@extends('layout.app')
@section('content')

<div class="search-bar-container" id="app">
    <p class="instructions">Commence par taper le titre d'une musique pour découvrir des indices:</p>
    <search-bar></search-bar>
</div>

@vite(['resources/js/pages/game.js'])
@endsection
