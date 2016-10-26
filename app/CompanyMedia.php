<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyMedia extends Model {

    protected $guarded = ['id'];
    protected $appends = ['absolute_path'];
    protected $table = 'company_medias';

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function favoriteFilesDelete() {
        DB::table('favorite_files')->where('company_media_id', $this->id)->delete();
    }

    public function getAbsolutePathAttribute() {
        return asset(Storage::url($this->path));
    }
}
