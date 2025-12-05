<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'status',
        'keterangan',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo(user::class);
    }
}
