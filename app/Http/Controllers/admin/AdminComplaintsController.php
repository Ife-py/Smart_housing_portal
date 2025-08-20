<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminComplaintsController extends Controller
{
    public function index()
    {
        // Logic to fetch complaints data
        return view('admin.complaint');
    }
}
