<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        $landlordId = Auth::guard('landlord')->id() ?? Auth::id();
        $complaints = Complaint::where('landlord_id', $landlordId)->orderBy('created_at', 'desc')->get();
        return view('dashboard.landlord.complaints.index', compact('complaints'));
    }

    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        $landlordId = Auth::guard('landlord')->id() ?? Auth::id();
        if ($complaint->landlord_id !== $landlordId) {
            abort(403);
        }

        // mark as read for landlord
        $complaint->is_read_by_landlord = true;
        $complaint->save();

        return view('dashboard.landlord.complaints.show', compact('complaint'));
    }

    public function resolve($id)
    {
        $complaint = Complaint::findOrFail($id);
        $landlordId = Auth::guard('landlord')->id() ?? Auth::id();
        if ($complaint->landlord_id !== $landlordId) {
            abort(403);
        }

        $complaint->status = 'resolved';
        $complaint->is_read_by_tenant = false; // notify tenant
        $complaint->save();

        // TODO: create notification for tenant (later step)

        return redirect()->route('dashboard.landlord.complaints.index')->with('success', 'Complaint marked as resolved.');
    }
}
