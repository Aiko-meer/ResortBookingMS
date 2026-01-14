<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;       // ✅ Cottage model
use App\Models\RoomImage; 
use App\Models\Room_customer; 
use App\Models\Cottage;       // ✅ Cottage model
use App\Models\CottageImage; 
use App\Models\Cottage_customer;  
class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!auth()->check()) {
        return redirect()->route('login'); // redirect to login if not logged in
    }
         $search = $request->search;

   $rooms = Room_customer::with('room')->get();

     $cottages = Cottage_customer::with('cottage')->get();
        return view('admin.book.table',compact('rooms','cottages'));
    }

    public function roomcheckin($id)
    {
         // Find booking
                $booking = Room_customer::findOrFail($id);

                // Mark as checked out
                $booking->status = '2';
                $booking->save();

                // Free the cottage
                $cottage = Room::find($booking->room_id);
                if ($cottage) {
                    $cottage->status = '1';
                    $cottage->save();
                }

                return back()->with('success', 'Customer successfully checked out.');
    }

    public function cottagecheckin($id)
    {
         // Find booking
                $booking = Cottage_customer::findOrFail($id);

                // Mark as checked out
                $booking->status = '2';
                $booking->save();

                // Free the cottage
                $cottage = Cottage::find($booking->cottage_id);
                if ($cottage) {
                    $cottage->status = '1';
                    $cottage->save();
                }

                return back()->with('success', 'Customer successfully checked out.');
    }

    
}
