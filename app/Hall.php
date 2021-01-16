<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'cinema_id',
        'title',
        'rows',
        'chairs',

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
