<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cottage extends Model
{
    //
    protected $fillable = [
        'room_number',
        'room_type',          
        'capacity_adult',    
        'price_day',
        'price_ov',
       'status',
        'income',
        'amenities',
        'description',
    ];

    public function images()
{
    return $this->hasMany(CottageImage::class);
}
public function cottageCustomers()
{
    return $this->hasMany(Cottage_customer::class);
}
public function currentCustomer()
{
    return $this->hasOne(Cottage_customer::class)
                ->current(); // uses the scope
}


}
