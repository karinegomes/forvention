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
        'name', 'email', 'password',
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

    public function roles() {
        return $this->belongsToMany('App\Role', 'company_user');
    }

    public function roleName($companyId) {
        return $this->roles()->where('company_id', $companyId)->first()->name;
    }

    public function role($companyId) {
        return $this->roles()->where('company_id', $companyId)->first();
    }

}
