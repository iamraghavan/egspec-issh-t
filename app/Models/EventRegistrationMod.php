<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationMod extends Model
{
    protected $table = 'event_registrations';

    // Specify the fillable fields
    protected $fillable = [
        'event_registration_id',
        'event_id',
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'amount',
        'summary_amount',
        'payment_id',
        'order_id',
        'invoice_id',
        'registration_type',
        'members'

    ];

    // Define relationships

    /**
     * Get the event associated with the registration.
     */
    public function event()
    {
        return $this->belongsTo(Session::class, 'event_id');
    }


    protected $casts = [
        'members' => 'array', // Ensure Laravel casts JSON to an array
    ];

    /**
     * Get the user associated with the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
