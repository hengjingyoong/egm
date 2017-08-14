<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAdmin extends Model
{
    protected $table = 'school_admins';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function announcements()
    {
        return $this->hasMany('App\Models\Announcement');
    }
}
