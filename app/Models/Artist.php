<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    /**
     *
     * indicates to Eloquents that there is no timestamps in the table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The genres that belong to the artist.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * The songs that belong to the artist.
     */
    public function songs(): hasMany
    {
        return $this->hasMany(Song::class);
    }
}
