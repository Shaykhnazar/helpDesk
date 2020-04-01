<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Tickets
 */
class Tickets extends Model
{
    public const STATUS_NEW     = 'new',
                 STATUS_VIEWED  = 'viewed',
                 STATUS_OPENED  = 'open',
                 STATUS_SOLVED  = 'solved',
                 STATUS_CLOSED  = 'closed';

    /**
     * table
     *
     * @var string
     */
    protected $table = 'tickets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject', 'message', 'file','thumb', 'slug', 'status', 'user_id'];

    /**
     * Relationship with user table
     * Many to One(reverse)
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relationship with comments table
     * Many to One
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}

