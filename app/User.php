<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    //User roles
    const ROLE_MANAGER = 1;
    const ROLE_USER    = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with tickets table
     * Get the Tickets of user
     * One to many
     *
     * @return void
     */
    public function tickets()
    {
        return $this->hasMany('App\Tickets', 'user_id', 'id');
    }

    /**
     * Relationship with comments table
     * Get the Comments of user
     * Many to many
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comments', 'user_id', 'id');
    }

}

