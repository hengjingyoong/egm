<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function counselor()
    {
        return $this->hasOne('App\Models\Counselor');
    }

    public function school_admin()
    {
        return $this->hasOne('App\Models\SchoolAdmin');
    }

    public function system_admin()
    {
        return $this->hasOne('App\Models\SystemAdmin');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }
}
