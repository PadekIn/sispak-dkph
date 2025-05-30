<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    /** @use HasFactory<\Database\Factories\KerusakanFactory> */
    use HasFactory;

        protected $fillable = [
            'nama',
            'kategori',
            'solusi'
        ];

    public function rules() {
        return $this->hasMany(Rule::class);
    }
}
