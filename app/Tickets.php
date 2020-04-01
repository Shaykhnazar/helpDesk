<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public const STATUS_NEW     = 'new',
                 STATUS_VIEWED  = 'viewed',
                 STATUS_OPENED  = 'open',
                 STATUS_PENDING = 'pending',
                 STATUS_SOLVED  = 'solved',
                 STATUS_CLOSED  = 'closed';
    /**
     * get the table tickets
     *
     * @var string
     */
    protected $table = 'tickets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject', 'message', 'file','thumb', 'slug', 'status', 'user_id','manager_id'];

    /**
     * Relationship with user table
     * Get the Own user for the ticket
     * One to many(inverse)
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relationship with comments table
     * One to many
     * Get the comments for the Ticket
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}

