<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $registered_user = Auth::user();
        $found_songs = $registered_user->songs()->get();
        $found_songs_arr = [];
        foreach ($found_songs as $song) {
            error_log($song->pivot);
            array_push($found_songs_arr, [
                'title'      => $song->track_name,
                'artist'     => $song->artist->name,
                'spotify_id' => $song->spotify_id,
                'nb_tries'   => $song->pivot->nb_tries,
                'year'       => $song->year,
                'album'      => $song->album->name,
            ]);
        }
        $tries = $registered_user->songs()->sum('nb_tries');
        $nb_music_found = $registered_user->songs()->get()->count();
        error_log($tries);
        $user_stats = [
            'nb_music_found'   => $nb_music_found,
            'nb_tries'         => $tries,
            'music_streak'     => $registered_user->music_streak,
            'average_tries'    => $nb_music_found != 0 ? $tries / $nb_music_found : 0,
            'found_songs'      => json_encode($found_songs_arr),
        ];

        return view('dashboard', ['user_stats' => $user_stats]);
    }
}
