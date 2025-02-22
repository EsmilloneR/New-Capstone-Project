<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function reservation(Request $request)
    {
        $guests = Reservation::with('user', 'room')
            ->orderBy('created_at', 'desc')->paginate(10);

        foreach ($guests as $guest) {
            if ($guest->payment_link) {
                $urlParts = explode('/', parse_url($guest->payment_link, PHP_URL_PATH));
                $guest->reference_number = end($urlParts);
            } else {
                $guest->reference_number = null;
            }
        }
        return view('admin.billing.reservations.index', compact('guests'));
    }

    public function accept($id)
    {
        $guest = Reservation::findOrFail($id);
        $guest->payment_status = 'paid';
        $guest->save();

        return redirect()->back();
    }

    public function cancel($id)
    {
        $guest = Reservation::findOrFail($id);
        $guest->payment_status = 'canceled';
        $guest->save();

        return redirect()->back();
    }
}
