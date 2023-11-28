<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('game.game');
});

Route::get('/success', function () {
    return view('game.success')->with([
        'title'      => request('title'),
        'artist'     => request('artist'),
        'spotify_id' => request('spotify_id'),
    ]);
})->name('success');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});


//Resources
Route::resource('song_requests', \App\Http\Controllers\RequestController::class)->only(['create', 'store']);

//AJAX QUERY ROUTES
Route::get('/song_beginning_with/{search_string}', [\App\Http\Controllers\SongController::class, 'getSongBeginningWith']);
Route::post('/comparison_with_answer_song', [\App\Http\Controllers\SongController::class, 'getCommonPointsBetweenSongs']);
Route::post('/start_game', [\App\Http\Controllers\GameController::class, 'startGame']);
Route::post('/end_game', [\App\Http\Controllers\GameController::class, 'endGame']);
Route::post('/has_game_started', [\App\Http\Controllers\GameController::class, 'hasGameStarted']);

require __DIR__.'/auth.php';
