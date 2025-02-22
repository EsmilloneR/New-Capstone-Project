<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add logging for debugging
use GuzzleHttp\Client;

class ReservationController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('booking.index', compact('rooms'));
    }

    public function confirm(Request $request)
    {
        $room = Room::findOrFail($request->room_id);

        // dd($request->total_price);
        $mongo = env('PAYMONGO_API_KEY');
        // Ensure the amount is at least Php 100.00 (10000 in cents)
        $amountInCents = max($request->total_price * 100, 10000);

        // If payment type is 'pay', create a payment link with PayMongo API
        $paymentLink = null;
        if ($request->payment_status === 'pay') {
            try {
                $client = new Client();
                $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Basic ' . base64_encode($mongo),
                        'content-type' => 'application/json',
                    ],
                    'json' => [
                        'data' => [
                            'attributes' => [
                                'amount' => $amountInCents,
                                'description' => 'Room Reservation Payment',
                                'redirect' => [
                                    'success' => route('payment.success'),
                                    'failure' => route('payment.failure'),
                                ],
                            ],
                        ],
                    ],
                ]);

                $body = json_decode($response->getBody(), true);
                Log::info('PayMongo Response:', $body);

                if (isset($body['data']['attributes']['checkout_url'])) {
                    $paymentLink = $body['data']['attributes']['checkout_url'];
                } else {
                    return redirect()->route('booking.index')->with('error', 'Failed to generate payment link. Please try again.');
                }
            } catch (\Exception $e) {
                Log::error('PayMongo API Error: ' . $e->getMessage());
                return redirect()->route('booking.index')->with('error', 'An error occurred while creating the payment link.');
            }
        }
        // dd($paymentLink);
        return view('booking.confirm', [
            'room' => $room,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'amount' => $request->total_price,
            'payment_status' => $request->payment_status,
            'paymentMethod' => $request->payment_method,
            'paymentLink' => $paymentLink,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'amount' => 'required|numeric',
            'payment_status' => 'required|in:reserve,pay',
            'payment_method' => 'nullable|string',
            'payment_link' => 'nullable|url'
        ]);

        $paymentMethod = $request->payment_status === 'reserve' ? 'cash' : $request->payment_method;

        $paymentStatus = $request->payment_status === 'pay' ? 'paid' : 'pending';

        // Handle the payment_link only if payment_status is 'pay'
        $paymentLink = $request->payment_status === 'pay' ? $request->payment_link : null;

        // dd($paymentLink);
        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'amount' => $request->amount,
            'payment_status' => $paymentStatus,
            'payment_method' => $paymentMethod,
            'payment_link' => $paymentLink
        ]);

        return redirect()->route('booking.index')->with('success', 'Reservation successfully created!');
    }
}
