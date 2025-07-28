<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTenantsController extends Controller
{
    public function index()
    {
        // Logic to fetch tenants data
        return view('admin.tenants.index');
    }
}
