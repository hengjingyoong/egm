<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $table = 'abilities';
    public $timestamps = false;

    public function careers()
    {
        return $this->belongsToMany('App\Models\Career');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student');
    }
}
