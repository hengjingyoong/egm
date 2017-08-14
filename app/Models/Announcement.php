<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function school_admin()
    {
        return $this->belongsTo('App\Models\SchoolAdmin');
    }
}
