<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyMedia;
use App\Http\Requests\AddUserCompanyRequest;
use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller {

    public function index() {

        // TODO: Show companies depending on the user role
        $companies = Company::all();

        return view('company.index')->with('companies', $companies);

    }

    public function create() {

        return view('company.create');

    }

    public function store(CompanyRequest $request) {

        // TODO: Store logo
        // TODO: Change logo path

        Company::create($request->except('_token', 'edit'));

        $message = 'Company <strong>' . $request->name . '</strong> was successfully created.';

        return redirect('companies')->with('message', $message);

    }

    public function show(Company $company) {
        return view('company.show')->with('company', $company);
    }

    public function edit(Company $company) {

        return view('company.edit')->with('company', $company);

    }

    public function update(CompanyRequest $request, Company $company) {

        // TODO: Store logo
        // TODO: Change logo path

        $except = ['_token', 'edit'];

        if($request->logo == null)
            array_push($except, 'logo');

        $company->update($request->except($except));

        $message = 'Company <strong>' . $company->name . '</strong> was successfully updated.';

        return redirect('companies')->with('message', $message);

    }

    public function destroy(Company $company) {

        try {
            $company->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return redirect('companies')->with('error', $error);
        }

        $message = 'Company <strong>' . $company->name . '</strong> was successfully removed.';

        return redirect('companies')->with('message', $message);

    }

    public function addUserView(Company $company) {

        //$roles = Role::all();
        $roles = Role::where('constant_name', 'PRESENTOR')->get();

        return view('company.user.add')->with('company', $company)->with('roles', $roles);

    }

    public function addUser(Company $company, AddUserCompanyRequest $request) {

        $companyId = $company->id;
        $userId = User::where('email', $request['email'])->first()->id;
        $roleId = $request['role'];

        $exists = DB::table('company_user')->where('user_id', $userId)->where('company_id', $companyId)
            ->where('role_id', $roleId)->exists();

        if($exists) {
            $error = 'The email ' . $request['email'] . ' was already added to ' . $company->name . ' for the selected
                role.';

            return back()->withInput($request->except('_token', 'role'))->with('error', $error);
        }

        try {
            DB::table('company_user')->insert([
                'user_id' => $userId,
                'company_id' => $companyId,
                'role_id' => $roleId
            ]);
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'The user was successfully added to ' . $company->name . '.';

        return redirect('companies')->with('message', $message);

    }

    public function viewUsers(Company $company) {

        $users = $company->users;

        return view('company.user.index')->with('company', $company)->with('users', $users);

    }

    public function deleteUser(Company $company, User $user, Role $role) {

        try {
            DB::table('company_user')
                ->where('company_id', $company->id)
                ->where('user_id', $user->id)
                ->where('role_id', $role->id)
                ->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->with('error', $error);
        }

        $message = 'User ' . $user->name . ' was successfully removed from company ' . $company->name . '.';

        return back()->with('message', $message);

    }

}
