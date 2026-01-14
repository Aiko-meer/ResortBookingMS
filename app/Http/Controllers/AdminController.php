<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Room_customer;
use App\Models\Room;
use App\Models\Cottage_customer;
use App\Models\Cottage;

class AdminController extends Controller
{
    //
     public function index(){
    if (!auth()->check()) {
        return redirect()->route('login'); // redirect to login if not logged in
    }
     $roomEarnings = Room_customer::sum('total_payment');
    $cottageEarnings = Cottage_customer::sum('total_payment');
    $totalEarnings = $roomEarnings + $cottageEarnings;

    $totalRoomCustomers = Room_customer::count();
$totalCottageCustomers = Cottage_customer::count();

$totalCustomers = $totalRoomCustomers + $totalCottageCustomers;

$roomPending = Room_customer::where('status', 0)->count();
$cottagePending = Cottage_customer::where('status', 0)->count();

$totalPendingCustomers = $roomPending + $cottagePending;

$roomAvailable = Room::where('status',0)->count();
$cottageAvailable = Cottage::where('status',0)->count();

        return view("admin.index", compact("totalEarnings",
        "totalCustomers","totalPendingCustomers","roomAvailable","cottageAvailable"));
     }
}
