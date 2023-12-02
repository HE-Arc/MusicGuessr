@extends('layout.app')
@section('content')

<p>Hi {{ Auth::user()->name }}, this is your personal dashboard</p>
<p>Nombre de musique trouvée: {{$user_stats['nb_music_found']}}</p>
<p>Nombre d'essai sur des musiques trouvée: {{$user_stats['nb_tries']}}</p>
<p>Moyenne du nombre d'essai par musique trouvée: {{$user_stats['average_tries']}}</p>
<p>Combo de musique: {{$user_stats['music_streak']}}</p>
<p>Musique trouvées: {{$user_stats['found_songs']}}</p>

@endsection
