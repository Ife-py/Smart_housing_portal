<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
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

        // unread / new notifications: treat 'pending' applications as unread notifications
        $unreadApplications = Application::where('landlord_id', $landlordId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.landlord.notifications.index', compact('applications','unreadApplications'));
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
