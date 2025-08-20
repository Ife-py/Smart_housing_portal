<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Landlord;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        // Try tenant login
        if (Auth::guard('tenant')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.tenant.index');
        }

        // Try landlord login
        if (Auth::guard('landlord')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.landlord.index');
        }

        // Try admin login
        // if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.index');
        // }

        // If all fail
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('username1');
    }
}
