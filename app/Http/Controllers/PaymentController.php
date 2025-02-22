<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Update the reservation status to 'paid'
        $reservation = Reservation::where('payment_status', 'pending')
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($reservation) {
            $reservation->update([
                'payment_status' => 'paid',
            ]);
            return redirect()->route('booking.index')->with('success', 'Payment Successful! Reservation Confirmed.');
        }

        return redirect()->route('booking.index')->with('error', 'Invalid Reservation.');
    }

    public function failure(Request $request)
    {
        // Handle payment failure
        return redirect()->route('booking.index')->with('error', 'Payment Failed. Please try again.');
    }
}
