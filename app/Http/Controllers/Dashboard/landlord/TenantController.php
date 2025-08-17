<?php

namespace App\Http\Controllers\Dashboard\landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(){
        return view ('dashboard.landlord.tenants.index');
    }
}
