<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    //AJAX QUERY FUNCTIONS
    public function startGame(Request $request): string
    {
        $answerSong = Song::where('track_popularity', '>', 70)->inRandomOrder()->first();
        $request->session()->put('answerSong', $answerSong);
        $answer = [
            'status'          => 'success',
            'title_length'    => strlen($answerSong->track_name),
            'artist_length'   => strlen($answerSong->artist->name),
            'album_length'    => strlen($answerSong->album->name),
            'nb_artist_genre' => $answerSong->artist->genres->count(),
        ];

        header('Content-Type: application/json');

        return json_encode($answer);
    }

    public function endGame(Request $request): string
    {
        $request->session()->forget('answerSong');

        $answer = [
            'status' => 'success',
        ];

        return json_encode($answer);
    }
}
