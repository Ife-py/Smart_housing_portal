<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLandlordController extends Controller
{
    public function index()
    {
        // Logic to fetch landlords data
        return view('admin.landlords.index');
    }
}
