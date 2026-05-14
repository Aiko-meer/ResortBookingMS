<?php

namespace App\Http\Controllers;
use DatePeriod;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\Cottage;       // ✅ Cottage model
use App\Models\CottageImage; 
use App\Models\Cottage_customer; 
class CottageController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!auth()->check()) {
        return redirect()->route('login'); // redirect to login if not logged in
    }
        // Get the last room number
    $lastRoom = Cottage::orderBy('id', 'desc')->first();

    if ($lastRoom) {
        // Extract number from last room (assuming format like "101", "102", etc.)
        $nextRoomNumber = $lastRoom->room_number + 1;
    } else {
        $nextRoomNumber = 101; // default starting number
    }
        $search = $request->search;

    $rooms = Cottage::when($search, function ($query, $search) {
        $query->where('room_number', 'LIKE', "%{$search}%")
              ->orWhere('room_type', 'LIKE', "%{$search}%");
    })->get();
        return view('admin.cottage.table',compact('rooms','nextRoomNumber'));
    }

    public function view($id)
    {
        $cottage = Cottage::with(['images', 'cottageCustomers'])->findOrFail($id);
          // Get only bookings with status 1 (booked) or 3 (occupied)
$bookings = Cottage_customer::where('cottage_id', $id)
    ->whereIn('status', [1, 2]) // Only consider active bookings
    ->get(['check_in', 'check_out']);

$unavailableDates = [];
$today = date('Y-m-d');

foreach ($bookings as $booking) {
    $period = new DatePeriod(
        new DateTime($booking->check_in),
        new DateInterval('P1D'),
        (new DateTime($booking->check_out))->modify('+1 day') // include last day
    );

    foreach ($period as $date) {
        $d = $date->format('Y-m-d');

        // Skip the checkout date if it is today
        if ($d == $booking->check_out && $booking->check_out == $today) {
            continue;
        }

        $unavailableDates[] = $d;
    }
}
         $amenities = json_decode($cottage->amenities, true) ?? [];
       return view('admin.cottage.view', compact('cottage','amenities','unavailableDates'));
    }

    public function destroy($id)
{
    $room = Cottage::findOrFail($id);
    $room->delete();

    return redirect()->back()->with('success', 'Room deleted successfully.');
}


    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'room_number' => 'required|string|unique:cottages,room_number',
            'capacity_adult' => 'required|integer|min:1',
            'price_day' => 'required|numeric|min:0',
             'price_ov' => 'required|numeric|min:0',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 20 MB each 
            'amenities' => 'nullable|array',
           'description' => 'required|string',
        ]);

        // Create cottage
        $cottage = Cottage::create([
            'room_number' => $request->room_number,
            'capacity_adult' => $request->capacity_adult,
            'price_day' => $request->price_day,
            'price_ov' => $request->price_ov,
            'status' => 0,
            'income'=> 0,
            'amenities' => json_encode($request->amenities ?? []), // save amenities as JSON
            'description' => $request->description,
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cottages', 'public'); // stored in storage/app/public/cottages
                $cottage->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cottage added successfully!');
    }

    public function update(Request $request, $id)
{
    $cottage = Cottage::findOrFail($id);

    $validated = $request->validate([
        'room_type' => 'required',
        'description' => 'required',
        'capacity_adult' => 'required|integer',
        'price_day' => 'required|numeric|min:0',
        'price_ov' => 'required|numeric|min:0',
        'amenities' => 'nullable|array',
        'images.*' => 'nullable|image|max:2048'
    ]);

    // Update simple fields
    $cottage->room_type = $request->room_type;
    $cottage->description = $request->description;
    $cottage->capacity_adult = $request->capacity_adult;
    $cottage->price_day = $request->price_day;
    $cottage->price_ov = $request->price_ov;

    // Update amenities
    $cottage->amenities = json_encode($request->amenities ?? []);

    // Save cottage first
    $cottage->save();

    // If user uploads new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cottages'), $filename);

            CottageImage::create([
                'cottage_id' => $cottage->id,
                'image_path' => 'uploads/cottages/' . $filename,
            ]);
        }
    }

    return back()->with('success', 'Cottage updated successfully.');
}

}
