<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Crm\EventRequest;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\EventStatus;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\ThemeEvent;
use App\Models\Admin\CRM\TypeEvent;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    public function index()
    {
        $typeEvents = TypeEvent::get();
        $events = Event::orderBy('created_at', 'desc')->get();
        $themeEvents = ThemeEvent::get();
        $contacts = Contact::get();
        $eventStatuses = EventStatus::get();

        return view('admin.CRM.events.index', compact('typeEvents', 'events', 'themeEvents', 'contacts', 'eventStatuses'));
    }

    public function create()
    {
        $typeEvents = TypeEvent::get();
        $themeEvents = ThemeEvent::get();
        $eventStatuses = EventStatus::get();
        $leads = Lead::all();
        return view('admin.CRM.events.create', compact('typeEvents', 'themeEvents', 'leads', 'eventStatuses'));
    }

    public function store(EventRequest $request)
    {

        Event::create([
            'themeEvent_id' => $request->themeEvent_id,
            'description' => $request->description,
            'date' => $request->date,
            'lead_id' => $request->input('lead_id'),
            'type_event_id' => $request->type_event_id,
            'event_status_id' => $request->event_status_id,
        ]);

        return redirect()->route('event.index')->with('create', 'Событие успешно создан!');
    }

    public function show(Event $event, TypeEvent $typeEvent)
    {
        return view('admin.CRM.events.show', compact('event', 'typeEvent'));
    }

    public function edit(Event $event)
    {
        $typeEvents = TypeEvent::get();
        $themeEvents = ThemeEvent::get();
        $eventStatuses = EventStatus::get();
        $leads = Lead::get();
        return view('admin.CRM.events.edit', compact('event', 'typeEvents', 'leads', 'themeEvents', 'eventStatuses'));
    }

    public function update(EventRequest $request, int $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
           'themeEvent_id' => $request->themeEvent_id,
           'description' => $request->description,
           'date' => $request->date,
           'lead_id' => $request->lead_id,
           'type_event_id' => $request->type_event_id,
           'event_status_id' => $request->event_status_id,
        ]);

        return redirect()->route('event.index')->with('update', 'Событие успешно обновлён!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')->with('delete', 'Событие успешно удалён!');
    }

    public function filter($theme, $type) {
        $events = Event::query();


        if ($theme) {
            $events->whereHas('themeEvent', function ($query) use ($theme) {
                $query->where('id', $theme);
            });
        }

        if ($type) {
            $events->whereHas('typeEvent', function ($query) use ($type) {
                $query->where('id', $type);
            });
        }


        $filteredContacts = $events->join( 'type_events as type', 'type.id', '=', 'events.type_event_id')
            ->join('theme_events as th', 'th.id', '=', 'events.themeEvent_id')
            ->join('event_statuses as es', 'es.id', '=', 'events.event_status_id')
            ->join('event_statuses as es', 'es.id', '=', 'events.event_status_id')
            ->select('th.theme', 'events.description', 'events.date', 'es.name as status' , 'type.name as type', 'events.id')
            ->get();


        return response([
            'data' => $filteredContacts,
        ]);
    }
}
