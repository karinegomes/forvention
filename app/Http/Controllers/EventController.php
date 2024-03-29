<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Http\Requests\AddUserRequest;
use App\Role;
use App\Traits\Utils;
use App\User;
use Exception;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller {

    public function __construct() {
        $this->middleware('manage_events', ['only' => ['create', 'store', 'show', 'destroy', 'addAdminView', 'viewAdmins']]);
        $this->middleware('manage_events.companies', ['only' => ['addCompanyView', 'addCompany', 'deleteCompany']]);
        $this->middleware('manage_events.users', ['only' => ['addUserView', 'addUser', 'viewUsers', 'deleteUser']]);
        $this->middleware('manage_events.edit', ['only' => ['edit', 'update']]);
        $this->middleware('manage_events.view_companies', ['only' => ['viewCompanies']]);
        $this->middleware('manage_events.view', ['only' => ['index']]);
    }

    public function index() {

        if(Auth::user()->mainRole && in_array(Auth::user()->mainRole->constant_name, ['SUPER_ADMIN', 'EVENT_CREATOR'])) {
            $events = Event::all();
        }
        else {
            $events = array();

            if(Auth::user()->events)
                $events = Auth::user()->events->unique('id')->values()->all();
        }

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
            $path = $request->file('image')->store('events');

            $event = Event::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'image' => $path,
                'date' => $request['date'],
                'start' => $request['start'],
                'end' => $request['end'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::table('event_user')->insert([
                'user_id' => Auth::user()->id,
                'event_id' => $event->id,
                'role_id' => Auth::user()->role_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'Event <strong>' . $request['title'] . '</strong> was successfully created.';

        return redirect('events')->with('message', $message);

    }

    public function show(Event $event) {

        $event->image = Storage::url($event->image);

        return view('event.show')->with('event', $event);
    }

    public function edit(Event $event) {

        $date = new DateTime($event->date);
        $event->date = $date->format('Y/m/d');
        $event->image = Storage::url($event->image);

        return view('event.edit')->with('event', $event);

    }

    public function update(EventRequest $request, Event $event) {

        $data = $request->except(['_token', 'edit', 'image']);

        $start = new DateTime($data['start']);
        $end = new DateTime($data['end']);

        $data['start'] = $start->format('H:i');
        $data['end'] = $end->format('H:i');
        $imagePath = $event->image;

        try {
            if($request['image'] != null) {
                Storage::delete($imagePath);

                $path = $request->file('image')->store('events');
                $data['image'] = $path;
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $event->update($data);
        }
        catch(Exception $e) {
            //$error = Config::get('constants.ERROR_MESSAGE');
            $error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'Event <strong>' . $event->title . '</strong> was successfully updated.';

        return redirect('events')->with('message', $message);

    }

    public function destroy(Event $event) {

        try {
            Storage::delete($event->image);
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

        $role = Role::where('constant_name', 'VISITOR')->first();

        $users = $event->users()->wherePivot('role_id', $role->id)->get();

        return view('event.user.index')->with('event', $event)->with('users', $users)->with('roleName', $role->name);

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

    public function addAdminView(Event $event) {

        $roles = Role::where('constant_name', 'EVENT_ADMIN')->get();

        return view('event.admin.add')->with('event', $event)->with('roles', $roles);

    }

    public function viewAdmins(Event $event) {

        $role = Role::where('constant_name', 'EVENT_ADMIN')->first();

        $users = $event->users()->wherePivot('role_id', $role->id)->get();

        return view('event.admin.index')->with('event', $event)->with('users', $users)->with('roleName', $role->name);

    }

}
