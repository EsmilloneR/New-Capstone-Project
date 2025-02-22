<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Activities;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Get total reservations
        $totalReservations = Reservation::count();

        // Get total paid and pending reservations
        $totalPaid = Reservation::where('payment_status', 'paid')->count();
        $totalPending = Reservation::where('payment_status', 'pending')->count();

        // Get total activities
        $totalActivities = Activities::count();

        // Get the latest activities (You can adjust the number)
        $latestActivities = Activities::latest()->take(5)->pluck('description');

        // Calculate the total revenue (total amount of paid reservations)
        $totalRevenue = Reservation::where('payment_status', 'paid')->sum('amount');

        // Calculate the total pending and completed payments
        $pendingPayments = Reservation::where('payment_status', 'pending')->sum('amount');
        $completedPayments = Reservation::where('payment_status', 'paid')->sum('amount');  // Corrected to directly sum paid reservations

        // Get the latest reservations
        $reservations = Reservation::with('user', 'room')
            ->orderBy('created_at', 'desc')
            ->take(10) // Display the latest 10 reservations
            ->get();

        return view('admin.dashboard', compact(
            'totalReservations',
            'totalPaid',
            'totalPending',
            'totalActivities',
            'totalRevenue',
            'pendingPayments',
            'completedPayments',
            'latestActivities',
            'reservations'
        ));
    }
}
