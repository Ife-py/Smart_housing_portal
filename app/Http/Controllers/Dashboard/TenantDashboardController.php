<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
class TenantDashboardController extends Controller
{
    public function index(){
        $tenant = Tenant::find(Auth::guard('tenant')->id());

        return view('dashboard.tenant.index', compact('tenant'));
    }
    
    public function logout(Request $request){
        auth()->guard('tenant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
