<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterLandlordsController extends Controller
{
    public function RegisterLandlordForm()
    {
        return view('auth.register.landlords');
    }
}
