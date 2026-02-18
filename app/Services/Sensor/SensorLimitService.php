<?php

namespace App\Services\Sensor;

use App\Models\Pattern;

class SensorLimitService
{
    public function get(int $patternId): array
    {
        $pattern = Pattern::findOrFail($patternId);

        return [
            'ucl' => $pattern->max_time,
            'lcl' => $pattern->min_time,
        ];
    }
}