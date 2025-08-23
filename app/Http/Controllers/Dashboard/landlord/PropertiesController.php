<?php

namespace App\Http\Controllers\Dashboard\landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function index(){
        return view('dashboard.landlord.properties.index');
    }

    public function create(){
        return view('dashboard.landlord.properties.create');
    }

    public function store(Request $request){
        // Validate and store property logic here
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
