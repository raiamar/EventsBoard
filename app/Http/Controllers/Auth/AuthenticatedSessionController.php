<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.login');
        return view('welcome');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = $request->user()->roles->pluck('name')[0];
                switch($role){
                    case 'admin':
                        return redirect()->intended(RouteServiceProvider::DASHBOARD);
                        break;
                        
                    case 'vendor':
                        return redirect()->intended(RouteServiceProvider::DASHBOARD);
                        break;

                    case 'user':
                        return redirect()->intended(RouteServiceProvider::HOME);
                        break;

                    default:
                        return redirect()->intended(RouteServiceProvider::HOME);
                        break;
                }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
