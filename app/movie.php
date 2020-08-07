<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    //
    public function actors()
    {
        return $this->belongsToMany(actor::class, 'actor_movies');
    }

    public function magnets()
    {
        return $this->hasMany(magnet::class);
    }
}
