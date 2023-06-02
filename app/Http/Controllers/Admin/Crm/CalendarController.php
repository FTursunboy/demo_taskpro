<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\ThemeEvent;
use App\Models\Admin\CRM\TypeEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends BaseController
{
    public function index(Request $request)
    {
        $typeEvents = TypeEvent::get();
        $themeEvents = ThemeEvent::get();
        $contacts = Contact::get();
        $dates = array();
        $events = Event::get();
        foreach ($events as $event) {
            $dates[] = [
                'title' => $event->themeEvent->theme,
                'start' => $event->date,
            ];
        }




        return view('admin.CRM.calendar.index', compact('dates', 'typeEvents', 'themeEvents', 'contacts'));

    }

    public function store(Request $request) {

        $request->validate([
            'contact_id' => ['required'],
            'type_event_id' => ['required'],
            'themeEvent_id' => ['required'],
            'description' => ['required'],
            'time' => '',

        ]);



        $event =  Event::create([
           'contact_id' => $request->contact_id,
           'type_event_id' => $request->type_event_id,
           'themeEvent_id' => $request->themeEvent_id,
           'description' => $request->description,
           'date' => $request->start_date . " " . $request->time,
        ]);

        return response()->json($event);
    }

    public function destroy($id) {
       $event = Event::find($id);
       $event->delete();

       return $id;
    }
    public function show(Request $request)
    {
        $date = $request->date;

        $events = Event::whereDate('date', '=', $date)->get();

        return view('admin.CRM.events.show_all', ['events' => $events]);
    }

    public function show_all($date) {
        $events = Event::whereDate('date', '=', $date)->get();

        return view('admin.CRM.events.show_all', ['events' => $events]);
    }

}
