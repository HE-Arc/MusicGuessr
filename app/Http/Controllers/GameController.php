<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'title_length'    => strlen($answerSong->track_name),
            'artist_length'   => strlen($answerSong->artist->name),
            'album_length'    => strlen($answerSong->album->name),
            'nb_artist_genre' => $answerSong->artist->genres->count(),
        ];
        header('Content-Type: application/json');
        http_response_code(200);

        return json_encode($answer);
    }

    public function endGame(Request $request): string
    {
        $request->session()->forget('answerSong');
        if (Auth::check()) {
            $authUser = Auth::user();
            $authUser->music_streak = 0;
            $authUser->save();
        }
        http_response_code(204);

        return '';
    }

    public function hasGameStarted(Request $request)
    {
        header('Content-Type: application/json');
        http_response_code(200);
        if ($request->session()->exists('answerSong')) {
            return json_encode(['is_started' => true]);
        } else {
            return json_encode(['is_started' => false]);
        }
    }
}
