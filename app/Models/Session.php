<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions_events';
    protected $casts = [
        'date' => 'datetime',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
    ];
    protected $dates = ['date'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'conducted_by',
        'start_time',
        'end_time',
        'date',
        'location',
        'venue',
        'department',
        'mode',
        'meeting_url',
        'price_type',
        'amount',
        'is_hide',
    ];

    // Define the relationship with EventRegistration
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistrationMod::class, 'event_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'event_id');
    }
}
