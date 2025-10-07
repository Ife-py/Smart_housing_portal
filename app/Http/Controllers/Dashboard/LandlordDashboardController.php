<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Properties;
use App\Models\Landlord;
use App\Models\Application;
class LandlordDashboardController extends Controller
{
    public function index(){
        $property = Properties::where('landlord_id', Auth::guard('landlord')->id())->get();
        $recentApplications = Application::where('landlord_id', Auth::guard('landlord')->id())
            ->with('property', 'tenant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('dashboard.landlord.index',compact('property','recentApplications'));
    }

    public function logout(Request $request){
        auth()->guard('landlord')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
