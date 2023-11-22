<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    /**
     * indicates to Eloquents that there is no timestamps in the table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The artists that owns the song.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * The album that owns the song.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * The users that found the song.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Return array of common points between songs
     * Elements:
     * - isSame: bool - true if songs are the same
     * - artist_comparison: int|null - id of artist if songs have the same artist, null otherwise
     * - album_comparison: int|null - id of album if songs have the same album, null otherwise
     * - year_comparison: int - 0 if same year, 1 if answer is newer, -1 if answer is older
     * - duration_ms_comparison: int - 0 if same duration, 1 if answer is longer, -1 if answer is shorter
     * - loudness_comparison: int - 0 if same loudness, 1 if answer is louder, -1 if answer is quieter
     * - danceability_comparison: int - 0 if same danceability, 1 if answer is more danceable, -1 if answer is less danceable.
     * - energy_comparison: int - 0 if same energy, 1 if answer is more energetic, -1 if answer is less energetic.
     * - key_comparison: int - 0 if same key, 1 if answer is in a higher key, -1 if answer is in a lower key.
     * - tempo_comparison: int - 0 if same tempo, 1 if answer is faster, -1 if answer is slower.
     * - acousticness_comparison: int - 0 if same acousticness, 1 if answer is more acoustic, -1 if answer is less acoustic.
     * - speechiness_comparison: int - 0 if same speechiness, 1 if answer is more speechy, -1 if answer is less speechy.
     * - comment_genres: array - array of common genres between artists.
     * - popularity_comparison: int - 0 if same popularity, 1 if answer is more popular, -1 if answer is less popular.
     * - year: int - year of the given song.
     * - duration_ms: int - duration of the given song in milliseconds.
     * - loudness: float - loudness of the given song in decibels.
     * - danceability: float - danceability of the given song.
     * - energy: float - energy of the given song.
     * - key: int - key of the given song.
     * - tempo: float - tempo of the given song.
     * - acousticness: float - acousticness of the given song.
     * - speechiness: float - speechiness of the given song.
     * - popularity: int - popularity of the given song.
     * - name: string - name of the given song.
     * - artist_name: string - name of the artist of the given song.
     * - album_name: string - name of the album of the given song.
     * - nb_genres: int - number of genres of the artist of the answer song.
     */
    public function getComparisonArray(Song $answerSong): array
    {
        $commonPoints = [];
        $commonPoints['isSame'] = $this->id == $answerSong->id;
        $commonPoints['artist_comparison'] = $this->artist->id == $answerSong->artist->id ? $this->artist->id : null;
        $commonPoints['album_comparison'] = $this->album->id == $answerSong->album->id ? $this->album->id : null;
        $commonPoints['year_comparison'] = $this->compare($this->year, $answerSong->year);
        $commonPoints['duration_ms_comparison'] = $this->compare($this->duration_ms, $answerSong->duration_ms);
        $commonPoints['loudness_comparison'] = $this->compare($this->loudness, $answerSong->loudness);
        $commonPoints['danceability_comparison'] = $this->compare($this->danceability, $answerSong->danceability);
        $commonPoints['energy_comparison'] = $this->compare($this->energy, $answerSong->energy);
        $commonPoints['key_comparison'] = $this->compare($this->key, $answerSong->key);
        $commonPoints['tempo_comparison'] = $this->compare($this->tempo, $answerSong->tempo);
        $commonPoints['acousticness_comparison'] = $this->compare($this->acousticness, $answerSong->acousticness);
        $commonPoints['speechiness_comparison'] = $this->compare($this->speechiness, $answerSong->speechiness);
        $commonPoints['common_genres'] = $this->getCommonArtistsGenres($this->artist, $answerSong->artist);
        $commonPoints['popularity_comparison'] = $this->compare($this->track_popularity, $answerSong->track_popularity);
        $commonPoints['year'] = $this->year;
        $commonPoints['duration_ms'] = $this->duration_ms;
        $commonPoints['loudness'] = $this->loudness;
        $commonPoints['danceability'] = $this->danceability;
        $commonPoints['energy'] = $this->energy;
        $commonPoints['key'] = $this->key;
        $commonPoints['tempo'] = $this->tempo;
        $commonPoints['acousticness'] = $this->acousticness;
        $commonPoints['speechiness'] = $this->speechiness;
        $commonPoints['popularity'] = $this->track_popularity;
        $commonPoints['name'] = $this->track_name;
        $commonPoints['artist_name'] = $this->artist->name;
        $commonPoints['album_name'] = $this->album->name;
        $commonPoints['nb_genres'] = $answerSong->artist->genres->count();
        $commonPoints['artist_genres'] = $this->getSongGenres();

        return $commonPoints;
    }

    private function compare($a, $b): int|float
    {
        if ($a == $b) {
            return 0;
        }

        return $a < $b ? 1 : -1;
    }

    private function getSongGenres(): array
    {
        $genres = [];
        foreach ($this->artist->genres as $genre) {
            array_push($genres, ['genre_id' => $genre->id, 'genre_name' => $genre->name]);
        }
        return $genres;
    }

    private function getCommonArtistsGenres($artist1, $artist2): array
    {
        $commonGenres = [];
        foreach ($artist1->genres as $genre1) {
            foreach ($artist2->genres as $genre2) {
                if ($genre1->id == $genre2->id) {
                    array_push($commonGenres, ['genre_id:' => $genre1->id, 'genre_name' => $genre1->name]);
                }
            }
        }
        return $commonGenres;
    }

    public static function getInfoOnSongBeginningWith($searchString): array
    {
        $songs = Song::where('track_name', 'LIKE', $searchString.'%')->get();
        $songs_array = [];
        foreach ($songs as $song) {
            $song_array = $song->toArray();
            $song_array['artist_name'] = $song->artist->name;
            $song_array['album_name'] = $song->album->name;
            $genres = $song->artist->genres;
            $song_array['artist_genres'] = [];
            foreach ($genres as $genre) {
                array_push($song_array['artist_genres'], ['genre_id' => $genre->id, 'genre_name' => $genre->name]);
            }
            array_push($songs_array, $song_array);
        }

        return $songs_array;
    }
}
