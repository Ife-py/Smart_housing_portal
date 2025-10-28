<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminComplaintsController extends Controller
{
    public function index()
    {
        $q = request('q');
        $status = request('status');

        $query = Complaint::with(['tenant', 'property', 'landlord'])->latest();

        // only show complaints that are resolved/closed/disputed or have a tenant response or landlord acknowledged
        $query->where(function($filter) {
            $filter->whereIn('status', ['resolved', 'closed', 'disputed'])
                ->orWhereNotNull('tenant_response')
                ->orWhere('landlord_acknowledged', true);
        });

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('subject', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('tenant', function($t) use ($q) {
                        $t->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
                    });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $complaints = $query->paginate(15)->withQueryString();

        return view('admin.complaint', compact('complaints'));
    }

    /**
     * Mark a complaint as resolved.
     */
    public function resolve($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = 'resolved';
        $complaint->is_read_by_tenant = false;
        $complaint->save();

        // notify tenant
        if ($complaint->tenant) {
            try {
                $complaint->tenant->notify(new \App\Notifications\ComplaintResolved($complaint));
            } catch (\Throwable $e) {
                // swallow notification errors to avoid breaking admin flow
            }
        }

        return redirect()->back()->with('success', 'Complaint marked as resolved.');
    }
}
