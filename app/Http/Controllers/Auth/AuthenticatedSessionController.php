<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if( Auth::guard('web')->check() ){
            return redirect()->back();
        }
        return view('frontend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        Toastr::success('User Login Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        // Check if there's an intended URL (e.g., /checkout)
        if ($request->session()->has('custom_redirect_url')) {
            // Retrieve and remove the custom session variable
            $redirectUrl = $request->session()->pull('custom_redirect_url'); 

            // Redirect to the stored URL
            return redirect()->to($redirectUrl);
        }

        // Default fallback: Redirect to home page or dashboard if no intended URL exists
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Toastr::success('Logout Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->intended('/');
    }
}
