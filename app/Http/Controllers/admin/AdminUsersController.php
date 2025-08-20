<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Landlord;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Logic to fetch users data
        $tenants = Tenant::all();
        $landlords = Landlord::all();
        
        return view('admin.users.index', compact('tenants', 'landlords'));
    }
    
    public function show($type, $id) {
        if ($type=='tenant') {
            $tenant = Tenant::find($id);
            if ($tenant) {
                return view('admin.users.show_tenants', compact('tenant'));
            }
        } elseif($type=='landlord') {
            $landlord = Landlord::find($id);
            if ($landlord) {
                return view('admin.users.show_landlord', compact('landlord'));
            }
        }
        abort(404, 'User not found'); 
    }

    public function destroy($type, $id) {
        if ($type == 'tenant') {
            $tenant = Tenant::find($id);
            if ($tenant) {
                $tenant->delete();
                return redirect()->route('admin.users.index')->with('success', 'Tenant deleted successfully');
            }
        } elseif ($type == 'landlord') {
            $landlord = Landlord::find($id);
            if ($landlord) {
                $landlord->delete();
                return redirect()->route('admin.users.index')->with('success', 'Landlord deleted successfully');
            }
        }

        return redirect()->back()->withErrors(['error' => 'User not found']);
    }   
}