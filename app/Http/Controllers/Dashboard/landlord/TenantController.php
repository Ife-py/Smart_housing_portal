<?php

namespace App\Http\Controllers\Dashboard\landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
class TenantController extends Controller
{
    public function index(){
        // Fetch applications for properties owned by the authenticated landlord
        $landlordId = auth()->guard('landlord')->id();

        $tenantApplications = \App\Models\Application::with(['tenant', 'property'])
            ->where('landlord_id', $landlordId)
            ->latest()
            ->get();

        return view('dashboard.landlord.tenants.index', compact('tenantApplications'));
    }
}
