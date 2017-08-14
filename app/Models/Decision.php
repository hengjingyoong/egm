<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function career()
    {
        return $this->belongsTo('App\Models\Career');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major');
    }
}
