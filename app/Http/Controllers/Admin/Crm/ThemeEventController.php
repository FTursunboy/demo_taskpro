<?php

namespace App\Http\Controllers\Admin\Crm;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\CRM\ThemeEvent;
use Illuminate\Http\Request;

class ThemeEventController extends BaseController
{
    public function index()
    {
        $themeEvents = ThemeEvent::get();

        return view('admin.CRM.settings.theme-event', compact('themeEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required',
        ]);

        $themeEvent = new ThemeEvent;

        $themeEvent->create([
            'theme' => $request->theme,
        ]);

        return redirect()->route('setting.theme-event.index')->with('create', 'Тема события успешно создан!');
    }

    public function update(Request $request, ThemeEvent $themeEvent)
    {
        $request->validate([
            'theme' => 'required',
        ]);

        $themeEvent->update([
            'theme' => $request->theme,
        ]);

        return redirect()->route('setting.theme-event.index')->with('update', 'Тема события успешно обновлён!');
    }

    public function destroy(ThemeEvent $themeEvent)
    {
        $themeEvent->delete();

        return redirect()->route('setting.theme-event.index')->with('delete', 'Тема события успешно удалён!');
    }
}
