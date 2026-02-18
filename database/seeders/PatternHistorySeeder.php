<?php

namespace Database\Seeders;

use App\Models\Pattern;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PatternHistory;

use Carbon\Carbon;

class PatternHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatternHistory::create(['pattern_id' => 1,'created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
    }
}
