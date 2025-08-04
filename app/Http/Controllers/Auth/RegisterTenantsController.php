<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterTenantsController extends Controller
{
    public function RegisterTenantsForm(){
        return view('auth.register.tenants');
    }
}
