<?php

namespace App\Http\Controllers\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class TenantNotificationController extends Controller
{
    public function index(){
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();

        // For tenants, notifications are updates to their applications
        $unreadApplications = Application::where('tenant_id', $tenantId)
            ->where('status', 'pending')
            ->get();

        $processedApplications = Application::where('tenant_id', $tenantId)
            ->where('status', '!=', 'pending')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        return view('dashboard.tenant.notification.index', compact('unreadApplications', 'processedApplications'));
    }
}
