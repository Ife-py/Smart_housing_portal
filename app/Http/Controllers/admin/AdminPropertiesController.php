<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPropertiesController extends Controller
{
    public function index()
    {
        // Logic to fetch properties data
        return view('admin.properties.index');
    }
}
