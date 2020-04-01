<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
     * get the table comments
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id', 'text'];

    /**
     * Relationship with tickets table
     * Get the owns ticket of the comments
     * One to many(inverse)
     *
     * @return void
     */
    public function tickets()
    {
        return $this->belongsTo('App\Tickets');
    }

    /**
     * Relationship with user table
     * Get the owns User of the Comments
     * Many to many
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\Users');
    }


}
