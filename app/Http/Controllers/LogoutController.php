<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Determine the guard based on the authenticated user
        if (auth()->guard('tenant')->check()) {
            auth()->guard('tenant')->logout();
            $redirectRoute = 'dashboard.tenant.index';
        } elseif (auth()->guard('landlord')->check()) {
            auth()->guard('landlord')->logout();
            $redirectRoute = 'dashboard.landlord.index';
        } else {
            // auth()->guard('admin')->logout();
            // $redirectRoute = 'admin.index';
            $redirectRoute = 'home.index'; // or any safe default route
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirectRoute);
    }
}
