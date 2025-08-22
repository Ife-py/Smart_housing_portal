<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    
    public function properties(){
        return view('home.properties');
    }
    
    public function show_properties(){
        return view('home.show_properties');
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact_us');
    }
}
