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
     * - artist: int|null - id of artist if songs have the same artist, null otherwise
     * - album: int|null - id of album if songs have the same album, null otherwise
     * - year: int - 0 if same year, 1 if answer is newer, -1 if answer is older
     * - duration_ms: int - 0 if same duration, 1 if answer is longer, -1 if answer is shorter
     * - loudness: int - 0 if same loudness, 1 if answer is louder, -1 if answer is quieter
     * - danceability: int - 0 if same danceability, 1 if answer is more danceable, -1 if answer is less danceable
     */
    public function getComparisonArray(Song $answerSong): array
    {
        $commonPoints = [];
        $commonPoints["isSame"] = $this->id == $answerSong->id;
        $commonPoints["artist"] = $this->artist->id == $answerSong->artist->id ? $this->artist->id : null;
        $commonPoints["album"] = $this->album->id == $answerSong->album->id ? $this->album->id : null;
        $commonPoints["year"] = $this->compare($this->year, $answerSong->year);
        $commonPoints["duration_ms"] = $this->compare($this->duration_ms, $answerSong->duration_ms);
        $commonPoints["loudness"] = $this->compare($this->loudness, $answerSong->loudness);
        $commonPoints["danceability"] = $this->compare($this->danceability, $answerSong->danceability);
        $commonPoints["energy"] = $this->compare($this->energy, $answerSong->energy);
        $commonPoints["key"] = $this->compare($this->key, $answerSong->key);
        $commonPoints["tempo"] = $this->compare($this->tempo, $answerSong->tempo);
        $commonPoints["acousticness"] = $this->compare($this->acousticness, $answerSong->acousticness);
        $commonPoints["speechiness"] = $this->compare($this->speechiness, $answerSong->speechiness);

        return $commonPoints;
    }

    private function compare($a, $b): int|float
    {
        if($a == $b)
            return 0;
        return $a > $b ? 1 : -1;
    }
}
