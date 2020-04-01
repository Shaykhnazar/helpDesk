<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public const STATUS_NEW     = 'new',
                 STATUS_VIEWED  = 'viewed',
                 STATUS_OPENED  = 'open',
                 STATUS_SOLVED  = 'solved',
                 STATUS_CLOSED  = 'close';

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

