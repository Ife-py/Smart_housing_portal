<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
class AdminPropertiesController extends Controller
{
    public function index()
    {
        // Logic to fetch properties data
        $properties = Properties::all();
        // Pass properties data to the view
        return view('admin.properties.index',compact('properties'));
    }
}
