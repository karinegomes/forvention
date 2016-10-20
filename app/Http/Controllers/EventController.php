<?php

namespace App\Http\Controllers;

use App\Event;
use Exception;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Config;

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

        return view('event.edit')->with('event', $event);

    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

}
