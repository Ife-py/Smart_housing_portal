<?php

namespace App\Http\Controllers\Dashboard\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantSettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.tenant.settings.index');
    }
}
