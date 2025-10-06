<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;

class MyPropertiesController extends Controller
{
    public function index(){
        return view('dashboard.tenant.my_properties.index');
    }
}
