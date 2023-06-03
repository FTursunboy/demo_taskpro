<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\LeadStatus;
use Illuminate\Http\Request;

class LeadStatusController extends BaseController
{
    public function index()
    {
        $leadStatuses = LeadStatus::get();

        return view('admin.CRM.settings.lead-status', compact('leadStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadStatus = new LeadStatus;

        $leadStatus->create([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-status.index')->with('create', 'Стадие лида успешно создан!');
    }

    public function update(Request $request, LeadStatus $leadStatus)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadStatus->update([
            'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-status.index')->with('update', 'Стадие лида успешно обновлён!');
    }

    public function destroy(LeadStatus $leadStatus)
    {
        $leadStatus->delete();

        return redirect()->route('setting.lead-status.index')->with('delete', 'Стадие лида успешно удалён!');
    }
}
