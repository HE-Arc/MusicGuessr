<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    //AJAX QUERY FUNCTIONS
    public function getSongBeginningWith(Request $request, string $searchString): string
    {
        $songs = Song::where('track_name', 'LIKE', $searchString.'%')->get();
        header('Content-Type: application/json');

        return json_encode($songs);
    }

    public function getCommonPointsBetweenSongs(Request $request): string
    {
        if (!$request->session()->exists('answerSong')) {
            $request->session()->put('answerSong', Song::where('track_popularity', '>', 70)->inRandomOrder()->first());
        }

        $answerSong = session('answerSong');
        $song = Song::findOrFail($request->song_id);
        $answer = $song->getComparisonArray($answerSong);
        header('Content-Type: application/json');

        return json_encode($answer);
    }
}
