<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShiftSeeder::class,
            WorkHourSeeder::class,
            ProductInSeeder::class,
            // // ProductOutSeeder::class,
            BestRecordSeeder::class,
            LinePerformanceSeeder::class,
            SensorSeeder::class,
            PatternSeeder::class,
            PatternSensorSeeder::class,
            PatternHistorySeeder::class,
            MarqueeTextSeeder::class,
            UserSeeder::class,
        ]);
    }
}
