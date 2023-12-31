<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    //AJAX QUERY FUNCTIONS
    public function getSongBeginningWith(Request $request, string $searchString): string
    {
        $songs_array = Song::getInfoOnSongBeginningWith($searchString);
        header('Content-Type: application/json');
        http_response_code(200);

        return json_encode($songs_array);
    }

    public function getCommonPointsBetweenSongs(Request $request): string
    {
        if (!$request->session()->exists('answerSong')) {
            return response(json_encode(['message' => 'No answer song in session, start the game and retry.']), 449)->header('Content-Type', 'application/json');
        }

        session()->increment('nb_tries');
        $answerSong = session('answerSong');
        $song = Song::findOrFail($request->song_id);
        $answer = $song->getComparisonArray($answerSong);

        if ($answer['isSame'] === true) {
            $request->session()->forget('answerSong');
            if (Auth::check()) {
                $authUser = Auth::user();
                $authUser->music_streak++;
                $authUser->songs()->attach($song->id, ['nb_tries' => session('nb_tries')]);
                $authUser->save();
            }
        }

        header('Content-Type: application/json');
        http_response_code(200);

        return json_encode($answer);
    }

    public function getLetterAtIndexInAnswer(Request $request): string
    {
        if (!$request->session()->exists('answerSong')) {
            return response(json_encode(['message' => 'No answer song in session, start the game and retry.']), 449)->header('Content-Type', 'application/json');
        }
        $answerSong = session('answerSong');
        $answer = ['index' => $request->index, 'hint' => $answerSong->track_name[$request->index]];
        header('Content-Type: application/json');
        http_response_code(200);

        return json_encode($answer);
    }
}
