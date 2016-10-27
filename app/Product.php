<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model {

    protected $guarded = ['id'];
    protected $appends = ['image_absolute_path'];

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function getImageAbsolutePathAttribute() {
        return asset(Storage::url($this->image));
    }

    public function implodedTags() {
        return implode(',', $this->tags()->pluck('name')->toArray());
    }

    public function tagsDelete() {

        foreach($this->tags as $tag) {
            $tag->delete();
        }

    }
}
