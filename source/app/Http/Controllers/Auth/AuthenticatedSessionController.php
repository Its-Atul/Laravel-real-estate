<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $page_title = 'Sign In';
        $sitesetting = SiteSetting::find('1');
        return view('auth.login',compact('page_title','sitesetting'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $id = Auth::user()->id;

        $adminData = User::find($id);
        $username = $adminData->name;

        $request->session()->regenerate();
        $notification = array(
            'message' => 'User '.$username.' Login Successfully',
            'alert-type' => 'success'
        );

        $url = '';

        if($request->user()->role === 'admin'){
            $url = route('admin.dashboard');
        }elseif($request->user()->role === 'agent'){
            $url = route('agent.dashboard');
        }elseif($request->user()->role === 'user'){
            $url = route('dashboard');
        }
        else{
            $url = '/';
        }

        return redirect()->intended($url)->with($notification);
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
