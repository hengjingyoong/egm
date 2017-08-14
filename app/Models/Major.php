<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $timestamps = false;

    public function careers()
    {
        return $this->belongsToMany('App\Models\Career');
    }

    public function schools()
    {
        return $this->belongsToMany('App\Models\School');
    }

    public function decision()
    {
        return $this->hasOne('App\Models\Decision');
    }
}
