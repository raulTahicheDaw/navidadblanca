<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $guarded = ['id'];

    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
}
