<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\LeadState;
use Illuminate\Http\Request;

class LeadStateController extends BaseController
{
    public function index()
    {
        $leadStates = LeadState::get();

        return view('admin.CRM.settings.lead-state', compact('leadStates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadState = new LeadState;

        $leadState->create([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-state.index')->with('create', 'Состояние лида успешно создан!');
    }

    public function update(Request $request, LeadState $leadState)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadState->update([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-state.index')->with('update', 'Состояние лида успешно обновлён!');
    }

    public function destroy(LeadState $leadState)
    {
        $leadState->delete();

        return redirect()->route('setting.lead-state.index')->with('delete', 'Состояние лида успешно удалён!');
    }
}
