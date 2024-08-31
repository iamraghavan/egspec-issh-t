<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'description', 'properties'];

    protected $casts = [
        'properties' => 'array',
    ];

    // Optional: Define the relationship if you need user details
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}