<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyApplicationController extends Controller
{
    /**
     * Store a new application for a property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Properties  $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request, Properties $property)
    {
        $tenant = Auth::user(); // This will be the authenticated tenant due to middleware

        // Check if the property is active
        if ($property->status !== 'active') {
            return back()->with('error', 'This property is not available for applications at the moment.');
        }

        // Check if the tenant has already applied for this property
        $existingApplication = Application::where('property_id', $property->id)
                                            ->where('tenant_id', $tenant->id)
                                            ->exists();

        if ($existingApplication) {
            return back()->with('info', 'You have already applied for this property.');
        }

        // Create the application
        Application::create([
            'property_id' => $property->id,
            'tenant_id'   => $tenant->id,
            'landlord_id' => $property->landlord_id,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted successfully! The landlord will be in touch.');
    }
}
