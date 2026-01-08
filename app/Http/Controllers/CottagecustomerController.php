<?php

namespace App\Http\Controllers;
use App\Models\Cottage_customer; 
use App\Models\Cottage;    
use Illuminate\Http\Request;

class CottagecustomerController extends Controller
{
    //
    public function storeBooking(Request $request)
{
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
        'notes' => 'nullable|string',
        'other_charges' => 'nullable|array',
        'other_charges.*' => 'nullable|string|max:255',
        'other_amounts' => 'nullable|array',
        'other_amounts.*' => 'nullable|numeric|min:0',
         'room_status' => 'required',
    ]);

    // Combine other charges
    $otherCharges = [];
    if ($request->other_charges && $request->other_amounts) {
        for ($i = 0; $i < count($request->other_charges); $i++) {
            if ($request->other_charges[$i] && $request->other_amounts[$i] != null) {
                $otherCharges[] = [
                    'description' => $request->other_charges[$i],
                    'amount' => $request->other_amounts[$i],
                ];
            }
        }
    }

    // Create booking
    $booking = Cottage_customer::create([
        'cottage_id' => $request->cottage_id,
        'customer_name' => $request->customer_name,
        'customer_contact' => $request->customer_contact,
        'customer_address' => $request->customer_address,
        'customer_email' => $request->customer_email,
        'booking_type' => $request->booking_type,
        'type' => 'cottage',
        'check_in' => $request->check_in,
        'check_out' => $request->booking_type == 'daytime' ? $request->check_in : $request->check_out,
        'check_in_time' => $request->check_in_time,
        'check_out_time' => $request->check_out_time,
        'days_of_stay' => $request->days_of_stay,
        'total_payment' => $request->total_payment,
        'notes' => $request->notes,
        'other_charges' => json_encode($otherCharges),
        'status'=> $request->room_status,

    ]);

     $cottage = Cottage::find($request->cottage_id);

if ($cottage && $cottage->status == 2) {
    $cottage->status = 1; // change to reserved
    $cottage->save();
}

    return redirect()->back()->with('success', 'Booking confirmed successfully!');
}

           public function checkout($id)
            {
                // Find booking
                $booking = Cottage_customer::findOrFail($id);

                $today = now()->format('Y-m-d');  // current date (YYYY-MM-DD)

                // If check_out date is NOT today → update it
                if ($booking->check_out != $today) {
                    $booking->check_out = $today;
                }

                // Mark as checked out
                $booking->status = '3';
                $booking->save();

                // Free the cottage
                $cottage = Cottage::find($booking->cottage_id);
                if ($cottage) {
                    $cottage->status = '0';
                    $cottage->save();   
                }

                return back()->with('success', 'Customer successfully checked out.');
            }

             public function extend(Request $request, $id)
            {
                 $booking = Cottage_customer::findOrFail($id);
               // Update the new extended date/time
                $booking->check_out = $request->check_out_update;

                $booking->save();

                return back()->with('success', 'Customer successfully checked out.');
            }

            public function addCharges(Request $request, $id)
        {
            $booking = Cottage_customer::findOrFail($id);

                // Decode existing JSON charges
                $existingCharges = json_decode($booking->other_charges, true) ?? [];

                // Prepare new charges from form
                $newCharges = [];
                $totalNewAmount = 0;

                for ($i = 0; $i < count($request->description); $i++) {

                    $amount = (float) $request->amount[$i];

                    $newCharges[] = [
                        'description' => $request->description[$i],
                        'amount'      => $amount
                    ];

                    // Sum the new amounts
                    $totalNewAmount += $amount;
                }

                // Merge old + new charges
                $mergedCharges = array_merge($existingCharges, $newCharges);

                // Update other_charges JSON
                $booking->other_charges = json_encode($mergedCharges);

                // Add to total payment
                $booking->total_payment += $totalNewAmount;

                // Save all changes
                $booking->save();

                return back()->with('success', 'Other charges added and total updated successfully!');

        }

          public function accept($id)
{
    $booking = Cottage_customer::findOrFail($id);
    $booking->status = 1; // mark as booked
    $booking->save();

    return redirect()->back()->with('success', 'Booking accepted.');
}

 public function destroy($id)
{
    $room = Cottage_customer::findOrFail($id);
    $room->delete();

    return redirect()->back()->with('success', 'Book deleted successfully.');
}
   
}
