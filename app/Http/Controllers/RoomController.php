<?php

namespace App\Http\Controllers;
use DatePeriod;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\Room;       // ✅ Cottage model
use App\Models\RoomImage; 
use App\Models\Room_customer; 
class RoomController extends Controller
{
    //
    public function index()
    {
        if (!auth()->check()) {
        return redirect()->route('login'); // redirect to login if not logged in
    }
        // Get the last room number
    $lastRoom = Room::orderBy('id', 'desc')->first();

    if ($lastRoom) {
        // Extract number from last room (assuming format like "101", "102", etc.)
        $nextRoomNumber = $lastRoom->room_number + 1;
    } else {
        $nextRoomNumber = 101; // default starting number
    }
        $rooms = Room::all();
        return view('admin.room.table',compact('rooms','nextRoomNumber'));
    }

    public function view($id)
    {
        $cottage = Room::with(['images', 'cottageCustomers'])->findOrFail($id);
          // Get only bookings with status 1 (booked) or 3 (occupied)
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
         $amenities = json_decode($cottage->amenities, true) ?? [];
       return view('admin.room.view', compact('cottage','amenities','unavailableDates'));
    }

    public function destroy($id)
{
    $room = Room::findOrFail($id);
    $room->delete();

    return redirect()->back()->with('success', 'Room deleted successfully.');
}


    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'room_type' => 'required|string',
            'capacity_adult' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 20 MB each 
            'amenities' => 'nullable|array',
           'description' => 'required|string',
        ]);

        // Create cottage
        $cottage = Room::create([
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'capacity_adult' => $request->capacity_adult,
            'price' => $request->price,
            'status' => 0,
            'income'=> 0,
            'amenities' => json_encode($request->amenities ?? []), // save amenities as JSON
            'description' => $request->description,
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('room', 'public'); // stored in storage/app/public/cottages
                $cottage->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cottage added successfully!');
    }

    public function update(Request $request, $id)
{
    $cottage = Room::findOrFail($id);

    $validated = $request->validate([
        'room_type' => 'required',
        'description' => 'required',
        'capacity_adult' => 'required|integer',
        'price' => 'required|numeric|min:0',
        'amenities' => 'nullable|array',
        'images.*' => 'nullable|image|max:2048'
    ]);

    // Update simple fields
    $cottage->room_type = $request->room_type;
    $cottage->description = $request->description;
    $cottage->capacity_adult = $request->capacity_adult;
    $cottage->price = $request->price;

    // Update amenities
    $cottage->amenities = json_encode($request->amenities ?? []);

    // Save cottage first
    $cottage->save();

    // If user uploads new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/room'), $filename);

            CottageImage::create([
                'cottage_id' => $cottage->id,
                'image_path' => 'uploads/room/' . $filename,
            ]);
        }
    }

    return back()->with('success', 'Cottage updated successfully.');
}

}
