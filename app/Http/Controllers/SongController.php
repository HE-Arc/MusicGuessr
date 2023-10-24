<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    //AJAX QUERY FUNCTIONS
    public function getSongBeginningWith(Request $request, string $searchString): string
    {
        $songs_array = Song::getInfoOnSongBeginningWith($searchString);
        header('Content-Type: application/json');
        return json_encode($songs_array);
    }

    public function getCommonPointsBetweenSongs(Request $request): string
    {
        if (!$request->session()->exists('answerSong')) {
            return json_encode(['status' => 'error', 'message' => 'No answer song in session.']);
        }

        $answerSong = session('answerSong');
        $song = Song::findOrFail($request->song_id);
        $answer = $song->getComparisonArray($answerSong);
        $answer['status'] = 'success';
        header('Content-Type: application/json');

        return json_encode($answer);
    }
}
