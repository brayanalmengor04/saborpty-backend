<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Activity extends Model
{
    use HasFactory; 

      protected $fillable = [
        'firebase_uid',
        'type',
        'description',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime',
    ];
     public $timestamps = true; 

}
