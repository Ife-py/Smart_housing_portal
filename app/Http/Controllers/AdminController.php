<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Properties;
use App\Models\Landlord;
class AdminController extends Controller
{
    public function index()
    {
        // Logic to fetch dashboard data
        $tenants = Tenant::all();
        $properties = Properties::all();
        $landlords = Landlord::all();
        $totalUsers = $tenants->count() + $landlords->count();
        return view('admin.index', compact('tenants', 'properties', 'landlords','totalUsers'));
    }

    public function complaint()
    {
        // Logic to fetch complaints data
        return view('admin.complaint');
    }

}
