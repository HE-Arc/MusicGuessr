<?php

namespace App\Http\Controllers;

use App\Models\SongRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $songRequest = SongRequest::create($request->only(['song_name', 'artist_name']));
        //return redirect()->route('song_requests.create');
        return view('request.confirmation')->with(['title' => $songRequest->song_name, 'author' => $songRequest->artist_name]);
    }
}
