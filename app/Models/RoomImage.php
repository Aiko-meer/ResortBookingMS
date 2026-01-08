<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    // Fillable fields so you can use ->create()
    protected $fillable = [
        'cottage_id',
        'image_path',
    ];

    // Relationship: each image belongs to a cottage
    public function cottage()
    {
        return $this->belongsTo(Room::class);
    }
}
