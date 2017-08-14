<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Models\Interest')->withPivot('primary');
    }

    public function abilities()
    {
        return $this->belongsToMany('App\Models\Ability');
    }

    public function work_values()
    {
        return $this->belongsToMany('App\Models\Work_value')->withPivot('primary');
    }

    public function decision()
    {
        return $this->hasOne('App\Models\Decision');
    }
}
