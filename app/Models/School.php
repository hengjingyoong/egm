<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;

    public function majors()
    {
        return $this->belongsToMany('App\Models\Major');
    }
}
