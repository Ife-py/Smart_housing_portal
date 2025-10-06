<?php

namespace App\Http\Controllers\Dashboard\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\Application;

class TenantPropertiesController extends Controller
{
    public function index()
    {
        $properties = Properties::where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('dashboard.tenant.properties.index', ['properties' => $properties]);;
    }

    public function show($id){
    $property = Properties::find($id);
    if (!$property) {
        abort(404);
    }
    if ($property->status !== 'active') {
        abort(404);
    }

    $hasApplied = false;

    if (Auth::guard('tenant')->check()) {
        $tenantId = Auth::guard('tenant')->id();
        $hasApplied = Application::where('tenant_id', $tenantId)
            ->where('property_id', $property->id)
            ->exists();
    }

    return view('dashboard.tenant.properties.show', compact('property','hasApplied'));
}
}
