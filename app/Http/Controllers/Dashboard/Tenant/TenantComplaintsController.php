<?php

namespace App\Http\Controllers\Dashboard\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantComplaintsController extends Controller
{
    public function index(){
        return view('dashboard.tenant.complaints.index');
    }
}
