<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
        public function index()
    {
        $applications = Application::with(['tenant', 'property'])
            ->where('landlord_id', Auth::guard('landlord')->id())
            ->latest()
            ->get();

        return view('dashboard.landlord.applications.index', compact('applications'));
    }

    public function accept($id)
    {
        $app = Application::findOrFail($id);
        $app->update(['status' => 'accepted']);
        return back()->with('success', 'Application accepted.');
    }

    public function decline($id)
    {
        $app = Application::findOrFail($id);
        $app->update(['status' => 'declined']);
        return back()->with('info', 'Application declined.');
    }

    public function show($id)
    {
        $application = Application::with(['tenant', 'property'])
            ->where('landlord_id', Auth::guard('landlord')->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('dashboard.landlord.applications.show', compact('application'));
    }

    /**
     * Cancel an accepted application (set status to 'cancelled').
     */
    public function cancel($id)
    {
        $app = Application::where('id', $id)
            ->where('landlord_id', Auth::guard('landlord')->id())
            ->firstOrFail();

        if ($app->status !== 'accepted') {
            return back()->with('error', 'Only accepted applications can be cancelled.');
        }

        $app->update(['status' => 'cancelled']);

        return back()->with('info', 'Application cancelled.');
    }
}
