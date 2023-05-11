<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        return view('admin.settings.role', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:roles,name']
        ]);
        Role::create([
            'name' => $data['name']
        ]);

        return redirect()->route('settings.role')->with('create', 'Роль успешно создань.');
    }

    public function update(Role $role, Request $request)
    {
        $role->update([
            'name' => $request->name
        ]);
        return redirect()->route('settings.role')->with('update', 'Роль успешно изменен.');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('settings.role')->with('delete', 'Роль успешно удален.');
    }
}
