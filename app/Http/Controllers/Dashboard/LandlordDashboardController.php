<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Properties;
use App\Models\Landlord;
use App\Models\Application;
use App\Models\Tenant;
use App\Models\Complaint;
class LandlordDashboardController extends Controller
{
    public function index(){
        $landlordId = Auth::guard('landlord')->id();

        $property = Properties::where('landlord_id', $landlordId)->get();

        // total landlords in system
        $landlordsCount = Landlord::count();

        // tenants who have applications to this landlord (distinct tenant count)
        $tenantCount = Application::where('landlord_id', $landlordId)
            ->distinct('tenant_id')
            ->count('tenant_id');

        // complaints for this landlord
        $complaintsCount = Complaint::where('landlord_id', $landlordId)->count();

        // recent applications
        $recentApplications = Application::where('landlord_id', $landlordId)
            ->with('property', 'tenant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // recent complaints
        $recentComplaints = Complaint::where('landlord_id', $landlordId)
            ->with('tenant', 'property')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('dashboard.landlord.index', compact(
            'property',
            'recentApplications',
            'landlordsCount',
            'tenantCount',
            'complaintsCount',
            'recentComplaints'
        ));
    }

    public function logout(Request $request){
        auth()->guard('landlord')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
