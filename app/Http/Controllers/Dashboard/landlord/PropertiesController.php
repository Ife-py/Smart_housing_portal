<?php

namespace App\Http\Controllers\Dashboard\landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PropertiesController extends Controller
{
    public function index(){
        return view('dashboard.landlord.properties.index');
    }

    public function create(){
        return view('dashboard.landlord.properties.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'price' => 'required|numeric',
            'type' => 'required|string|max:50',
            'custom_type' => 'required_if:type,Other|nullable|string|max:50',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'cover_image' => 'nullable|string',
        ]);

        $imagePaths = [];
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file) {
                $filename = 'property_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('properties', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        // Validate cover image is among uploaded images
        $coverImage = $request->input('cover_image');
        if (!in_array($coverImage, $imagePaths)) {
            $coverImage = $imagePaths[0] ?? null;
        }

        $propertyType = $request->type === 'Other' ? $request->custom_type : $request->type;

        $property = Properties::create([
            'landlord_id' => Auth::guard('landlord')->id(),
            'title' => $request->title,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'price' => $request->price,
            'type' => $propertyType,
            'description' => $request->description,
            'features' => $request->features,
            'images' => $imagePaths,
            'cover_image' => $coverImage,
        ]);
        return redirect()->route('dashboard.landlord.properties.index')->with('success', 'Property created successfully.');
    }

    // public function edit($id){
    //     // Fetch property by $id
    //     return view('dashboard.landlord.properties.edit', compact('id'));
    // }  

    public function update(Request $request, $id){
        // Validate and update property logic here
        return redirect()->route('dashboard.landlord.properties.index')->with('success', 'Property updated successfully.');
    }
    public function show($id){
        // Fetch property by $id
        return view('dashboard.landlord.properties.show', compact('id'));
    }

    public function destroy($id){
        // Delete property logic here
        return redirect()->route('dashboard.landlord.properties.index')->with('success', 'Property deleted successfully.');
    }

}
