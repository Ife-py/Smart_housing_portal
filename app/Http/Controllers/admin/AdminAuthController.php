<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
        public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = 'admin';
        $password = 'ifeoluwa'; // You can change this

        if ($request->username === $username && $request->password === $password) {
            session(['is_admin_logged_in' => true]);
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget('is_admin_logged_in');
        return redirect()->route('admin.login');
    }
}
