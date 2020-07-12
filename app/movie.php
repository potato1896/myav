<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    //

    public function magnets()
    {
        return $this->hasMany(magnet::class);
    }
}
