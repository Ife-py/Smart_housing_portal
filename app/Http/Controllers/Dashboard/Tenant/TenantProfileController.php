<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantProfileController extends Controller
{
    public function index()
    {
        $tenant = auth()->guard('tenant')->user();
        return view('dashboard.tenant.profile.index', compact('tenant'));
    }
}
