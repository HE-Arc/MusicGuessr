<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     *
     * indicates to Eloquents that there is no timestamps in the table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     *
     * set default values
     *
     */
    protected $attributes = [
        'nb_music_found' => 0,
        'music_streak' => 0,
    ];
}
