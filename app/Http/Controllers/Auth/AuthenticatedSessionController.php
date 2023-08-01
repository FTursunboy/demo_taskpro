<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\AuthNotifyJob;
use App\Models\User;
use App\Notifications\Telegram\AuthNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store1(): RedirectResponse
    {

        dd(1);


        $request->authenticate();

        $request->session()->regenerate();

        $role = Auth::user()->getRoleNames()[0];

//        AuthNotifyJob::dispatch(Auth::user());
        return match ($role) {

            'user' => redirect()->intended(RouteServiceProvider::USER),
            'admin' => redirect()->intended(RouteServiceProvider::HOME),
            'client' => redirect()->intended(RouteServiceProvider::CLIENT),
            'client-worker' => redirect()->intended(RouteServiceProvider::WORKER),
            default => redirect()->back()->with('err', 'Что то пошло не так'),
        };

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
