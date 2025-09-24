<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Landlord;

class RegisterTenantsController extends Controller
{
    public function RegisterTenantsForm(){
        return view('auth.register.tenants');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tenants',
            'email' => 'required|string|email|max:255|unique:tenants',
            'phone' => 'nullable|string|max:15',
            'sex'=> 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'id_number' => 'nullable|string|max:50',
            'id_type' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date|before:-18 years',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'password' => 'required|string|min:8|confirmed',
        ]
        , ['date_of_birth.before' => 'You must be at least 18 years old to register.']
        );
        // Check if the user is already registered as a landlord
        if (Landlord::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered as a landlord.']);
        }
        
        // Create the tenant
        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->username = $request->username;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->sex = $request->sex;
        $tenant->address = $request->address;
        $tenant->city = $request->city;
        $tenant->state = $request->state;
        $tenant->country = $request->country;
        $tenant->occupation = $request->occupation;
        $tenant->id_number = $request->id_number;
        $tenant->id_type = $request->id_type;
        $tenant->date_of_birth = $request->date_of_birth;
        
        if ($request->hasFile('profile_photo')) {
            $tenant->image_path = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        $tenant->password = bcrypt($request->password);
        $tenant->save();
        
        return redirect()->route('auth.login')->with('success', 'Tenant registered successfully. Please log in.');
    }
}
