<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public const STATUS_NEW     = 'new',      // new created
                 STATUS_PENDING = 'pending',  // viewed but not answered
                 STATUS_VIEWED  = 'viewed',   // viewed by manager
                 STATUS_OPEN    = 'open',     // not closed
                 STATUS_ANSWERED= 'answered', // before viewed after answered
                 STATUS_SOLVED  = 'solved',   // before answered after solved
                 STATUS_CLOSED  = 'closed';   // closed by user
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
        return $this->belongsTo('App\User', 'user_id', 'id');
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
        return $this->hasMany('App\Comments', 'ticket_id', 'id');
    }
}

