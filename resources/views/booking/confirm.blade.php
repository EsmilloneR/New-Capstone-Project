@extends('layouts.homepage')

@section('title', 'Reservation Confirmation')

@push('styles')
    <style>
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .h6,
        p {
            font-size: 1rem;
        }

        .btn {
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.5rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #555;
        }

        .img-fluid {
            max-height: 250px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush


@section('content')
    <div class="container my-3 m-auto">
        <div class="card shadow-sm border-0 rounded-3 mx-auto" style="max-width: 650px;">
            <div class="card-header text-center bg-primary text-white py-3">
                <h3>Booking Confirmation</h3>
            </div>

            <div class="card-body">
                <!-- Room Details Section -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Room:</h6>
                        <p>{{ $room->room_type }}</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('storage/' . $room->profile_picture) }}" class="img-fluid rounded-3"
                            alt="{{ $room->room_type }}" style="max-width: 100%; height: auto;">
                    </div>
                </div>

                <!-- Dates Section -->
                <div class="mb-3">
                    <h6 class="text-muted">Check-in:</h6>
                    <p>{{ $check_in }}</p>
                    <h6 class="text-muted">Check-out:</h6>
                    <p>{{ $check_out }}</p>
                </div>

                <!-- Price and Reservation Type Section -->
                <div class="mb-3">
                    <h6 class="text-muted">Total Amount:</h6>
                    <p>₱{{ number_format((float) $amount, 2) }}</p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Reservation Type:</h6>
                    <p>{{ ucfirst($payment_status) }}</p>
                    @if ($payment_status === 'pay')
                        <h6 class="text-muted">Payment Method:</h6>
                        <p>{{ ucfirst($paymentMethod) }}</p>
                    @endif
                </div>

                <!-- Payment Link Section -->
                @if ($payment_status === 'pay' && isset($paymentLink))
                    <div class="my-3 text-center">
                        <strong>Complete your payment:</strong> <br>
                        <a href="{{ $paymentLink }}" target="_blank" class="btn btn-sm btn-warning text-white"
                            aria-label="Proceed to online payment">Proceed to Payment</a>
                    </div>
                @endif

                <!-- Confirmation Form -->
                <form id="confirmationForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="check_in" value="{{ $check_in }}">
                    <input type="hidden" name="check_out" value="{{ $check_out }}">
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="payment_status" value="{{ $payment_status ?? '' }}">
                    <input type="hidden" name="payment_method" value="{{ $paymentMethod ?? '' }}">
                    <input type="hidden" name="payment_link"value={{ $paymentLink ?? '' }}>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="confirmReservation" required>
                        <label class="form-check-label" for="confirmReservation">I confirm that the information above is
                            correct</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-success px-4 py-2" id="finalizeBtn" disabled>Finalize
                            Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Disable the finalize button until the checkbox is checked
            $('#confirmReservation').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#finalizeBtn').prop('disabled', false);
                } else {
                    $('#finalizeBtn').prop('disabled', true);
                }
            });

            // Optional: Show a confirmation alert before submitting the form
            $('#confirmationForm').on('submit', function(e) {
                e.preventDefault(); // Prevent actual submission for demo
                var confirmed = confirm("Are you sure you want to finalize the reservation?");
                if (confirmed) {
                    this.submit(); // Proceed with form submission if confirmed
                }
            });
        });
    </script>
@endsection
