<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Application as PropertyApplication;
use App\Models\Properties;

class TenantComplaintsController extends Controller
{
    // show list of complaints filed by this tenant
    public function index()
    {
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();
        $complaints = Complaint::where('tenant_id', $tenantId)->orderBy('created_at', 'desc')->get();
        return view('dashboard.tenant.complaints.index', compact('complaints'));
    }

    // show form to create a complaint only for accepted applications
    public function create()
    {
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();

        // properties where tenant has an accepted application
        $acceptedApplications = PropertyApplication::where('tenant_id', $tenantId)
            ->where('status', 'accepted')
            ->with('property')
            ->get();

        $properties = $acceptedApplications->map(function ($a) {
            return $a->property;
        })->filter();

        return view('dashboard.tenant.complaints.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();

        $data = $request->validate([
            'property_id' => 'required|integer',
            'subject' => 'required|string|max:191',
            'description' => 'required|string',
            'attachments.*' => 'sometimes|file|max:2048',
        ]);

        // ensure tenant has an accepted application for this property
        $hasAccepted = PropertyApplication::where('tenant_id', $tenantId)
            ->where('property_id', $data['property_id'])
            ->where('status', 'accepted')
            ->exists();

        if (! $hasAccepted) {
            return back()->withErrors(['property_id' => 'You can only file complaints for properties you have an accepted application for.']);
        }

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaints', 'public');
                $attachments[] = $path;
            }
        }

        // determine landlord_id from property
        $property = Properties::find($data['property_id']);
        $landlordId = $property->landlord_id ?? null;

        $complaint = Complaint::create([
            'tenant_id' => $tenantId,
            'landlord_id' => $landlordId,
            'property_id' => $data['property_id'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'attachments' => $attachments ?: null,
            'status' => 'open',
            'is_read_by_landlord' => false,
            'is_read_by_tenant' => true,
        ]);

        // TODO: create notification entries for landlord and tenant (later step)

        return redirect()->route('dashboard.tenant.complaints.index')->with('success', 'Complaint submitted successfully.');
    }

    public function show($id)
    {
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();
        $complaint = Complaint::where('tenant_id', $tenantId)->where('id', $id)->firstOrFail();

        // mark as read for tenant
        if (! $complaint->is_read_by_tenant) {
            $complaint->is_read_by_tenant = true;
            $complaint->save();
        }

        return view('dashboard.tenant.complaints.show', compact('complaint'));
    }
}
