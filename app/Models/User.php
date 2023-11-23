<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * indicates to Eloquents that there is no timestamps in the table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * set default values.
     */
    protected $attributes = [
        'nb_music_found' => 0,
        'music_streak'   => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    /**
     * The songs that the user found.
     */
    /**public function songs(): belongsToMany
    {
        return $this->belongsToMany(Song::class);
    }*/
}
