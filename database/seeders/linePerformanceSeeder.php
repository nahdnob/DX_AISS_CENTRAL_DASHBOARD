<?php

namespace Database\Seeders;

use App\Models\LinePerformance;
use Illuminate\Database\Seeder;;

class linePerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LinePerformance::create(['month'  => 'August',    'year'   => '2025', 'target' => 88.0, 'actual' => 84.6]);
        LinePerformance::create(['month'  => 'September', 'year'   => '2025', 'target' => 88.0, 'actual' => 84.8]);
        LinePerformance::create(['month'  => 'October',   'year'   => '2025', 'target' => 88.0, 'actual' => 86.9]);
        LinePerformance::create(['month'  => 'November',  'year'   => '2025', 'target' => 88.0, 'actual' => 88.2]);
        LinePerformance::create(['month'  => 'December',  'year'   => '2025', 'target' => 88.0, 'actual' => 84.6]);
    }
}
