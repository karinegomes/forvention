<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $guarded = ['id'];

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
