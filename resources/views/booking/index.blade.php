<!-- resources/views/booking.blade.php -->

@extends('layouts.homepage')

@section('title', 'Booking Page')

@push('styles')
@endpush

@section('content')
    <x-booking class="container m-auto my-3">
        <x-slot name="header">
            <h2>Hotel Room Booking</h2>
        </x-slot>

        <x-slot name="roomSelection">
            <label for="room" class="form-label"><strong>Select Room</strong></label>
            <select id="room" name="room_id" class="form-select" required>
                <option value="">Choose a room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" data-price="{{ $room->rate_per_night }}"
                        data-img="{{ asset('storage/' . $room->profile_picture) }}">
                        {{ $room->room_type }} - ₱{{ number_format((float) $room->rate_per_night, 2) }}
                    </option>
                @endforeach
            </select>
        </x-slot>

        <x-slot name="roomImage">
            <label for="hotel-image" class="form-label"><strong>Room Preview</strong></label>
            <img id="hotel-image" src="" alt="Select a room to see an image"
                class="img-fluid d-none border rounded d-flex"
                style="width: 100%; max-width: 500px; height: 300px; object-fit: cover;" />
            <hr>
        </x-slot>
        <x-slot name="checkIn">
            <label for="check_in" class="form-label"><strong>Check-in Date</strong></label>
            <input type="date" id="check_in" name="check_in" class="form-control" required />
        </x-slot>

        <x-slot name="checkOut">
            <label for="check_out" class="form-label"><strong>Check-out Date</strong></label>
            <input type="date" id="check_out" name="check_out" class="form-control" required />
        </x-slot>

        <x-slot name="totalPrice">
            <label for="amount" class="form-label"><strong>Total Amount</strong></label>
            <input type="text" id="amount" name="total_price" class="form-control" readonly />
        </x-slot>

        <x-slot name="reservationType">
            <label for="reservation-type" class="form-label"><strong>Reservation Type</strong></label>
            <select id="reservation-type" name="payment_status" class="form-select" required>
                <option value="">Select an option</option>
                <option value="reserve">Reserve</option>
                <option value="pay">Pay Now</option>
            </select>
        </x-slot>

        <x-slot name="paymentMethod">
            <div id="payment-method-container" name="inside" class="mb-3 d-none">
                <label for="payment-method" class="form-label"><strong>Payment Method</strong></label>
                <select id="payment-method" name="payment_method" class="form-select">
                    <option value="credit-card">Credit Card</option>
                    <option value="gcash">GCash</option>
                </select>
            </div>
        </x-slot>
    </x-booking>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function updateTotalPrice() {
                    let selectedOption = $("#room").find(":selected");
                    let pricePerNight = selectedOption.data("price") || 0;
                    let check_in = new Date($("#check_in").val());
                    let check_out = new Date($("#check_out").val());

                    if (check_in && check_out && check_out > check_in) {
                        let numberOfNights = Math.ceil((check_out - check_in) / (1000 * 60 * 60 * 24));
                        $("#amount").val(Number(pricePerNight * numberOfNights));
                    } else {
                        $("#amount").val("");
                    }
                }

                function updateRoomImage() {
                    let selectedOption = $("#room").find(":selected");
                    let imageUrl = selectedOption.data("img");
                    $("#hotel-image").attr("src", imageUrl).toggleClass("d-none", !imageUrl);
                }

                $("#room").change(function() {
                    let roomId = $(this).val();
                    $("#selected_room_id").val(roomId);
                    updateTotalPrice();
                    updateRoomImage();
                });

                $("#check_in, #check_out").change(updateTotalPrice);

                $("#reservation-type").change(function() {
                    $("#payment-method-container").toggleClass("d-none", $(this).val() !== "pay");
                });
            });
        </script>
    @endpush
@endsection
