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
        $totalReservations = Reservation::count();
        $totalPaid = Reservation::where('payment_status', 'paid')->count();
        $totalPending = Reservation::where('payment_status', 'pending')->count();
        $totalActivities = Activities::count();
        $latestActivities = Activities::latest()->take(5)->pluck('description');
        $totalRevenue = Reservation::where('payment_status', 'paid')->sum('amount');
        $pendingPayments = Reservation::where('payment_status', 'pending')->sum('amount');
        $completedPayments = $totalRevenue - $pendingPayments;

        // Get the latest reservations
        $reservations = Reservation::with('user', 'room')
            ->orderBy('created_at', 'desc')
            ->take(10)
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
