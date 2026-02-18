<?php

namespace App\Services\Dashboard;

use App\Models\Sensor;
use App\Models\SensorSummary;
use App\Models\Pattern;

use App\Services\Sensor\SensorContextService;

class CycleTimeService
{
    public function __construct(
        private SensorContextService $context
    ) {}

    public function get(){
        $sensors = Sensor::select('id','name')->get();
        $date    = production_date(now());
        $hour    = $this->context->shiftBoundary($this->context->currentShift(now()->format('H:i:s')));
        $maxY    = Pattern::where('id', $this->context->currentPattern())->value('max_time');
    
        foreach ($sensors as $sensor) {
            
            $sensorQuery = SensorSummary::whereBetween('created_at', [$date . ' ' . $hour['first_start'], $date . ' ' . $hour['last_end']])
                                        ->where('sensor_id', $sensor->id);
            if ($sensorQuery->exists()) {
                $name[]    = strtoupper($sensor->name);
                $average[] = $sensorQuery->avg('average');
                $max[]     = $sensorQuery->max('maximal');
                $min[]     = $sensorQuery->min('minimal');
            }
        }
        
        $results = [
            'sensor'  => $name    ?? [],
            'average' => $average ?? [],
            'max'     => $max     ?? [],
            'min'     => $min     ?? [],
            'maxY'    => $maxY    ?? 100
        ];
        
        return $results;
    }
}