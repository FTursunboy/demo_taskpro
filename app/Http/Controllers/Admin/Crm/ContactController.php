<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function edit()
    {
        return Contact::all();
    }

    public function update()
    {
        return Contact::all();
    }

    public function delete()
    {
        return Contact::all();
    }
}
