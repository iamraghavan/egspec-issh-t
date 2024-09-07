<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    // No need to specify the primary key if it's 'id'
    // protected $primaryKey = 'id';

    protected $fillable = [
        'speaker_id',
        'full_name',
        'job_title',
        'organization',
        'email',
        'phone_number',
        'linkedin_profile',
        'website_url',
        'bio',
        'education',
        'achievements',
        'social_media_handles',
        'profile_url'
    ];

    // Optionally, you can add casts to ensure proper data types
    protected $casts = [
        'social_media_handles' => 'array',
    ];
}
