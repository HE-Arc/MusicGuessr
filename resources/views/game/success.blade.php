@extends('layout.head')
@section('body')
    @extends('layout.nav')

    <header>
        <div class="container header-container">
            <div class="title-container">
                <h1 id="main-title" class="neon-text-effect-magenta">Success</h1>
                <span id="subtitle" class="neon-text-effect-cyan">Well Done!</span>
            </div>
        </div>
    </header>

    <section class="container success-container">
        <h2>Bravo, le titre était:</h2>
        <div class="music-container neon-effect-magenta rounded">
            <h3 class="music-title neon-text-effect-cyan">Yellow</h3>
            <p class="music-artist">Coldplay</p>
        </div>
        <h2>Ecouter un extrait:</h2>
        <div class="spotify-container neon-effect-magenta">
            <iframe style="border-radius:12px"
                src="https://open.spotify.com/embed/track/7B1QliUMZv7gSTUGAfMRRD" width="100%"
                height="352" frameBorder="0" allowfullscreen=""
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
    </section>
@endsection
