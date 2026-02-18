<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sensor;
use Carbon\Carbon;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Sensor::insert([
            ['name' => 'Sensor 1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 3', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 4', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 5', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 6', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sensor 7', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
