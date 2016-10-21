<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Config;

class UserController extends Controller {

    public function edit(User $user) {

        return view('user.edit')->with('user', $user);

    }

    public function update(UserRequest $request, User $user) {

        $request['password'] = bcrypt($request['password']);

        try {
            $user->update($request->except('_token', 'edit'));
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'User <strong>' . $user->name . '</strong> was successfully updated.';

        // TODO: Change redirect to users page
        return redirect('/')->with('message', $message);

    }

    public function userAutocomplete(Request $request) {

        $term = $request['term'];

        $users = User::where('email', 'like', '%' . $term . '%')->pluck('email');

        return $users;

    }

}
