<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model {

    protected $guarded = ['id'];

    public function products() {
        return $this->belongsToMany('App\Product');
    }

    public function productTagDelete() {
        DB::table('product_tag')->where('tag_id', $this->id)->delete();
    }

}
