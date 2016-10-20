<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $guarded = ['id'];

    public function companies() {
        return $this->belongsToMany('App\Company')->withPivot('role_id');
    }

    public function user() {
        return $this->belongsToMany('App\User')->withPivot('role_id');
    }

}
