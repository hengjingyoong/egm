<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interests';
    public $timestamps = false;

    public function careers()
    {
        return $this->belongsToMany('App\Models\Career');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student')->withPivot('primary');
    }
}
