<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Config;

class UserController extends Controller {

    public function index() {

        $users = User::all();

        return view('user.index')->with('users', $users);

    }

    public function create() {
        return view('user.create');
    }

    public function store(UserRequest $request) {

        if($request['super_admin'] == 'on') {
            $request['role_id'] = Role::where('constant_name', 'SUPER_ADMIN')->first()->id;
        }

        User::create($request->except('_token', 'edit'));

        $message = 'User <strong>' . $request->name . '</strong> was successfully created.';

        return redirect('users')->with('message', $message);

    }

    public function edit(User $user) {

        $checked = '';

        if($user->mainRole && $user->mainRole->constant_name == 'SUPER_ADMIN') {
            $checked = 'checked';
        }

        return view('user.edit')->with('user', $user)->with('checked', $checked);

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
