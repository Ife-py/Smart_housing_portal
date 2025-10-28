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
        // Use the database notifications as the source of truth for the notifications page.
        $user = Auth::guard('landlord')->user();

        if (! $user) {
            abort(403);
        }

        // all notifications (paginated lightly)
        $allNotifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        $unreadNotifications = $user->unreadNotifications()->orderBy('created_at', 'desc')->get();

        // keep variable names compatible with existing view expectations
        return view('dashboard.landlord.notifications.index', [
            'applications' => $allNotifications,
            'unreadApplications' => $unreadNotifications,
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

    /**
     * Mark a database notification as read and redirect to its stored URL.
     */
    public function notificationShow($id)
    {
        $user = Auth::guard('landlord')->user();
        if (! $user) {
            abort(403, 'Unauthorized');
        }

        $notification = $user->notifications()->find($id);
        if (! $notification) {
            abort(404);
        }

        $notification->markAsRead();

        $url = $notification->data['url'] ?? route('dashboard.landlord.notifications.index');
        return redirect($url);
    }
}
