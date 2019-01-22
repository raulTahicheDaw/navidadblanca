<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function conductor()
    {
        return $this->belongsTo('App\Conductor');
    }
}
