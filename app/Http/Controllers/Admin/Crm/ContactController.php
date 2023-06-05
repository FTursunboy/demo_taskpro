<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\Crm\ContactRequest;
use App\Http\Requests\Admin\Crm\UpdateContactRequest;
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

        return view('admin.CRM.contacts.index', compact('contacts', 'lead'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::all();


        return view('admin.CRM.contacts.create', compact('leads', ));
    }

    public function createLead(Lead $leades) {

        return view('admin.CRM.contacts.create', compact('leades' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
//        if (session('client')){
//            $clientData = session('client');
//
//            $client = User::create([
//                'name' => $clientData['name2'],
//                'surname' => $clientData['surname2'],
//                'lastname' => $clientData['lastname2'],
//                'login' => $clientData['login'],
//                'password' =>  Hash::make($clientData['password']),
//                'phone' => $clientData['phone2'],
//                'telegram_id' => $clientData['telegram_id'],
//                'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-'),
//            ])->assignRole('client');
//        }
//        if ($request->input('client_id') == 0 && isset($client)){
//            $client_id = $client->id;
//        }else{
//            $client_id = $request->input('client_id');
//        }

        Contact::create([
            'fio' => $request->fio,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'address' => $request->address,
            'lead_id' => $request->input('lead_id'),
        ]);

//        if (isset($client)) {
//            ProjectClient::create([
//                'user_id' => $client->id,
//                'project_id' => $clientData['project_id'],
//            ]);
//        }

//        session()->forget("client");
        return redirect()->route('contact.index')->with('create', 'Контакт успешно создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.CRM.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        $leads = Lead::all();
        $projects = ProjectModel::where('types_id', 2)->get();

        return view('admin.CRM.contacts.edit', compact('contact',  'leads', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {

        $contact->update([
            'fio' => $request['fio'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'position' => $request['position'],
            'lead_id' => $request['lead_id'],
            'address' => $request['address'],
        ]);
//
//        if (isset($client)) {
//            ProjectClient::create([
//                'user_id' => $client->id,
//                'project_id' => $clientData['project_id'],
//            ]);
//        }
//
//        session()->forget("client");

        return redirect()->route('contact.index')->with('update', 'Контакт успешно обновлён!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if ($contact->lead_id !== null) {
            return redirect()->route('contact.index')->with('delete', 'Контакт не может быть удален, так как он связан с лидом.');
        } else {
            $contact->delete();
            return redirect()->route('contact.index')->with('delete', 'Контакт успешно удален!');
        }
    }




    public function addClient(Request $request)
    {
        // Валидация данных формы
        $validatedData = $request->validate([
            'name2' => 'required',
            'lastname2' => 'required',
            'password' => 'required',
            'telegram_id' => 'nullable|numeric',
            'surname2' => 'required',
            'login' => 'required',
            'project_id' => 'required',
            'phone2' => 'required',
        ]);

        // Сохранение проверенных данных в сессии
        Session::put('client', $validatedData);
        // Перенаправление на другую страницу или выполнение дальнейших действий
        return redirect()->route('contact.create');
    }

}

