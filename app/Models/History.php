<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'gejala_terpilih',
        'hasil_diagnosa'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
