<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $guarded = ['id'];

    public function companies() {
        return $this->belongsToMany('App\Company')->withPivot('role_id');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

}
