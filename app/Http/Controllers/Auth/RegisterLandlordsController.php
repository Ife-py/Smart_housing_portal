<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landlord;
use App\Models\Tenant;

class RegisterLandlordsController extends Controller
{
    public function RegisterLandlordForm()
    {
        return view('auth.register.landlords');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:landlords',
            'email' => 'required|string|email|max:255|unique:landlords',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:100',
            'id_number' => 'nullable|string|max:50',
            'id_type' => 'nullable|string|max:50',
            'properties_count' => 'nullable|integer|min:0',
            'contact_method' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date|before:-18 years',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ],
        ['date_of_birth.before' => 'You must be at least 18 years old to register.',]
        );

        // Check if the user is already registered as a tenant
        if (Tenant::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered as a tenant.']);
        }

        // Create the landlord
        $landlord = new Landlord();
        $landlord->name = $request->name;
        $landlord->username = $request->username;
        $landlord->email = $request->email;
        $landlord->phone = $request->phone;
        $landlord->address = $request->address;
        $landlord->city = $request->city;
        $landlord->state = $request->state;
        $landlord->country = $request->country;
        $landlord->company = $request->company;
        $landlord->occupation = $request->occupation;
        $landlord->id_number = $request->id_number;
        $landlord->id_type = $request->id_type;
        $landlord->properties_count = $request->properties_count ?? 0;
        $landlord->contact_method = $request->contact_method ?? 'email';
        $landlord->date_of_birth = $request->date_of_birth;
        
        if ($request->hasFile('profile_photo')) {
            $landlord->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        
        $landlord->password = bcrypt($request->password);
        $landlord->save();
        return redirect()->route('auth.login')->with('success', 'Landlord registered successfully. Please log in.');
    }     
}
