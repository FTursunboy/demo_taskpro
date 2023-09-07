<?php

namespace App\Http\Controllers\API\V1\CRM;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Crm\ContactRequest;
use App\Http\Requests\Admin\Crm\EventRequest;
use App\Http\Requests\Admin\Crm\LeadRequest;
use App\Http\Resources\API\V1\ContactResource;
use App\Http\Resources\API\V1\EventResource;
use App\Http\Resources\API\V1\LeadResource;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Event;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\LeadSource;
use App\Models\Admin\CRM\LeadState;
use App\Models\Admin\CRM\LeadStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeadController extends BaseController
{

    public function index()
    {
        $leads = Lead::orderByDesc('created_at')->get();

        $response = [
            'leads' => LeadResource::collection($leads),
        ];

        return response($response, 200);
    }

    public function leadStatus()
    {
        $leadStatus = LeadStatus::pluck('name', 'id');

        $formattedLeadStatus = [];
        foreach ($leadStatus as $id => $name) {
            $formattedLeadStatus[] = [
                'id' => $id,
                'name' => $name,
            ];
        }

        $response = [
            'leadStatus' => $formattedLeadStatus,
        ];

        return response($response);
    }


    public function leadState()
    {
        $leadState = LeadState::pluck('name', 'id');

        $formattedLeadState  = [];
        foreach ($leadState as $id => $name) {
            $formattedLeadState[] = [
                'id' => $id,
                'name' => $name,
            ];
        }

        $response = [
            'leadState' => $formattedLeadState,
        ];

        return response($response, 200);
    }


    public function leadSource()
    {
        $leadSource = LeadSource::pluck('name', 'id');

        $formattedLeadSource = [];
        foreach ($leadSource as $id => $name) {
            $formattedLeadSource[] = [
                'id' => $id,
                'name' => $name,
            ];
        }

        $response = [
            'leadSource' => $formattedLeadSource,
        ];

        return response($response, 200);
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
                'company' => $request->input('company'),
                'position' => $request->input('position'),
            ]);
//            $validator = Validator::make(
//                ['phone' => $request->telephone],
//                ['phone' => 'required'],
//            );
//            if ($validator->fails()){
//                return response()->json([
//                    'message' => false,
//                    'info' => 'Данные, которые вы отправили, не правильные'
//                ],200);
//            } else {
//
//            }

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

        $response = [
          'message' => true,
          'contact' => new ContactResource($contact),
          'lead' => new LeadResource($lead),
        ];

        return response($response, 200);

    }

    public function show($id)
    {
        $lead = Lead::find($id);

        $response = [
            'lead' => new LeadResource($lead),
            'events' => EventResource::collection($lead?->events),
            'contacts' => ContactResource::collection($lead?->contacts)
        ];

        return response($response, 200);
    }

    public function update(LeadRequest $request, $id)
    {
        $lead = Lead::findOrFail($id);

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

            $contact = Contact::where('lead_id', $id)->first();

            $contact->update([
                'fio' => $request->fio,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'lead_source_id' => $request->source_id,
                'is_client' => $is_client,
                'company' => $request->input('company'),
                'position' => $request->input('position'),
            ]);
        }

        $lead->update([
            'contact_id' => $contact->id,
            'description' => $request->description,
            'lead_source_id' => $request->source_id,
            'lead_status_id' => $request->status_id,
            'lead_state_id' => $request->state_id,
            'author' => Auth::user()->name,
        ]);

        $contact->lead_id = $lead->id;
        $contact->update();

        $response = [
            'contact' => new ContactResource($contact),
            'lead' => new LeadResource($lead),
            'message' => true,
        ];

        return response($response, 200);

    }

    public function updateEvent(EventRequest $request, $id)
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

        return response([
            'message' => true,
            'event' => new EventResource($event)
        ], 200);
    }

    public function updateContact(ContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update([
            'fio' => $request['fio'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'position' => $request['position'],
            'lead_id' => $request['lead_id'],
            'address' => $request['address'],
            'company' => $request['company'],
        ]);

        return response([
            'message' => true,
            'contact' => new ContactResource($contact)
        ], 200);
    }

    public function delete($id)
    {
        Lead::find($id)->delete();

        return response([
           'message' => true
        ]);
    }

    public function eventDelete($id)
    {
        Event::find($id)->delete();

        return response([
           'message' => true
        ]);
    }

    public function contactDelete($id)
    {
        Contact::find($id)->delete();

        return response([
            'message' => true
        ]);
    }

}
