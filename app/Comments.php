<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Comments
 */
class Comments extends Model
{
    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id'];

    /**
     * Relationship with tickets table
     * Many to One(reverse)
     *
     * @return void
     */
    public function tickets()
    {
        return $this->belongsTo('App\Tickets');
    }
}
