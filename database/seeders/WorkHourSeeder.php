<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\WorkHour;

class WorkHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Shift Pagi (Shift ID = 1)
        WorkHour::create(['shift_id' => 1, 'hour_number' => 1,  'time_start' => '07:35:00', 'time_end' => '08:30:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 2,  'time_start' => '08:30:00', 'time_end' => '09:30:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 3,  'time_start' => '09:30:00', 'time_end' => '10:40:00', 'break_start' => '09:30:00', 'break_end' => '09:40:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 4,  'time_start' => '10:40:00', 'time_end' => '11:40:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 5,  'time_start' => '11:40:00', 'time_end' => '13:20:00', 'break_start' => '12:00:00', 'break_end' => '12:40:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 6,  'time_start' => '13:20:00', 'time_end' => '14:20:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 7,  'time_start' => '14:20:00', 'time_end' => '15:30:00', 'break_start' => '15:15:00', 'break_end' => '15:25:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 8,  'time_start' => '15:30:00', 'time_end' => '16:30:00', 'break_start' => '16:25:00', 'break_end' => '16:30:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 9,  'time_start' => '16:30:00', 'time_end' => '17:40:00', 'break_start' => '16:30:00', 'break_end' => '16:40:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 10, 'time_start' => '17:40:00', 'time_end' => '19:00:00']);
        WorkHour::create(['shift_id' => 1, 'hour_number' => 11, 'time_start' => '19:00:00', 'time_end' => '19:55:00']);

        // Shift Malam (Shift ID = 2)
        WorkHour::create(['shift_id' => 2, 'hour_number' => 1,  'time_start' => '20:00:00', 'time_end' => '21:00:00', 'break_start' => '20:00:00', 'break_end' => '20:05:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 2,  'time_start' => '21:00:00', 'time_end' => '22:00:00', 'break_start' => '21:00:00', 'break_end' => '21:05:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 3,  'time_start' => '22:00:00', 'time_end' => '23:00:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 4,  'time_start' => '23:00:00', 'time_end' => '00:30:00', 'break_start' => '23:30:00', 'break_end' => '00:00:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 5,  'time_start' => '00:30:00', 'time_end' => '01:30:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 6,  'time_start' => '01:30:00', 'time_end' => '02:40:00', 'break_start' => '02:00:00', 'break_end' => '02:10:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 7,  'time_start' => '02:40:00', 'time_end' => '03:40:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 8,  'time_start' => '03:40:00', 'time_end' => '05:00:00', 'break_start' => '04:30:00', 'break_end' => '04:50:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 9,  'time_start' => '05:00:00', 'time_end' => '06:00:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 10, 'time_start' => '06:00:00', 'time_end' => '07:00:00', 'break_start' => '06:55:00', 'break_end' => '07:00:00']);
        WorkHour::create(['shift_id' => 2, 'hour_number' => 11, 'time_start' => '07:00:00', 'time_end' => '07:30:00', 'break_start' => '07:25:00', 'break_end' => '07:30:00']);
    }
}
