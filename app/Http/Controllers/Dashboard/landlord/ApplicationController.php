<?php

namespace App\Http\Controllers\Dashboard\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

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

        // Create a dummy payment record and associate with the application
        try {
            $amount = 0;
            if ($app->property && isset($app->property->price)) {
                $amount = $app->property->price;
            }

            $reference = 'PAY-' . strtoupper(bin2hex(random_bytes(4)));

            $payment = Payment::create([
                'application_id' => $app->id,
                'tenant_id' => $app->tenant_id,
                'landlord_id' => $app->landlord_id,
                'property_id' => $app->property_id,
                'amount' => $amount,
                'reference' => $reference,
                'status' => 'pending',
            ]);
        } catch (\Exception $e) {
            // If payment creation fails, still return success for acceptance
            return back()->with('success', 'Application accepted. (Payment creation failed)');
        }

        return redirect()->route('dashboard.landlord.application.show', $app->id)->with('success', 'Application accepted and payment created.');
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

        // mark as read for landlord
        if (! $application->is_read_by_landlord) {
            $application->is_read_by_landlord = true;
            $application->save();
        }

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
