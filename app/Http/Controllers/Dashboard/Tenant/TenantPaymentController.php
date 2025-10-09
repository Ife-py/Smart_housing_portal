<?php

namespace App\Http\Controllers\Dashboard\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class TenantPaymentController extends Controller
{
    public function index()
    {
        return view('dashboard.tenant.payment.index');
    }

    public function show($id)
    {
        $payment = Payment::with(['property', 'application'])->where('id', $id)
            ->where('tenant_id', Auth::guard('tenant')->id() ?? Auth::id())
            ->firstOrFail();

        return view('dashboard.tenant.payment.show', compact('payment'));
    }

    public function pay($id)
    {
        $payment = Payment::where('id', $id)
            ->where('tenant_id', Auth::guard('tenant')->id() ?? Auth::id())
            ->firstOrFail();

        // Dummy payment: mark as paid
        $payment->update(['status' => 'paid']);

        return redirect()->route('dashboard.tenant.payments.index')->with('success', 'Payment completed (dummy).');
    }
}
