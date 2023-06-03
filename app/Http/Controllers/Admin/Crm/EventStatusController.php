<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\EventStatus;
use Illuminate\Http\Request;

class EventStatusController extends BaseController
{
    public function index()
    {
        $eventStatuses = EventStatus::get();

        return view('admin.CRM.settings.event-status', compact('eventStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $eventStatus = new EventStatus;

        $eventStatus->create([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.event-status.index')->with('create', 'Статус события успешно создан!');
    }

    public function update(Request $request, EventStatus $eventStatus)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $eventStatus->update([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.event-status.index')->with('update', 'Статус события успешно обновлён!');
    }

    public function destroy(EventStatus $eventStatus)
    {
        $eventStatus->delete();

        return redirect()->route('setting.event-status.index')->with('delete', 'Статус события успешно удалён!');
    }
}
