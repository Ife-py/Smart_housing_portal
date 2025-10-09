<?php

namespace App\Http\Controllers\Dashboard\landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        return view ('dashboard.landlord.payment.index');
    }
}
