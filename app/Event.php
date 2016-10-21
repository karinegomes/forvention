<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model {

    protected $guarded = ['id'];

    public function companies() {
        return $this->belongsToMany('App\Company');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function companyEventDelete() {
        DB::table('company_event')->where('event_id', $this->id)->delete();
    }

    public function eventUserDelete() {
        DB::table('event_user')->where('event_id', $this->id)->delete();
    }

}
