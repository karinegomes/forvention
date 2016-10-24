<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $guarded = ['id'];

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    public function hasPermission($permissionName) {
        return $this->permissions()->where('constant_name', $permissionName)->exists();
    }

}
