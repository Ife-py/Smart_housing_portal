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
        $properties = Properties::where('landlord_id', Auth::guard('landlord')->id())->get();
        return view('dashboard.landlord.properties.index', compact('properties'));
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
            'status' => 'active', // or $request->status if you want landlords to choose
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
            'custom_type' => $request->type === 'Other' ? $request->custom_type : null,
            'description' => $request->description,
            'features' => $request->features,
            'images' => $imagePaths,
            'cover_image' => $coverImage,
        ]);
        return redirect()->route('dashboard.landlord.properties.index')->with('success', 'Property created successfully.');
    }

    public function edit($id){
        // Fetch property by $id
        $property = Properties::where('landlord_id', Auth::guard('landlord')->id())
                              ->where('id', $id)
                              ->with(['landlord'])
                              ->firstOrFail();
        return view('dashboard.landlord.properties.edit', compact('property'));
    }  

public function update(Request $request, $id)
{
    // Find the property
    $property = Properties::findOrFail($id);

    // Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'price' => 'required|numeric',
        'type' => 'required|string|max:50',
        'custom_type' => 'required_if:type,Other|nullable|string|max:50',
        'description' => 'required|string',
        'features' => 'nullable|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        'status' => 'required|in:active,inactive',
    ]);

    // Update property fields
    $property->title = $validated['title'];
    $property->address = $validated['address'];
    $property->city = $validated['city'];
    $property->state = $validated['state'];
    $property->price = $validated['price'];
    $property->type = $validated['type'];
    $property->custom_type = $validated['custom_type'] ?? null;
    $property->description = $validated['description'];
    $property->features = $validated['features'] ?? null;
    $property->status = $validated['status'];

    // Handle cover image upload (if provided)
    if ($request->hasFile('cover_image')) {
        // Delete old cover image if exists
        if ($property->cover_image && Storage::exists('public/' . $property->cover_image)) {
            Storage::delete('public/' . $property->cover_image);
        }

        $coverPath = $request->file('cover_image')->store('properties/cover_images', 'public');
        $property->cover_image = $coverPath;
    }

    // Handle additional images (append new ones)
    if ($request->hasFile('images')) {
        $imagePaths = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('properties/images', 'public');
            $imagePaths[] = $path;
        }

        // Merge old + new images
        $existingImages = is_array($property->images) ? $property->images : [];
        $property->images = array_merge($existingImages, $imagePaths);
    }

    // Save changes
    $property->save();

    return redirect()->route('dashboard.landlord.properties.index')
                     ->with('success', 'Property updated successfully.');
    }
    
    public function show($id){
        $property = Properties::where('landlord_id', Auth::guard('landlord')->id())
                              ->where('id', $id)
                              ->with(['landlord'])
                              ->firstOrFail();
        return view('dashboard.landlord.properties.show', compact('property'));
    }

       public function destroy($id)
    {
        $property = Properties::where('landlord_id', Auth::guard('landlord')->id())
            ->where('id', $id)
            ->firstOrFail();

        // Delete cover image from storage
        if ($property->cover_image) {
            Storage::disk('public')->delete($property->cover_image);
        }

        // Delete all property images from storage
        if (is_array($property->images)) {
            foreach ($property->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete the property from the database
        $property->delete();

        return redirect()->route('dashboard.landlord.properties.index')->with('success', 'Property deleted successfully.');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $property= collect();
        $message=null;

        if(!empty($query)){
            $properties = Properties::where('landlord_id', Auth::guard('landlord')->id())
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('address', 'LIKE', "%{$query}%")
                  ->orWhere('city', 'LIKE', "%{$query}%")
                  ->orWhere('state', 'LIKE', "%{$query}%")
                  ->orWhere('type', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('features', 'LIKE', "%{$query}%")
                  ->orWhere('custom_type', 'LIKE', "%{$query}%")
                  ->orWhere('price', 'LIKE', "%{$query}%")
                  ->orWhere('status', 'LIKE', "%{$query}%");
            })
            ->get();
            if($properties->isEmpty()){
                $message="No property found for your search query.";
            }
        }else{
            $message="Please Enter a search term.";
        }
        

        return view('dashboard.landlord.properties.index',
         ['properties'=>$properties,
            'searchQuery'=>$query,
            'message'=>$message,
        ]);
    }

}
