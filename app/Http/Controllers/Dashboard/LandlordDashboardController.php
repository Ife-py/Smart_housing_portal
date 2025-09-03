<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Properties;
class LandlordDashboardController extends Controller
{
    public function index(){
        $property = Properties::where('landlord_id', Auth::guard('landlord')->id())->get();
        return view('dashboard.landlord.index',compact('property'));
    }

    public function logout(Request $request){
        auth()->guard('landlord')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
