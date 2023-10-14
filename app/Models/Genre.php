<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    /**
     *
     * indicates to Eloquents that there is no timestamps in the table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The artists that belong to the genre.
     */
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }
}
