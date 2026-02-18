<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pattern;

class PatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pattern::create(['name' => '3MP', 'cycle_time' => 39.5, 'max_time' => 49.5, 'min_time' => 29.5]);
        Pattern::create(['name' => '4MP', 'cycle_time' => 27.5, 'max_time' => 37.5, 'min_time' => 17.5]);
        Pattern::create(['name' => '5MP', 'cycle_time' => 25, 'max_time' => 35, 'min_time' => 35]);
        Pattern::create(['name' => '6MP', 'cycle_time' => 20, 'max_time' => 30, 'min_time' => 10]);
        Pattern::create(['name' => '7MP', 'cycle_time' => 19, 'max_time' => 29, 'min_time' => 9]);
    }
}
