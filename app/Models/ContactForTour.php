<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForTour extends Model
{
    protected $fillable = [
        'name',
        'destination_id',
        'no_of_persons',
        'travel_date',
        'email',
        'phone',
        'message',
        'check_in_date',
        'check_out_date',
        'no_of_adults',
        'children',
        'consent',
        'status',
        'ip',
    ];
}
