<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public $timestamps = false;

    public function abilities()
    {
        return $this->belongsToMany('App\Models\Ability');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Models\Interest');
    }

    public function work_values()
    {
        return $this->belongsToMany('App\Models\Work_value');
    }

    public function majors()
    {
        return $this->belongsToMany('App\Models\Major');
    }

    public function decision()
    {
        return $this->hasOne('App\Models\Decision');
    }
}
