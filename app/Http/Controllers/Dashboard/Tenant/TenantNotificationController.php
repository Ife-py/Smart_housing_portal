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
        $tenantId = Auth::guard('tenant')->id() ?? Auth::id();

        // For tenants, notifications are updates to their applications
        $unreadApplications = Application::where('tenant_id', $tenantId)
            ->where('status', 'pending')
            ->get();

        $unreadComplaints = Complaint::where('tenant_id', $tenantId)
            ->where('is_read_by_tenant', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $processedApplications = Application::where('tenant_id', $tenantId)
            ->where('status', '!=', 'pending')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        $processedComplaints = Complaint::where('tenant_id', $tenantId)
            ->where('is_read_by_tenant', true)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        $unreadItems = $unreadApplications->concat($unreadComplaints)->sortByDesc('created_at');
        $processedItems = $processedApplications->concat($processedComplaints)->sortByDesc('created_at');

        return view('dashboard.tenant.notification.index', compact('unreadItems', 'processedItems'));
    }
}
