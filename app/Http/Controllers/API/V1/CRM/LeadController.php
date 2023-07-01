<?php

namespace App\Http\Controllers\API\V1\CRM;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Crm\LeadRequest;
use App\Http\Resources\Api\V1\CRM\ContactResource;
use App\Http\Resources\Api\V1\CRM\LeadResource;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends BaseController
{
    public function index()
    {
        $leads = Lead::orderByDesc('created_at')->get();

        $response = [
            'leads' => LeadResource::collection($leads),
        ];

        return response($response);
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
          'contact' => new ContactResource($contact),
          'lead' => new LeadResource($lead),
          'message' => true,
        ];

        return response($response);

    }

}
