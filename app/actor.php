<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    //
    public function movies()
    {
        return $this->belongsToMany(movie::class, 'actor_movies');
    }
}
