<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
     protected $fillable = [
        'category_id',
        'destination_id',
        'name',
        'slug',
        'address',
        'rating',
        'description',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(HotelCategory::class, 'category_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
