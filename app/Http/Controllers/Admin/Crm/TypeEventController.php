<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\TypeEvent;
use Illuminate\Http\Request;

class TypeEventController extends BaseController
{
    public function index()
    {
        $typeEvents = TypeEvent::get();

        return view('admin.CRM.settings.type-event', compact('typeEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $typeEvent = new TypeEvent;

        $typeEvent->create([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.type-event.index')->with('create', 'Тип события успешно создан!');
    }

    public function update(Request $request, TypeEvent $typeEvent)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $typeEvent->update([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.type-event.index')->with('update', 'Тип события успешно обновлён!');
    }

    public function destroy(TypeEvent $typeEvent)
    {
        $typeEvent->delete();

        return redirect()->route('setting.type-event.index')->with('delete', 'Тип события успешно удалён!');
    }
}
