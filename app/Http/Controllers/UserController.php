<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Config;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('manage_users', ['except' => ['userAutocomplete']]);
    }

    public function index() {

        $users = User::all();

        return view('user.index')->with('users', $users);

    }

    public function create() {

        //$roles = Role::whereIn('constant_name', ['SUPER_ADMIN', 'EVENT_CREATOR']);

        return view('user.create');
    }

    public function store(UserRequest $request) {

        if($request['super_admin'] == 'on') {
            $request['role_id'] = Role::where('constant_name', 'SUPER_ADMIN')->first()->id;
        }
        else if($request['event_creator'] == 'on') {
            $request['role_id'] = Role::where('constant_name', 'EVENT_CREATOR')->first()->id;
        }

        $request['password'] = bcrypt($request['password']);

        User::create($request->except('_token', 'edit'));

        $message = 'User <strong>' . $request->name . '</strong> was successfully created.';

        return redirect('users')->with('message', $message);

    }

    public function edit(User $user) {

        $roleName = '';

        if($user->mainRole)
            $roleName = $user->mainRole->constant_name;

        return view('user.edit')->with('user', $user)->with('roleName', $roleName);

    }

    public function update(UserRequest $request, User $user) {

        if($request['password'] != '')
            $request['password'] = bcrypt($request['password']);
        else
            $request['password'] = $user->password;

        if($request['super_admin'] == 'on')
            $request['role_id'] = Role::where('constant_name', 'SUPER_ADMIN')->first()->id;
        else if($request['event_creator'] == 'on')
            $request['role_id'] = Role::where('constant_name', 'EVENT_CREATOR')->first()->id;

        try {
            $user->update($request->except('_token', 'edit'));
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'User <strong>' . $user->name . '</strong> was successfully updated.';

        return redirect('users')->with('message', $message);

    }

    public function destroy(User $user) {

        try {
            $user->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return redirect('users')->with('error', $error);
        }

        $message = 'User <strong>' . $user->name . '</strong> was successfully removed.';

        return redirect('users')->with('message', $message);

    }

    public function userAutocomplete(Request $request) {

        $term = $request['term'];

        $users = User::where('email', 'like', '%' . $term . '%')->pluck('email');

        return $users;

    }

}
