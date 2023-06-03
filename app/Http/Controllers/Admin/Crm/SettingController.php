<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        return view('admin.CRM.settings.index');
    }


}
