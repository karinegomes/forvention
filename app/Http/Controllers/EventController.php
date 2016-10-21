<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Http\Requests\AddUserRequest;
use App\Role;
use App\User;
use Exception;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EventController extends Controller {

    public function index() {

        $events = Event::all();

        return view('event.index')->with('events', $events);

    }

    public function create() {
        return view('event.create');
    }

    public function store(EventRequest $request) {

        $start = new DateTime($request['start']);
        $end = new DateTime($request['end']);

        $request['start'] = $start->format('H:i');
        $request['end'] = $end->format('H:i');

        try {
            Event::create($request->except('_token', 'edit'));
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'Event <strong>' . $request['title'] . '</strong> was successfully created.';

        return redirect('events')->with('message', $message);

    }

    public function show($id) {
        //
    }

    public function edit(Event $event) {

        $date = new DateTime($event->date);
        $event->date = $date->format('Y/m/d');

        return view('event.edit')->with('event', $event);

    }

    public function update(EventRequest $request, Event $event) {

        $start = new DateTime($request['start']);
        $end = new DateTime($request['end']);

        $request['start'] = $start->format('H:i');
        $request['end'] = $end->format('H:i');

        try {
            $event->update($request->except('_token', 'edit'));
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'Event <strong>' . $event->title . '</strong> was successfully updated.';

        return redirect('events')->with('message', $message);

    }

    public function destroy(Event $event) {

        try {
            $event->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return redirect('events')->with('error', $error);
        }

        $message = 'Event <strong>' . $event->title . '</strong> was successfully removed.';

        return redirect('events')->with('message', $message);

    }

    public function addUserView(Event $event) {

        //$roles = Role::all();
        $roles = Role::where('constant_name', 'VISITOR')->get();

        return view('event.user.add')->with('event', $event)->with('roles', $roles);

    }

    public function addUser(Event $event, AddUserRequest $request) {

        $eventId = $event->id;
        $userId = User::where('email', $request['email'])->first()->id;
        $roleId = $request['role'];

        $exists = DB::table('event_user')->where('user_id', $userId)->where('event_id', $eventId)
            ->where('role_id', $roleId)->exists();

        if($exists) {
            $error = 'The email ' . $request['email'] . ' was already added to ' . $event->title . ' for the selected
                role.';

            return back()->withInput($request->except('_token', 'role'))->with('error', $error);
        }

        try {
            DB::table('event_user')->insert([
                'user_id' => $userId,
                'event_id' => $eventId,
                'role_id' => $roleId
            ]);
        }
        catch(Exception $e) {
            //$error = Config::get('constants.ERROR_MESSAGE');
            $error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'The user was successfully added to ' . $event->title . '.';

        return redirect('events')->with('message', $message);

    }

    public function viewUsers(Event $event) {

        $users = $event->users;

        return view('event.user.index')->with('event', $event)->with('users', $users);

    }

    public function deleteUser(Event $event, User $user, Role $role) {

        try {
            DB::table('event_user')
                ->where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->where('role_id', $role->id)
                ->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->with('error', $error);
        }

        $message = 'User ' . $user->name . ' was successfully removed from the event ' . $event->title . '.';

        return back()->with('message', $message);

    }

    public function addCompanyView(Event $event) {

        /*SELECT DISTINCT * FROM companies
        WHERE NOT EXISTS (SELECT * FROM company_event
                          WHERE companies.id = company_event.company_id
                          AND company_event.event_id = 3)*/

        $companies = Company::whereNotExists(function($query) use ($event){
            $query->select('company_id')
                ->from('company_event')
                ->whereRaw('companies.id = company_event.company_id')
                ->whereRaw('company_event.event_id = ?', [$event->id]);
        })->get();

        return view('event.company.add')->with('event', $event)->with('companies', $companies);

    }

    public function addCompany(Request $request, Event $event) {

        $companiesIds = $request['company'];

        try {
            foreach($companiesIds as $companyId) {
                DB::table('company_event')->insert([
                    'event_id' => $event->id,
                    'company_id' => $companyId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->with('error', $error);
        }

        $message = 'The companies were successfully added to the event ' . $event->title . '.';

        return redirect('events')->with('message', $message);

    }

    public function viewCompanies(Event $event) {

        $companies = $event->companies;

        return view('event.company.index')->with('event', $event)->with('companies', $companies);

    }

    public function deleteCompany(Event $event, Company $company) {

        try {
            DB::table('company_event')
                ->where('event_id', $event->id)
                ->where('company_id', $company->id)
                ->delete();
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');

            return back()->with('error', $error);
        }

        $message = 'Company ' . $company->name . ' was successfully removed from the event ' . $event->title . '.';

        return back()->with('message', $message);

    }

}
