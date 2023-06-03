<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\LeadSource;
use Illuminate\Http\Request;

class LeadSourceController extends BaseController
{
    public function index()
    {
        $leadSources = LeadSource::get();

        return view('admin.CRM.settings.lead-source', compact('leadSources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadSource = new LeadSource;

        $leadSource->create([
           'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-source.index')->with('create', 'Источник лида успешно создан!');
    }

    public function update(Request $request, LeadSource $leadSource)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $leadSource->update([
           'name' => $request->name,
        ]);

        return redirect()->route('setting.lead-source.index')->with('update', 'Источник лида успешно обновлён!');
    }

    public function destroy(LeadSource $leadSource)
    {
        $leadSource->delete();

        return redirect()->route('setting.lead-source.index')->with('delete', 'Источник лида успешно удалён!');
    }
}
