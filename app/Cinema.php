<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = [
        'title',
        'address'
    ];

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
