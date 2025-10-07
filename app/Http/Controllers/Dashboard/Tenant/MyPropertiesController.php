<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;

class MyPropertiesController extends Controller
{
    public function index()
    {
        $tenantId = auth()->guard('tenant')->id();
        $applications = \App\Models\Application::with('property', 'landlord')
            ->where('tenant_id', $tenantId)
            ->get();

        return view('dashboard.tenant.my_properties.index', compact('applications'));
    }
}
