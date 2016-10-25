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
        return $this->belongsToMany('App\Role', 'event_user')->withPivot('event_id');
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

    public function hasEditUserPermission(User $user) {

        // The user can't edit a superadmin or event creator
        if($user->mainRole && in_array($user->mainRole->constant_name, ['SUPER_ADMIN', 'EVENT_CREATOR'])) {
            return false;
        }

        $userEvents = $user->events;
        $events = $this->events;

        foreach($userEvents as $userEvent) {
            foreach($events as $event) {
                if($userEvent->id == $event->id && $this->hasEventPermission('MANAGE_USERS_EVENT', $event->id)) {
                    return true;
                }
            }
        }

        return false;

    }

    public function hasPermission($permission, $eventId = null, $companyId = null) {

        $user = Auth::user();

        if($user->mainRole) {
            if($user->mainRole->hasPermission($permission)) {
                return true;
            }
        }
        else {
            if(isset($eventId)) {
                $exists = Auth::user()->events()->where('event_id', $eventId)->exists();

                if(!$exists) {
                    // Check if the user is associated with a company that takes part in the event
                    $companies = Auth::user()->companies;

                    foreach($companies as $company) {
                        $exists = $company->events()->where('event_id', $eventId)->exists();

                        if($exists) break;
                    }

                    if(!$exists) return false;
                }
            }

            if(isset($companyId)) {
                $exists = Auth::user()->companies()->where('company_id', $companyId)->exists();

                if(!$exists) {
                    // Check if the user is associated with a company that takes part in the event
                    $events = Auth::user()->events;

                    foreach($events as $event) {
                        $exists = $event->companies()->where('company_id', $companyId)->exists();

                        if($exists) break;
                    }

                    if(!$exists) return false;
                }
            }

            if($user->eventRoles) {

                if(isset($eventId)) {
                    $role = $user->eventRoles()->where('event_id', $eventId)->first();

                    if($role)
                        return $role->hasPermission($permission);
                    else
                        return false;
                }
                else {
                    foreach($user->eventRoles as $eventRole) {
                        if($eventRole->hasPermission($permission)) {
                            return true;
                        }
                    }
                }
            }

            if($user->companyRoles) {
                if(isset($companyId)) {
                    $role = $user->companyRoles()->where('company_id', $companyId)->get()->sortBy('id')->first();

                    if($role)
                        return $role->hasPermission($permission);
                }
                else {
                    foreach($user->companyRoles as $companyRole) {
                        if($companyRole->hasPermission($permission)) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;

    }

    public function getHighestRole() {

        $role = null;

        if($this->mainRole) {
            return $this->mainRole;
        }
        else {
            if($this->eventRoles) {
                foreach($this->eventRoles as $eventRole) {
                    if($role) {
                        if($eventRole->id < $role->id) {
                            $role = $eventRole;
                        }
                    }
                    else {
                        $role = $eventRole;
                    }
                }
            }

            if($this->companyRoles) {
                foreach($this->companyRoles as $companyRole) {
                    if($role) {
                        if($companyRole->id < $role->id) {
                            $role = $companyRole;
                        }
                    }
                    else {
                        $role = $companyRole;
                    }
                }
            }
        }

        return $role;
    }

}
