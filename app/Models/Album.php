<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    /**
     * indicates to Eloquents that there is no timestamps in the table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The songs that belong to the album.
     */
    public function songs(): hasMany
    {
        return $this->hasMany(Song::class);
    }
}
