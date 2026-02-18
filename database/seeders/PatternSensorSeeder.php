<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatternSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('pattern_sensor')->insert([
            ['pattern_id' => 1, 'sensor_id' => 1, 'pos' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 1, 'sensor_id' => 2, 'pos' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 1, 'sensor_id' => 3, 'pos' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('pattern_sensor')->insert([
            ['pattern_id' => 2, 'sensor_id' => 1, 'pos' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 2, 'sensor_id' => 2, 'pos' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 2, 'sensor_id' => 3, 'pos' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 2, 'sensor_id' => 4, 'pos' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('pattern_sensor')->insert([
            ['pattern_id' => 3, 'sensor_id' => 1, 'pos' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 3, 'sensor_id' => 2, 'pos' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 3, 'sensor_id' => 3, 'pos' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 3, 'sensor_id' => 4, 'pos' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 3, 'sensor_id' => 5, 'pos' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('pattern_sensor')->insert([
            ['pattern_id' => 4, 'sensor_id' => 1, 'pos' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 4, 'sensor_id' => 2, 'pos' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 4, 'sensor_id' => 3, 'pos' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 4, 'sensor_id' => 4, 'pos' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 4, 'sensor_id' => 5, 'pos' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 4, 'sensor_id' => 6, 'pos' => 6, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('pattern_sensor')->insert([
            ['pattern_id' => 5, 'sensor_id' => 1, 'pos' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 2, 'pos' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 3, 'pos' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 4, 'pos' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 5, 'pos' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 6, 'pos' => 6, 'created_at' => $now, 'updated_at' => $now],
            ['pattern_id' => 5, 'sensor_id' => 7, 'pos' => 7, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
