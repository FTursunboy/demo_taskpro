<?php

namespace App\Http\Controllers\API\V1\CRM;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Crm\ContactRequest;
use App\Http\Resources\API\V1\ContactLeadResource;
use App\Http\Resources\API\V1\ContactResource;
use App\Models\Admin\CRM\Contact;
use App\Models\Admin\CRM\Lead;
use Illuminate\Support\Facades\DB;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->where('is_client', true)->get();

        $response = [
            'contact' => ContactResource::collection($contacts),
            'message' => true,
        ];
        return response($response, 200);
    }

    public function leads()
    {
        $leads = DB::table('leads as l')
            ->join('contacts as c', 'c.id', '=', 'l.id')
            ->select('l.id', 'c.fio')
            ->get();

        $formattedLeads = [];
        foreach ($leads as $lead) {
            $formattedLeads[] = [
                'id' => $lead->id,
                'fio' => $lead->fio,
            ];
        }

        $response = [
            'leads' => $formattedLeads,
        ];

        return response($response, 200);
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

