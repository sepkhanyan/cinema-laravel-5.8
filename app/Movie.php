<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'cinema_id',
        'title',
        'poster',
        'duration',
        'description',

    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
