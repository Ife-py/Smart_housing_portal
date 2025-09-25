<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\Properties;
class TenantDashboardController extends Controller
{
    public function index(){
        //get the authenticated tenant
        $tenant = Tenant::find(Auth::guard('tenant')->id());
        $properties = Properties::all();
        return view('dashboard.tenant.index', compact('tenant', 'properties'));
    }
    
    public function logout(Request $request){
        auth()->guard('tenant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
