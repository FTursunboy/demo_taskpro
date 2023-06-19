<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $task = new TasksController();

        $task->check();
        $role = Auth::user()->getRoleNames()[0];
        try {
            try {
                $user = User::where('id', Auth::user()->id)->first();
                Notification::send($user, new AuthNotification($user->surname, $user->name));
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }
            return match ($role) {
                'admin' => redirect()->intended(RouteServiceProvider::HOME),
                'user' => redirect()->intended(RouteServiceProvider::USER),
                'client' => redirect()->intended(RouteServiceProvider::CLIENT),
                'client-worker' => redirect()->intended(RouteServiceProvider::WORKER),
                default => redirect()->back()->with('err', 'Что то пошло не так'),
            };
        } catch (\Exception $exception) {
            Auth::logout();
            return redirect()->route('login');
        }

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
