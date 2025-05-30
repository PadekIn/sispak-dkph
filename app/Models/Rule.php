<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /** @use HasFactory<\Database\Factories\RuleFactory> */
    use HasFactory;

    protected $fillable = [
        'kerusakan_id',
        'gejala_id'
    ];

    public function kerusakan() {
        return $this->belongsTo(Kerusakan::class);
    }
    public function gejala() {
        return $this->belongsTo(Gejala::class);
    }
}
