<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users(){
        // // Logic to fetch users data
        // $landlordsCount = 312; // Example data, replace with actual logic
        // $tenantsCount = 780; // Example data, replace with actual logic
        // $propertiesCount = 98; // Example data, replace with actual logic

        return view('admin.users');
    }

    public function landlords()
    {
        // Logic to fetch landlords data
        return view('admin.landlord');
    }

    public function tenants()
    {
        // Logic to fetch tenants data
        return view('admin.tenants');
    }

}
