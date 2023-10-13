<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'country_code',
        'phone_number',
        'fiendly_phone',
        'room_number',
        'name',
        'room_passcode',
        'checkin_date',
        'checkout_date'
    ];
}
