<?php

namespace App\Services\Dashboard;

use App\Models\LinePerformance;

class LinePerformanceService
{
    public function get(): array
    {
        $linePerformances = LinePerformance::orderBy('year', 'desc')
                                           ->orderByRaw("FIELD(month,'January','February','March','April','May','June','July','August','September','October','November','December') DESC")
                                           ->take(3)
                                           ->get()
                                           ->reverse()
                                           ->values();

        $labels = $linePerformances->map(function ($item) {
            return substr($item->month, 0, 3) . ' ' . substr($item->year, -2);
        });

        $actual = $linePerformances->pluck('actual');
        $target = $linePerformances->pluck('target');

        $minusOee = $target->map(function ($t, $i) use ($actual) {
            return max($t - $actual[$i], 0);
        });

        $allowedTime = $actual->map(function ($a, $i) use ($minusOee) {
            return max(100 - ($a + $minusOee[$i]), 0);
        });

        return [
            'linePerformances' => $linePerformances,
            'labels'           => $labels,
            'actual'           => $actual,
            'target'           => $target,
            'minusOee'         => $minusOee,
            'allowedTime'      => $allowedTime,
        ];
    }
}