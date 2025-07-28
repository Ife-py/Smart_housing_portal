<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Logic to fetch users data
        return view('admin.users.index');
    }
}
