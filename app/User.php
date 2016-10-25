<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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

    public function hasEventPermission($permission, $eventId = null, $companyId = null) {

        $roles = $this->eventRoles;

        if(isset($eventId)) {
            $exists = Auth::user()->events()->where('event_id', $eventId)->exists();

            if(!$exists)
                return false;
        }

        if(isset($companyId)) {
            $exists = Auth::user()->events()->whereHas('companies', function($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->exists();

            if(!$exists)
                return false;
        }

        $hasPermission = false;

        foreach ($roles as $role) {
            $hasPermission = $role->hasPermission($permission);

            if($hasPermission)
                break;
        }

        return $hasPermission;

    }

    public function hasCompanyPermission($permission, $companyId = null, $eventId = null) {

        if(isset($companyId)) {
            $exists = Auth::user()->companies()->where('company_id', $companyId)->exists();

            if(!$exists) {
                $events = Auth::user()->events;
                $companyEvents = Company::find($companyId)->events;

                foreach($events as $event) {
                    foreach($companyEvents as $companyEvent) {
                        if($event->id == $companyEvent->id) {
                            return true;
                        }
                    }
                }
            }
            else {
                return true;
            }
        }

        if(isset($eventId)) {
            $exists = Auth::user()->companies()->whereHas('events', function($query) use ($eventId) {
                $query->where('event_id', $eventId);
            })->exists();

            if(!$exists)
                return false;
        }

        $roles = $this->companyRoles;

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

    public function isPresentor() {
        return $this->companyRoles()->where('constant_name', 'PRESENTOR')->exists();
    }

    public function hasManageCompanyInfoPermission($companyId = null) {

        $permission = Permission::where('constant_name', 'MANAGE_COMPANY_INFO')->first();
        $roles = $permission->roles;

        $exists = false;

        foreach($roles as $role) {
            $companies = $this->companies();

            if(isset($companyId)) {
                $companies = $companies->where('companies.id', $companyId);
            }

            $exists = $companies->where('role_id', $role->id)->exists();

            if($exists) break;
        }

        return $exists;

    }

}
