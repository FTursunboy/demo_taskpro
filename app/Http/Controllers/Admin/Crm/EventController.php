<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Crm\EventRequest;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
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

        return view('admin.CRM.events.index', compact('typeEvents', 'events', 'themeEvents', 'contacts'));
    }

    public function create()
    {
        $typeEvents = TypeEvent::get();
        $themeEvents = ThemeEvent::get();
        $contacts = Contact::get();
        return view('admin.CRM.events.create', compact('typeEvents', 'themeEvents', 'contacts'));
    }

    public function store(EventRequest $request)
    {
        Event::create([
            'themeEvent_id' => $request->themeEvent_id,
            'description' => $request->description,
            'date' => $request->date,
            'contact_id' => $request->contact_id,
            'type_event_id' => $request->type_event_id,
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
        $contacts = Contact::get();
        return view('admin.CRM.events.edit', compact('event', 'typeEvents', 'contacts', 'themeEvents'));
    }

    public function update(EventRequest $request, int $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
           'themeEvent_id' => $request->themeEvent_id,
           'description' => $request->description,
           'date' => $request->date,
           'contact_id' => $request->contact_id,
           'type_event_id' => $request->type_event_id,
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
            ->join('contacts as c', 'events.contact_id', '=', 'c.id')
            ->select('th.theme', 'c.phone', 'events.description', 'events.date', 'type.name as type', 'events.id')
            ->get();


        return response([
            'data' => $filteredContacts,
        ]);
    }
}
