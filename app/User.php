<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    public function companyUserDelete() {
        DB::table('company_user')->where('user_id', $this->id)->delete();
    }

    public function eventUserDelete() {
        DB::table('event_user')->where('user_id', $this->id)->delete();
    }

    public function favoriteCompaniesDelete() {
        DB::table('favorite_companies')->where('user_id', $this->id)->delete();
    }

    public function favoriteFilesDelete() {
        DB::table('favorite_files')->where('user_id', $this->id)->delete();
    }

    public function favoriteProductsDelete() {
        DB::table('favorite_products')->where('user_id', $this->id)->delete();
    }

    public function hasEventPermission($permission) {

        $roles = $this->eventRoles;

        $hasPermission = false;

        foreach ($roles as $role) {
            $hasPermission = $role->hasPermission($permission);

            if($hasPermission)
                break;
        }

        return $hasPermission;

    }

    public function isVisitor() {
        return $this->eventRoles()->where('constant_name', 'VISITOR')->exists();
    }

}
