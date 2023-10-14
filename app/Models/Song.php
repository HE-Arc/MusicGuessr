<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    /**
     *
     * indicates to Eloquents that there is no timestamps in the table
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

}
