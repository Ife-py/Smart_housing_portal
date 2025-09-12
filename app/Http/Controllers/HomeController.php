<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentProperties = Properties::where('status', 'active')
                                      ->latest()
                                      ->take(4)
                                      ->get();

        return view('home.index', ['properties' => $recentProperties]);
    }
    
    public function properties()
    {
        $properties = Properties::where('status', 'active')
                                ->latest()
                                ->paginate(12);

        return view('home.properties', ['properties' => $properties]);
    }
    
    /**
     * Show a single property.
     *
     * @param  \App\Models\Properties  $property
     * @return \Illuminate\View\View
     */
    public function show(Properties $property)
    {
        // Ensure only active properties are shown publicly
        if ($property->status !== 'active') {
            abort(404);
        }
        return view('home.show', compact('property'));
    }

    public function contact()
    {
        return view('home.contact_us');
    }
}
