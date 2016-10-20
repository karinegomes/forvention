<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model {

    protected $guarded = ['id'];

    public function events() {
        return $this->belongsToMany('App\Event');
    }

    public function medias() {
        return $this->hasMany('App\CompanyMedia');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('role_id');
    }

    public function address() {
        return $this->address . ", " . $this->city . " " . $this->state . ", " . $this->zip_code . " " . $this->country;
    }

    public function companyEventDelete() {
        DB::table('company_event')->where('company_id', $this->id)->delete();
    }

    public function companyUserDelete() {
        DB::table('company_user')->where('company_id', $this->id)->delete();
    }

    public function favoriteCompaniesDelete() {
        DB::table('favorite_companies')->where('company_id', $this->id)->delete();
    }

}
