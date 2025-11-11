<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Landlord;
use App\Models\Properties;
use App\Models\Tenant;

class AdminReportsController extends Controller
{
    public function index()
    {
        // Logic to fetch reports data
        $tenants = Tenant::all();
        $landlords = Landlord::all();
        $properties = Properties::all();
        $complaints = Complaint::all();
        $users = $tenants->count() + $landlords->count();
        $totalProperties = $properties->count();
        if ($complaints->count() > 0) {
            $openComplaints = $complaints->where('status', '!resolved')->count();
            $resolvedComplaints = $complaints->where('status', 'resolved')->count();
        } else {
            $openComplaints = 0;
            $resolvedComplaints = 0;
            $complaints = null;

        }

        // Recent combined activities (dynamic table)
        $recentComplaints = Complaint::latest()->take(5)->get();
        $recentTenants = Tenant::latest()->take(5)->get();
        $recentLandlords = Landlord::latest()->take(5)->get();
        $recentProperties = Properties::latest()->take(5)->get();

        // Merge all recent activities into one collection for the table
        $recentReports = collect();

        foreach ($recentComplaints as $c) {
            $recentReports->push([
                'type' => 'Complaint',
                'description' => $c->subject ?? 'Complaint submitted',
                'date' => $c->created_at,
                'status' => ucfirst($c->status ?? 'Pending'),
            ]);
        }

        foreach ($recentProperties as $p) {
            $recentReports->push([
                'type' => 'Property',
                'description' => "New property {$p->title} added",
                'date' => $p->created_at,
                'status' => 'Added',
            ]);
        }
        
        foreach ($recentTenants as $t) {
            $recentReports->push([
                'type' => 'User',
                'description' => "New tenant {$t->name} registered",
                'date' => $t->created_at,
                'status' => 'Registered',
            ]);
        }

        foreach ($recentLandlords as $l) {
            $recentReports->push([
                'type' => 'User',
                'description' => "New landlord {$l->name} registered",
                'date' => $l->created_at,
                'status' => 'Registered',
            ]);
        }

        // Sort by most recent date (descending)
        $recentReports = $recentReports->sortByDesc('date')->take(10);

        // Pass reports data to the view
        return view('admin.reports.index', compact('totalProperties', 'users', 'openComplaints', 'resolvedComplaints', 'recentReports'));
    }
}
