<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work_value extends Model
{
    protected $table = 'work_values';
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
