<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'row',
        'sit'

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
