<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\EventStatus;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\ThemeEvent;
use App\Models\Admin\CRM\TypeEvent;
use App\Models\Statuses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CalendarController extends BaseController
{
    public function index(Request $request)
    {
        $typeEvents = TypeEvent::get();
        $themeEvents = ThemeEvent::get();
        $statuses = EventStatus::get();
        $leads = Lead::get();
        $dates = array();
        $events = Event::get();
        foreach ($events as $event) {
            $color = null;
            if ($event->eventStatus->id == 1) {
                $color = '#580CF2';
            }
            elseif($event->eventStatus->id == 2) {
                $color = 'green';
            }
            elseif($event->eventStatus->id == 3) {
                $color = 'red';
            }


            $dates[] = [
                'title' => $event->themeEvent->theme,
                'start' => $event->date,
                'color' => $color
            ];
        }




        return view('admin.CRM.calendar.index', compact('dates', 'typeEvents', 'themeEvents', 'leads', 'statuses'));

    }

    public function store(Request $request) {

        $request->validate([
            'lead_id' => ['required'],
            'type_event_id' => ['required'],
            'themeEvent_id' => ['required'],
            'description' => ['required'],
            'time' => '',
            'status_id' => ''

        ]);

        $event = DB::table('events')
            ->insertOrIgnore([
                'lead_id' => $request->lead_id,
                'type_event_id' => $request->type_event_id,
                'themeEvent_id' => $request->themeEvent_id,
                'description' => $request->description,
                'event_status_id' => $request->status_id,
                'date' => $request->start_date . " " . $request->time,
                'slug' => Str::slug(str_replace(' ', '_', $request->description) . '-', '5')
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
