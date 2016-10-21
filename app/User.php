<?php

namespace App;

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
        'name', 'email', 'phone', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companies() {
        return $this->belongsToMany('App\Company')->withPivot('role_id');
    }

    public function events() {
        return $this->belongsToMany('App\Event')->withPivot('role_id');
    }

    public function companyRoles() {
        return $this->belongsToMany('App\Role', 'company_user');
    }

    public function eventRoles() {
        return $this->belongsToMany('App\Role', 'event_user');
    }

    public function roleName($columnName, $key, $roles) {
        return $roles->where($columnName, $key)->first()->name;
    }

    public function role($columnName, $key, $roles) {
        return $roles->where($columnName, $key)->first();
    }

    public function mainRole() {
        return $this->belongsTo('App\Role', 'role_id');
    }

}
