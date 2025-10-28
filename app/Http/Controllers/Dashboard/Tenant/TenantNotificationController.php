<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class TenantNotificationController extends Controller
{
    public function index(){
        $user = Auth::guard('tenant')->user() ?? Auth::user();

        if (! $user) {
            abort(403);
        }

        $allNotifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        $unreadNotifications = $user->unreadNotifications()->orderBy('created_at', 'desc')->get();

        // Keep names expected by the view
        $unreadItems = $unreadNotifications;
        $processedItems = $allNotifications;

        return view('dashboard.tenant.notification.index', compact('unreadItems', 'processedItems'));
    }

    /**
     * Mark a tenant database notification as read and redirect to stored URL
     */
    public function notificationShow($id)
    {
        $user = Auth::guard('tenant')->user() ?? Auth::user();
        if (! $user) {
            abort(403, 'Unauthorized');
        }

        $notification = $user->notifications()->find($id);
        if (! $notification) {
            abort(404);
        }

        $notification->markAsRead();

        $url = $notification->data['url'] ?? route('dashboard.tenant.notifications.index');
        return redirect($url);
    }
}
