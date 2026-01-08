<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cottage_customer extends Model
{
    //
     protected $fillable = [
        'cottage_id',
        'customer_name',
        'customer_contact',
        'customer_address',
        'customer_email',
        'booking_type',
        'type', 
        'check_in',
        'check_out',
        'check_in_time',
        'check_out_time',
        'days_of_stay',
        'total_payment',
        'notes',
        'other_charges',
        'status',
    ];

    // Optional: if you want to auto-cast JSON to array
    protected $casts = [
        'other_charges' => 'array',
    ];

    // Relation to Cottage
    public function cottage()
    {
        return $this->belongsTo(Cottage::class);
    }
    public function scopeCurrent($query)
{
    $today = now()->toDateString(); // e.g., "2025-12-06"
    return $query->where('check_in', '<=', $today)
                 ->where('check_out', '>=', $today);
}

}
