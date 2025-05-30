<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 1]);
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 2]);
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 3]);
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 4]);
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 5]);
        Rule::create(['kerusakan_id' => 1, 'gejala_id' => 6]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 7]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 8]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 9]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 10]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 11]);
        Rule::create(['kerusakan_id' => 2, 'gejala_id' => 12]);
        Rule::create(['kerusakan_id' => 3, 'gejala_id' => 13]);
        Rule::create(['kerusakan_id' => 3, 'gejala_id' => 14]);
        Rule::create(['kerusakan_id' => 3, 'gejala_id' => 15]);
        Rule::create(['kerusakan_id' => 4, 'gejala_id' => 16]);
        Rule::create(['kerusakan_id' => 4, 'gejala_id' => 17]);
        Rule::create(['kerusakan_id' => 4, 'gejala_id' => 18]);
        Rule::create(['kerusakan_id' => 4, 'gejala_id' => 19]);
        Rule::create(['kerusakan_id' => 4, 'gejala_id' => 20]);
        Rule::create(['kerusakan_id' => 5, 'gejala_id' => 21]);
        Rule::create(['kerusakan_id' => 5, 'gejala_id' => 22]);
        Rule::create(['kerusakan_id' => 5, 'gejala_id' => 23]);
    }
}
