<?php

namespace App\Http\Controllers;
use App\Models\Room;       // ✅ Cottage model
use App\Models\RoomImage; 
use App\Models\Room_customer; 
use DatePeriod;
use DateTime;
use DateInterval;
use App\Models\Cottage;  
use App\Models\Cottage_customer; 
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        $rooms = Room::where('status', 0)->take(3)->get();
         $cottages = Cottage::where('status', 0)->take(3)->get();
        return view("user.index", compact('rooms','cottages'));
    }

   public function room($id)
{
    $room = Room::findOrFail($id);
$bookings = Room_customer::where('room_id', $id)
    ->whereIn('status', [1, 2])
    ->get(['check_in', 'check_out']);

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
    } 

    return view('user.page.roombook', compact('room', 'unavailableDates'));
}

    public function roombook(Request $request){

    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'customer_name' => 'required|string|max:255',
        'customer_contact' => 'required|string|max:50',
        'customer_address' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'check_in' => 'required|date',
        'check_out' => 'nullable|date',
        'check_in_time' => 'required|date_format:H:i',
        'check_out_time' => 'nullable|date_format:H:i',
        'days_of_stay' => 'required|integer|min:0',
        'total_payment' => 'required|numeric|min:0',
    ]);

      $booking = Room_customer::create([
        'room_id' => $request->room_id,
        'customer_name' => $request->customer_name,
        'customer_contact' => $request->customer_contact,
        'customer_address' => $request->customer_address,
        'customer_email' => $request->customer_email,
        'type' => 'room',
        'check_in' => $request->check_in,
        'check_out' => $request->booking_type == 'daytime' ? $request->check_in : $request->check_out,
        'check_in_time' => $request->check_in_time,
        'check_out_time' => $request->check_out_time,
        'days_of_stay' => $request->days_of_stay,
        'total_payment' => $request->total_payment,
        'status'=> '0',

    ]);

         
      return redirect()->route('client')
    ->with('success', 'Booking confirmed successfully!');
    }

    public function rooms(){
          $rooms = Room::where('status', 0)->get();
          return view("user.rooms", compact('rooms'));
    }
     public function cottages(){
          $rooms = Cottage::where('status', 0)->get();
          return view("user.cottage", compact('rooms'));
    }

    public function cottage($id){
        $room = Cottage::findOrFail($id);
$bookings = Cottage_customer::where('cottage_id', $id)
    ->whereIn('status', [1, 2])
    ->get(['check_in', 'check_out']);

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
    } 

    return view('user.page.cottagebook', compact('room', 'unavailableDates'));
    }

     public function cottagebook(Request $request){

  $request->validate([
    'cottage_id' => 'required|exists:cottages,id',
    'customer_name' => 'required|string|max:255',
    'customer_contact' => 'required|string|max:50',
    'customer_address' => 'required|string|max:255',
    'customer_email' => 'required|email|max:255',
    'booking_type' => 'required|in:overnight,daytime',
    'check_in' => 'required|date',
    'check_out' => 'nullable|date',
    'check_in_time' => 'required|date_format:H:i',
    'check_out_time' => 'nullable|date_format:H:i',
    'days_of_stay' => 'required|integer|min:0',
    'total_payment' => 'required|numeric|min:0',
]);

$checkOut = $request->booking_type == 'daytime'
    ? $request->check_in
    : $request->check_out;

// Check duplicate booking with status = 1
$existingBooking = Cottage_customer::where('cottage_id', $request->cottage_id)
    ->where(function ($query) use ($request, $checkOut) {

        $query->whereBetween('check_in', [$request->check_in, $checkOut])
              ->orWhereBetween('check_out', [$request->check_in, $checkOut])
              ->orWhere(function ($q) use ($request, $checkOut) {
                  $q->where('check_in', '<=', $request->check_in)
                    ->where('check_out', '>=', $checkOut);
              });

    })
    ->exists();

if ($existingBooking) {
    return back()
        ->withInput()
        ->with('error', 'This cottage is already reserved on the selected date.');
}

$booking = Cottage_customer::create([
    'cottage_id' => $request->cottage_id,
    'customer_name' => $request->customer_name,
    'customer_contact' => $request->customer_contact,
    'customer_address' => $request->customer_address,
    'customer_email' => $request->customer_email,
    'booking_type' => $request->booking_type,
    'type' => 'cottage',
    'check_in' => $request->check_in,
    'check_out' => $checkOut,
    'check_in_time' => $request->check_in_time,
    'check_out_time' => $request->check_out_time,
    'days_of_stay' => $request->days_of_stay,
    'total_payment' => $request->total_payment,
    'status' => '0',
]);

return redirect()->route('client')
    ->with('success', 'Booking confirmed successfully!');
}
}