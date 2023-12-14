@extends('layout.app')
@section('content')
    <section class="container stats-container">
        <h2>{{ Auth::user()->name }}:</h2>
        <div class="stats rounded neon-effect-magenta">
            <span>Nombre de musique trouvée:</span>
            <span>{{ $user_stats['nb_music_found'] }}</span>
            <span>Nombre de de tentative totale:</span>
            <span>{{ $user_stats['nb_tries'] }}</span>
            <span>Moyenne du nombre d'essai par musique:</span>
            <span>{{ $user_stats['average_tries'] }}</span>
            <span>Combo de musique:</span>
            <span>{{ $user_stats['music_streak'] }}</span>
            <span>Musiques trouvées:</span>
            <span>
                @foreach (json_decode($user_stats['found_songs']) as $song)
                    {{$song->title }} - {{ $song->artist }}<br>
                @endforeach

            </span>
        </div>
    </section>
@endsection
