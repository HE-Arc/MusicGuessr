@extends('layout.app')
@section('content')

<section class="small-container requested-song-form-container">
    <p>Votre proposition a été enregistrée avec succès !</p>
    <p>Titre : {{ $title }}</p>
    <p>Auteur : {{ $author }}</p>
    <a href="{{ route('song_requests.create') }}">
        <button class="btn btn-magenta" type="button">Proposer une autre musique</button>
    </a>
</section>

@endsection
