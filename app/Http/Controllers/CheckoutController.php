<?php

namespace App\Http\Controllers;
use DatePeriod;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\Room;       // ✅ Cottage model
use App\Models\RoomImage; 
use App\Models\Room_customer; 
use App\Models\Cottage;       // ✅ Cottage model
use App\Models\CottageImage; 
use App\Models\Cottage_customer;  

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
         $search = $request->search;

    $rooms = Room_customer::with('room')->get();
   $bookings = Room_customer::get(['check_in', 'check_out']);



    $unavailableDates = [];
    foreach ($bookings as $booking) {
        $period = new DatePeriod(
            new DateTime($booking->check_in),
            new DateInterval('P1D'),
            (new DateTime($booking->check_out))->modify('+1 day') // include last day
        );

        $today = date('Y-m-d');

        foreach ($period as $date) {
        $d = $date->format('Y-m-d');

        // ⭐ If this date is the checkout date AND checkout == today → skip it
        if ($d == $booking->check_out && $booking->check_out == $today) {
            continue;
        }

        $unavailableDates[] = $d;
    }
     $cottages = Cottage_customer::with('cottage')->get();
        return view('admin.book.checkout',compact('rooms','cottages','unavailableDates'));
    }
}

 public function checkoutroom(Request $request)
            {
                $request->validate([
                    'room_id' => 'required',
                ]);

                // Find booking
                $booking = Room_customer::findOrFail($request->room_id);

                $today = now()->format('Y-m-d');  // current date (YYYY-MM-DD)

                // If check_out date is NOT today → update it
                if ($booking->check_out != $today) {
                    $booking->check_out = $today;
                }

                // Mark as checked out
                $booking->status = '3';
                $booking->save();

                // Free the cottage
                $cottage = Room::find($booking->room_id);
                if ($cottage) {
                    $cottage->status = '0';
                    $cottage->save();
                }

                return back()->with('success', 'Customer successfully checked out.');
            }
}