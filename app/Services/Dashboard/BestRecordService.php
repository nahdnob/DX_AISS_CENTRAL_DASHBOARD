<?php

namespace App\Services\Dashboard;

use Carbon\Carbon;

use App\Models\Ncd;

class BestRecordService
{
    public function get(): array
    {
        $dates   = Ncd::pluck('date');
        $lastDay = Ncd::orderBy('date', 'desc')->value('date');

        $lastDay = Carbon::parse($lastDay);
        $today   = Carbon::now();

        // ⬇️ Hitung SELISIH HARI KERJA (Senin–Jumat)
        $daysDifference = $lastDay->diffInWeekdays($today);

        return [
            'dates'     => $dates,
            'last_day'  => $lastDay,
            'day_count' => (int) $daysDifference,
        ];
    }
}