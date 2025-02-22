@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Reservations</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalReservations }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Paid</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalPaid }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Total Pending</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalPending >= 0 ? $totalPending : 0 }}</h5>
                            <!-- Ensure no negative pending reservations -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Activities</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalActivities }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservations Table -->
            <div class="card mb-4">
                <div class="card-header">Reservations</div>
                <div class="card-body">
                    @if ($reservations->isEmpty())
                        <p>No reservations available.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Check-in</th>
                                    <th scope="col">Check-out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->room->room_type }}</td>
                                        <td>{{ ucfirst($reservation->payment_status) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('F j, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('F j, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Billing Overview -->
            <div class="card mb-4">
                <div class="card-header">Billing Overview</div>
                <div class="card-body">
                    <p><strong>Pending Payments:</strong> ₱{{ number_format($pendingPayments, 2) }}</p>
                    <!-- Pending payments are based on those reservations that are marked as 'pending' -->

                    <p><strong>Completed Payments: </strong>₱{{ number_format($completedPayments, 2) }}</p>
                    <!-- Completed payments are based on those reservations that are marked as 'paid' -->
                </div>
            </div>

            <!-- Latest Activities -->
            <div class="card mb-4">
                <div class="card-header">Latest Activities</div>
                <div class="card-body">
                    @if ($latestActivities->isEmpty())
                        <p>No recent activities.</p>
                    @else
                        <ul>
                            @foreach ($latestActivities as $activity)
                                <li>{{ $activity }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
