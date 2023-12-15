@extends('layout.head')
@section('body')
    @include('layout.nav')

    <header>
        <div class="container header-container">
            <div class="title-container">
                <h1 id="main-title" class="neon-text-effect-magenta">Succès</h1>
                <span id="subtitle" class="neon-text-effect-cyan">Bien joué!</span>
            </div>
        </div>
    </header>

    <section class="small-container success-container">
        <h2>Bravo, le titre était:</h2>
        <div class="music-container neon-effect-magenta rounded">
            <h3 class="music-title neon-text-effect-cyan">{{ $title }}</h3>
            <p class="music-artist">{{ $artist }}</p>
        </div>
        @isset($nb_tries)
        <p class="nb-tries">Vous l'avez trouvé en {{ $nb_tries }} essais!</p>
        @endisset
        <h2>Ecouter:</h2>
        <div class="spotify-container neon-effect-magenta">
            <iframe style="border-radius:12px"
                src="https://open.spotify.com/embed/track/{{ $spotify_id }}" width="100%"
                height="352" frameBorder="0" allowfullscreen=""
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
        <div class="button-container">
            <a href="/" class="btn btn-cyan">Rejouer</a>
        </div>
    </section>
@endsection
