<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Crm\LeadRequest;
use App\Http\Requests\Admin\Crm\LeadUpdateRequest;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\LeadSource;
use App\Models\Admin\CRM\LeadState;
use App\Models\Admin\CRM\LeadStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeadController extends BaseController
{
    public function index() {


        $statuses = LeadStatus::get();
        $states = LeadState::get();
        $sources = LeadSource::get();

        $leads = Lead::orderBy('updated_at', 'desc')->get();


        return view('admin.CRM.leads.index', compact('leads', 'statuses', 'states', 'sources'));
    }

    public function create() {
        $statuses = LeadStatus::get();
        $states = LeadState::get();
        $sources = LeadSource::get();

        return view('admin.CRM.leads.create', compact('statuses', 'states', 'sources'));
    }

    public function store(LeadRequest $request) {
        $is_client = true;
        $existingContact = Contact::where('phone', $request->phone)
            ->first();
        if ($existingContact) {
            $contact = $existingContact;
        }
        else {
            if ($request->status_id == 1) {
                $is_client = $request->has('is_client');
            }

        $contact = Contact::create([
                'fio' => $request->fio,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'lead_source_id' => $request->source_id,
                'is_client' => $is_client,

            ]);
        }


        $lead = Lead::create([
            'contact_id' => $contact->id,
            'description' => $request->description,
            'lead_source_id' => $request->source_id,
            'lead_status_id' => $request->status_id,
            'lead_state_id' => $request->state_id,
            'author' => Auth::user()->name,
        ]);

        $contact->lead_id = $lead->id;
        $contact->save();
        return redirect()->route('lead.index')->with('create', 'Лид успешно создан!');

    }

    public function edit(Lead $lead) {
        $statuses = LeadStatus::get();
        $states = LeadState::get();
        $sources = LeadSource::get();
        return view('admin.CRM.leads.edit', compact('lead', 'states', 'statuses', 'sources'));
    }

    public function update(LeadUpdateRequest $request, Lead $lead) {
        $contact = Contact::find($lead->contact_id);
        $is_client = true;
        if ($request->status_id == 1) {
            $is_client = $request->has('is_client');
        }

        $contact->update([
            'fio' => $request->fio,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'lead_source_id' => $request->source_id,
            'is_client' => $is_client
        ]);

        $lead->update([
            'contact_id' => $contact->id,
            'description' => $request->description,
            'lead_source_id' => $request->source_id,
            'lead_status_id' => $request->status_id,
            'lead_state_id' => $request->state_id,
            'author' => Auth::user()->name,
        ]);



        return redirect()->route('lead.index')->with('update', 'Лид успешно обновлён!');


    }

    public function destroy(Lead $lead) {
        $lead->delete();
        $contact = Contact::find($lead->contact_id);

        $contact?->delete();

        return redirect()->back()->with('delete', 'Лид успешно удалён!');
    }

    public function show(Lead $lead) {
        return view('admin.CRM.leads.show', compact('lead'));
    }


    public function filter($status, $state, $source) {
        $leads = Lead::query();

        if ($status) {
            $leads->whereHas('status', function ($query) use ($status) {
                $query->where('id', $status);
            });
        }

        if ($state) {
            $leads->whereHas('state', function ($query) use ($state) {
                $query->where('id', $state);
            });
        }

        if ($source) {
            $leads->whereHas('leadSource', function ($query) use ($source) {
                $query->where('id', $source);
            });
        }

        $filteredLeads = $leads->join('lead_sources as ls', 'ls.id', '=', 'leads.lead_source_id')
            ->join('lead_states as lstat', 'leads.lead_state_id', '=', 'lstat.id')
            ->join('lead_statuses as sts', 'leads.lead_status_id', '=', 'sts.id')
            ->join('contacts as c', 'leads.contact_id', '=', 'c.id')
            ->select('leads.id', 'leads.author', 'leads.created_at as date', 'lstat.name as lead_state', 'sts.name as status', 'ls.name as source', 'c.fio as contact_name')
            ->get();


        return response([
            'data' => $filteredLeads,
        ]);
    }

    public function contact(Lead $lead) {
        $contacts = Contact::where('contact_id', $lead->id)->get();

        return view('admin.crm.contacts.index', compact('contacts'));


    }

    public function events(Lead $lead) {
        $events = Event::where('lead_id', $lead->id)->get();

        return view('admin.crm.events.index', compact('events'));
    }


}
