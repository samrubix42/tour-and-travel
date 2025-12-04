<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForTaxi extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'pickup_date', 'pickup_location', 'drop_location', 'car_model', 'message', 'status'
    ];
}
