<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $guarded = ['id'];

    public function products() {
        return $this->belongsToMany('App\Product');
    }

}
