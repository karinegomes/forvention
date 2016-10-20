<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller {

    public function userAutocomplete(Request $request) {

        $term = $request['term'];

        $users = User::where('email', 'like', '%' . $term . '%')->pluck('email');

        return $users;

    }

}
