<?php

namespace App\Http\Controllers\API\V1\Crm;

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\Crm\ContactRequest;
use App\Http\Requests\Admin\Crm\UpdateContactRequest;
use App\Http\Resources\Api\V1\Crm\ContactResource;
use App\Http\Resources\Api\V1\Crm\LeadResource;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\LeadSource;
use App\Models\Admin\ProjectModel;
use App\Models\ProjectClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->where('is_client', true)->get();
        $lead = Lead::all();

        $response = [
            'contact' => ContactResource::collection($contacts),
            'lead' => LeadResource::collection($lead),
            'message' => true,
        ];
        return response($response);
    }

    public function store(ContactRequest $request)
    {
      $contact =  Contact::create([
            'fio' => $request->fio,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'address' => $request->address,
            'company' => $request->company,
            'lead_id' => $request->input('lead_id') ? $request->input('lead_id') : null,
        ]);

        return [
            'data' => new ContactResource($contact),
            'message' => true,
        ];
    }

}

