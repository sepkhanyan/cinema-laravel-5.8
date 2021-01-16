<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'cinema_id',
        'movie_id',
        'hall_id',
        'start_time',
        'end_time'

    ];


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}
