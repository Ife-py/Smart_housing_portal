<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landlord;
use Illuminate\Support\Facades\Storage;
class LandlordProfileController extends Controller
{
    public function index()
    {
        $landlord = auth()->guard('landlord')->user();
        return view('dashboard.landlord.profile.index', compact('landlord'));
    }

    public function edit()
    {
        $landlord = auth()->guard('landlord')->user();
        return view('dashboard.landlord.profile.edit', compact('landlord'));
    }

     public function update(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:landlords,username,' . $landlord->id,
            'email' => 'required|email|unique:landlords,email,' . $landlord->id,
            'phone' => 'nullable|string|max:20',
            'sex' => 'nullable|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:150',
            'occupation' => 'nullable|string|max:150',
            'id_type' => 'nullable|string|max:50',
            'id_number' => 'nullable|string|max:100',
            'contact_method' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($landlord->profile_photo) {
                Storage::delete($landlord->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('landlords', 'public');
        }

        $landlord->update($validated);

        return redirect()->route('dashboard.landlord.profile.index', $landlord->id)
            ->with('success', 'Profile updated successfully.');
    }
} 
