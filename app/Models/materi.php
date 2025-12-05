<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materies'; // Sesuaikan dengan nama tabel di database (migration)

    protected $fillable = [
        'judul',
        'materi',
        'is_important',
        'location',
        'type'
    ];

    protected $casts = [
        'is_important' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
