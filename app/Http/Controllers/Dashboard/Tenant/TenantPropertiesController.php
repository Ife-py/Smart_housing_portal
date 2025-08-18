<?php

namespace App\Http\Controllers\Dashboard\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantPropertiesController extends Controller
{
    public function index()
    {
        return view('dashboard.tenant.properties.index');
    }
}
