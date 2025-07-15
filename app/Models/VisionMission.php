<?php
// app/Models/VisionMission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $table = 'vision_mission'; // Specify table name if not pluralized
    protected $fillable = [
        'vision_text',
        'mission_points',
    ];

    protected $casts = [
        'mission_points' => 'array',
    ];
}