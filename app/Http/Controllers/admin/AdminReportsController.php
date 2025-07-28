<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function index()
    {
        // Logic to fetch reports data
        return view('admin.reports.index');
    }
}
