<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('game.index');
});



//Resources
Route::resource('song_requests', \App\Http\Controllers\RequestController::class)->only(['create', 'store']);

//AJAX QUERY ROUTES
Route::get('/get_song_beginning_with/{search_string}', [\App\Http\Controllers\SongController::class, 'getSongBeginningWith']);
Route::post('/get_comparison_with_answer_song', [\App\Http\Controllers\SongController::class, 'getCommonPointsBetweenSongs']);
