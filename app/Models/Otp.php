<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_wa',
        'otp',
        'valid_until',
        'used_at',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'used_at' => 'datetime',
    ];
}
