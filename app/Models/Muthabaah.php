<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muthabaah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'sholat_dhuha',
        'sholat_qobliyah',
        'sholat_tahajud',
        'murojaah',
        'q_shubuh', 'q_zuhur', 'q_ashar', 'q_maghrib', 'q_isya',
        'b_zuhur', 'b_maghrib', 'b_isya',
        'dhuha_rakaat', 'tahajud_rakaat', 'murojaah_halaman',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'sholat_dhuha' => 'boolean',
        'sholat_qobliyah' => 'boolean',
        'sholat_tahajud' => 'boolean',
        'murojaah' => 'boolean',
        'q_shubuh' => 'boolean',
        'q_zuhur' => 'boolean',
        'q_ashar' => 'boolean',
        'q_maghrib' => 'boolean',
        'q_isya' => 'boolean',
        'b_zuhur' => 'boolean',
        'b_maghrib' => 'boolean',
        'b_isya' => 'boolean',
        'dhuha_rakaat' => 'integer',
        'tahajud_rakaat' => 'integer',
        'murojaah_halaman' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
