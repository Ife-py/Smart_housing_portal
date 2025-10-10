<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;


class LandlordNotificationController extends Controller
{
    public function index()
    {
        $landlordId = Auth::guard('landlord')->id();
        // applications that are read/processed
        $applications = Application::where('landlord_id', $landlordId)
            ->where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // complaints for this landlord
        $processedComplaints = Complaint::where('landlord_id', $landlordId)
            ->where('is_read_by_landlord', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // unread / new notifications: treat 'pending' applications as unread notifications
        $unreadApplications = Application::where('landlord_id', $landlordId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $unreadComplaints = Complaint::where('landlord_id', $landlordId)
            ->where('is_read_by_landlord', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // merge processed/old items for display
        $processedItems = $applications->concat($processedComplaints)->sortByDesc('created_at');

        // merge unread items
        $unreadItems = $unreadApplications->concat($unreadComplaints)->sortByDesc('created_at');

        return view('dashboard.landlord.notifications.index', [
            'applications' => $processedItems,
            'unreadApplications' => $unreadItems,
        ]);
    }

    public function show($id)
    {
        $application = Application::findOrFail($id);
        if ($application->landlord_id !== Auth::guard('landlord')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // reuse the application details view
        return view('dashboard.landlord.applications.show', compact('application'));
    }
}
