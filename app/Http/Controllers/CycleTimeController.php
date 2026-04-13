<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pattern;
use App\Models\PatternHistory;
use App\Models\SensorHistory;
use App\Models\SensorSummary;
use App\Models\Sensor;
use Carbon\Carbon;

class CycleTimeController extends Controller
{
    public function index()
    {
        // Pattern aktif saat ini (berdasarkan history terakhir)
        $activePatternId = PatternHistory::latest()->value('pattern_id');
        $activePattern   = $activePatternId
            ? Pattern::with('sensors')->find($activePatternId)
            : null;

        // Semua pattern tersedia (untuk selector dropdown)
        $patterns = Pattern::orderBy('name')->get();

        // Semua sensor
        $sensors = Sensor::orderBy('id')->get();

        // Summary Data: Data rata-rata per jam per sensor hari ini
        $today = Carbon::today()->format('Y-m-d');
        $rawSummary = SensorSummary::with('sensor:id,name', 'workHour:id,hour_number,time_start,time_end')
            ->whereDate('created_at', $today)
            ->when($activePatternId, fn($q) => $q->where('pattern_id', $activePatternId))
            ->orderBy('work_hour_id')
            ->orderBy('sensor_id')
            ->get();

        // Real-time: Average cycle time hari ini per sensor (dari pattern aktif)
        $realtimeData = [];
        if ($activePattern) {
            foreach ($activePattern->sensors as $sensor) {
                $sensorSummaries = $rawSummary->where('sensor_id', $sensor->id);
                
                // Filter jika null atau tidak ada tidak masuk hitungan
                $validAvgs = $sensorSummaries->pluck('average')->filter(function($val) {
                    return !is_null($val) && $val > 0;
                });
                
                $overallAverage = $validAvgs->isNotEmpty() ? $validAvgs->avg() : 0;

                $realtimeData[] = [
                    'sensor_id'   => $sensor->id,
                    'sensor_name' => $sensor->name,
                    'duration'    => round($overallAverage, 2),
                    'time'        => Carbon::now()->format('H:i:s'),
                ];
            }
        }

        // Log terbaru: entri SensorHistory terbaru untuk pattern aktif (dengan pagination)
        $recentLogs = SensorHistory::with('sensor:id,name', 'pattern:id,name,cycle_time')
            ->when($activePatternId, fn($q) => $q->where('pattern_id', $activePatternId))
            ->orderBy('time', 'desc')
            ->paginate(5);

        // Scatter data: 100 entri terakhir diurutkan ascending untuk scatter diagram
        $scatterData = SensorHistory::with('sensor:id,name')
            ->when($activePatternId, fn($q) => $q->where('pattern_id', $activePatternId))
            ->orderBy('time', 'asc')
            ->limit(100)
            ->get()
            ->map(fn($h) => [
                'x'      => $h->time ? \Carbon\Carbon::parse($h->time)->format('H:i:s') : null,
                'y'      => (float) $h->duration,
                'status' => $h->status,
                'sensor' => $h->sensor?->name,
            ]);

        $sensorNames = $sensors->pluck('name', 'id');
        $summaryData = $rawSummary->groupBy('sensor_id')->map(function ($rows) use ($sensorNames) {
            $sensorId   = $rows->first()->sensor_id;
            $sensorName = $sensorNames[$sensorId] ?? 'Unknown';

            $jamData = [];
            foreach ($rows as $row) {
                // Gunakan jam_ke dari relasi workHour jika ada, kalau tidak gunakan work_hour_id
                $jamIndex = $row->workHour ? $row->workHour->hour_number : $row->work_hour_id;
                $jamData[$jamIndex] = [
                    'max' => round($row->maximal, 2),
                    'avg' => round($row->average, 2),
                    'min' => round($row->minimal, 2),
                ];
            }

            return [
                'sensor_name' => $sensorName,
                'jam'         => $jamData,
            ];
        })->values();

        return view('cycletimes.monitoring.index', compact(
            'activePattern',
            'patterns',
            'sensors',
            'realtimeData',
            'recentLogs',
            'scatterData',
            'summaryData',
        ));
    }
}
