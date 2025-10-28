<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Notifications\ComplaintResolved;

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
        $complaint->landlord_acknowledged = true;
        $complaint->save();

        // notify tenant
        if ($complaint->tenant) {
            $complaint->tenant->notify(new ComplaintResolved($complaint));
        }

        return redirect()->route('dashboard.landlord.complaints.index')->with('success', 'Complaint marked as resolved.');
    }

    /**
     * Landlord can revert their resolve decision.
     */
    public function revert($id)
    {
        $complaint = Complaint::findOrFail($id);
        $landlordId = Auth::guard('landlord')->id() ?? Auth::id();
        if ($complaint->landlord_id !== $landlordId) {
            abort(403);
        }

        // unset landlord acknowledgement
        $complaint->landlord_acknowledged = false;

        // adjust status: if previously resolved -> reopen; if closed -> mark disputed
        if (strtolower($complaint->status) === 'resolved') {
            $complaint->status = 'open';
        } elseif (strtolower($complaint->status) === 'closed') {
            $complaint->status = 'disputed';
        }

        $complaint->is_read_by_tenant = false; // notify tenant
        $complaint->save();

        // notify tenant about the revert
        if ($complaint->tenant) {
            try {
                $complaint->tenant->notify(new \App\Notifications\ComplaintResolutionReverted($complaint));
            } catch (\Throwable $e) {
                // ignore notification errors
            }
        }

        return redirect()->route('dashboard.landlord.complaints.index')->with('info', 'Your resolve decision has been reverted.');
    }
}
