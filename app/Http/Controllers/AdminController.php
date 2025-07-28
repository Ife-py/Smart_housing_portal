<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function complaint()
    {
        // Logic to fetch complaints data
        return view('admin.complaint');
    }

}
