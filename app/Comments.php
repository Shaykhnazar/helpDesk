<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['ticket_id', 'user_id'];


    public function tickets()
    {
        return $this->belongsTo('App\Tickets');
    }
}
