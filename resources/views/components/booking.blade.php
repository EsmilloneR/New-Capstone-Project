<!-- resources/views/components/booking.blade.php -->
<div class="card">
    <!-- Header Section -->
    <div id="booking-form" class="card-header">
        {{ $header }}
    </div>

    <!-- Body Section -->
    <div class="card-body">
        <form id="bookRoomForm" method="POST" action="{{ route('booking.confirm') }}">
            @csrf
            @method('POST')
            <input type="hidden" name="room_id" id="selected_room_id" value="">

            <!-- Room Selection -->
            <div class="mb-3">
                {{ $roomSelection }} <!-- Slot for room selection -->
            </div>

            <!-- Room Image -->
            <div class="mb-3">
                {{ $roomImage }} <!-- Slot for room preview image -->
            </div>

            <!-- Check-in Date -->
            <div class="mb-3">
                {{ $checkIn }} <!-- Slot for check-in date -->
            </div>

            <!-- Check-out Date -->
            <div class="mb-3">
                {{ $checkOut }} <!-- Slot for check-out date -->
            </div>

            <!-- Total Price -->
            <div class="mb-3">
                {{ $totalPrice }} <!-- Slot for total price -->
            </div>

            <!-- Reservation Type -->
            <div class="mb-3">
                {{ $reservationType }} <!-- Slot for reservation type -->
            </div>

            <!-- Payment Method Container -->
            <div class="mb-3">
                {{ $paymentMethod }} <!-- Slot for payment method -->
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary d-flex align-items-center"><img
                    src="{{ asset('images/svg/confirm.svg') }}" class="img-fluid svg-link"
                    style="height: 25px; margin-right: 8px;">
                Confirm</button>
        </form>
    </div>
</div>
