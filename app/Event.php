<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Event extends Model {

    protected $guarded = ['id'];

    public function getDateAttribute($value) {
        $date = new \DateTime($value);

        return $date->format('Y/m/d');
    }

    public function getStartAttribute($value) {
        $date = new \DateTime($value);

        return $date->format('H:i');
    }

    public function getEndAttribute($value) {
        $date = new \DateTime($value);

        return $date->format('H:i');
    }

    public function companies() {
        return $this->belongsToMany('App\Company');
    }

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('role_id');
    }

    public function companyEventDelete() {
        DB::table('company_event')->where('event_id', $this->id)->delete();
    }

    public function eventUserDelete() {
        DB::table('event_user')->where('event_id', $this->id)->delete();
    }

    public static function countEvents() {

        if(Auth::user()->mainRole && in_array(Auth::user()->mainRole->constant_name, ['SUPER_ADMIN', 'EVENT_CREATOR'])) {
            $events = Event::all();
        }
        else {
            $events = array();

            if(Auth::user()->events)
                $events = Auth::user()->events->unique('id')->values()->all();
        }

        return count($events);
    }

}
