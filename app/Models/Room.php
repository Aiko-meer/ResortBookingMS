<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = [
        'room_number',
        'room_type',        
        'capacity_adult',    
        'price',
       'status',
        'income',
        'amenities',
        'description',
    ];

    public function images()
{
    return $this->hasMany(RoomImage::class);
}
public function cottageCustomers()
{
    return $this->hasMany(Room_customer::class);
}
public function currentCustomer()
{
    return $this->hasOne(Room_customer::class);
                
}

protected $casts = [
    'check_in' => 'date',
];



}
