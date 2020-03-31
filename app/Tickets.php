<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public const STATUS_NEW     = 'new',
                 STATUS_OPENED  = 'opened',
                 STATUS_SOLVED  = 'solved',
                 STATUS_CLOSED  = 'closed';

    protected $table = 'tickets';
    protected $fillable = ['subject', 'message', 'file'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}

