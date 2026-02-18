<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Pattern;
use App\Models\PatternHistory;
use App\Models\SensorHistory;
use App\Models\SensorSummary;
use App\Models\WorkHour;

use Carbon\Carbon;

class SensorController extends Controller
{
    private function today(){

        // Today
        $result = now()->format('Y-m-d');

        return $result;
    }

    private function thisTime(){

        // Now
        $result = now()->format('H:i:s');

        return $result;
    }

    private function currentShift($thisTime){

        $result = WorkHour::whereTime('start_time', '<=', $thisTime)
                          ->whereTime('end_time', '>=', $thisTime)
                          ->value('shift_id');

        return $result;
    }

    private function currentPattern(){

        $result = PatternHistory::latest()->value('pattern_id');

        return $result;
    }

    private function currentWorkHour($thisTime){

        $result = WorkHour::whereTime('start_time', '<=', $thisTime)
                          ->whereTime('end_time', '>=', $thisTime)
                          ->value('id');

        return $result;
    }

    public function index(){

        $patterns = Pattern::with('sensors:id,name')->get();
        $sensors  = Sensor::all();
 
        return view('patterns.index', [
            'patterns' => $patterns,
            'sensors'  => $sensors
        ]);
    }

    public function summary(){

        // Cek tanggal hari ini
        $date = $this->today();

        // Cek jam saat ini
        $now = $this->thisTime();
        
        // Cek shift yang berjalan
        $shift = $this->currentShift($now);

        // Cek work hours yang berjalan
        $workHour = $this->currentWorkHour($now);

        // Cek pattern yang berjalan
        $pattern = $this->currentPattern();
        
        $first = WorkHour::where('shift_id', $shift)->orderBy('id', 'asc')->first();
        $last  = WorkHour::where('shift_id', $shift)->orderBy('id', 'desc')->first();

        $hour = [
            'first_id'   => $first->id,
            'first_start'=> $first->start_time,
            'first_end'  => $first->end_time,
            'last_id'    => $last->id,
            'last_start' => $last->start_time,
            'last_end'   => $last->end_time,
        ];

        
        $sensors = Pattern::find($pattern)->sensors;
        
        foreach ($sensors as $sensor) {
            
            $summary = SensorSummary::select('id','work_hour_id', 'pattern_id', 'sensor_id', 'average', 'maximal', 'minimal')
                                    ->whereBetween('created_at', [$date . ' ' . $hour['first_start'], $date . ' ' . $hour['last_end']])
                                    ->where('work_hour_id', $workHour)
                                    ->where('pattern_id', $pattern)
                                    ->where('sensor_id', $sensor->id)->first();

            if (!$summary) {
                
                SensorSummary::create(
                    [
                        'work_hour_id' => $workHour,
                        'pattern_id'   => $pattern,
                        'sensor_id'    => $sensor->id,
                        'average'      => null,
                        'maximal'      => null,
                        'minimal'      => null
                    ]
                );
            } else {

                $summaryId = $summary->id;

                $datas = SensorHistory::whereBetween('time', [$date . ' ' . $hour['first_start'], $date . ' ' . $hour['last_end']])
                                      ->where('sensor_summary_id', $summaryId)
                                      ->pluck('duration');
                
                $dataAvg = $datas->avg();
                $dataMax = $datas->max();
                $dataMin = $datas->min();
                
                $summary->update([
                    'average'      => $dataAvg,
                    'maximal'      => $dataMax,
                    'minimal'      => $dataMin
                ]);
            }
        }
    }

    public function showSum(){

        $date = $this->today();

        $now = $this->thisTime();

        $shift = $this->currentShift($now);

        $pattern = $this->currentPattern();

        $first = WorkHour::where('shift_id', $shift)->orderBy('id', 'asc')->first();
        $last  = WorkHour::where('shift_id', $shift)->orderBy('id', 'desc')->first();

        $hour = [
            'first_id'   => $first->id,
            'first_start'=> $first->start_time,
            'first_end'  => $first->end_time,
            'last_id'    => $last->id,
            'last_start' => $last->start_time,
            'last_end'   => $last->end_time,
        ];

        $workHours = WorkHour::where('shift_id', $shift)
                            ->orderBy('hour_number')
                            ->get();

        $result = [];

        foreach ($workHours as $workHour) {

            $summaries = SensorSummary::select('work_hour_id','pattern_id','sensor_id','average','maximal','minimal')
                                    ->with('sensor:id,name')
                                    ->whereBetween('created_at', [$date . ' ' . $hour['first_start'], $date . ' ' . $hour['last_end']])
                                    ->where('work_hour_id', $workHour->id)
                                    ->where('pattern_id', $pattern)
                                    ->whereNotNull('average') 
                                    ->get();

            if ($summaries->isNotEmpty()) {

                $result[] = [

                    'index' => $workHour->hour_number,
                    'start' => $workHour->start_time,
                    'end'   => $workHour->end_time,
                    'data'  => $summaries->map(function ($s) {

                        return [

                            'sensor_id' => $s->sensor->id,
                            'name'      => $s->sensor->name,
                            'avg'       => $s->average,
                            'min'       => $s->minimal,
                            'max'       => $s->maximal,
                        ];
                    }),
                ];
            }
        }

        return $result;
    }

    public function historyPos(){
        // Get data
        $data = SensorHistory::select('id','pattern_id','sensor_id','time','duration')
                             ->with(['pattern:id,name,tact_time'])
                             ->orderBy('time','desc')
                             ->paginate(10);
        return $data;
    }

    private function setPatternId(): ?int {
        $patterns        = Pattern::all();
        $latestPattern   = PatternHistory::latest()->first();
        $latestPatternId = $latestPattern ? $latestPattern->pattern_id : $patterns->first()?->id;

        if (!$latestPatternId) {return null;}

        $sensors = Sensor::all();

        foreach ($sensors as $sensor) {
            $datas = $sensor->histories()->whereNull('pattern_id')->orderBy('time')->get();

            foreach ($datas as $data) {
                $data->pattern_id = $latestPatternId;
                $data->save();
            }
        }

        return $latestPatternId;
    }

    public function getChartData(){
        // 1. Set Pattern
        $patternId = $this->setPatternId();

        if (!$patternId) {
        return response()->json(['error' => 'No pattern found.'], 400);
        }

        // Get Tact Time
        $selectedPattern = Pattern::find($patternId);
        $tactTime = $selectedPattern->tact_time ?? 0;
        $ucl = $tactTime + 100;
        $lcl = $tactTime - 100;

        $sensors     = Sensor::all();
        $labels      = [];
        $durations   = [];
        $maxDuration = 0;

        foreach ($sensors as $sensor) {
            $data = $sensor->histories()
                ->where('pattern_id', $patternId)
                ->orderBy('time')
                ->get();

            $durationsData = $this->calculateDurations($data, $patternId);

            $lastValid = null; 
            foreach ($durationsData as $duration) {
                if ($duration > $lcl && $duration < $ucl) {
                    $lastValid = $duration;
                }
            }

            if ($lastValid !== null) {
                $labels[] = $sensor->name;
                $durations[] = $lastValid;
                $maxDuration = max($maxDuration, $lastValid);
            }
        }

        return response()->json([
            'labels'        => $labels,
            'durations'     => $durations,
            'tactTime'      => $tactTime,
            'upperTactTime' => $maxDuration + 5
        ]);
    }

    public function show($sensor)
    {
        // 1. Get Today
        $date = $this->today();

        $now = $this->thisTime();

        $shift = $this->currentShift($now);

        // 3. Get work hours
        $workHours = WorkHour::where('shift_id', $shift)
                             ->orderBy('hour_number')
                             ->get();

        // 4. Get work hours - start & end
        $firstHour = $workHours->first();
        $lastHour  = $workHours->last();
        
        $pattern = $this->currentPattern();

        $summary = $this->summary();

        $showSum = $this->showSum();

        // dd($showSum);
        
        // 5. Buat rentang waktu full (tanggal + jam)
        $todayDate     = Carbon::today()->toDateString();
        $startDateTime = Carbon::parse("$todayDate {$firstHour->start_time}");
        $endDateTime   = Carbon::parse("$todayDate {$lastHour->end_time}");
        
        // Tangani shift malam (lewat tengah malam)
        if ($firstHour->start_time > $lastHour->end_time) {
            $endDateTime->addDay();
        }

        // 6. Ambil model sensor
        $sensorModel = Sensor::whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower($sensor)])
                            ->firstOrFail();
        
                            
                            // 7. Ambil Pattern aktif
        $patternId = PatternHistory::latest()->first()->pattern_id ?? 1;
        $tactTime  = Pattern::find($patternId)?->tact_time ?? 0;

        // 8. Hitung batas atas & bawah durasi
        $ucl = $tactTime + 10;
        $lcl = $tactTime - 10;

        // 9. Ambil data untuk tabel (paginate)
        $data = $sensorModel->histories()
            ->with('pattern')
            ->whereBetween('time', [$startDateTime, $endDateTime])
            ->orderBy('time', 'desc')
            ->paginate(10);

        // 10. Ambil semua data history dalam rentang waktu, untuk chart
        $allData = $sensorModel->histories()
            ->whereBetween('time', [$startDateTime, $endDateTime])
            ->where('duration', '>=', $tactTime-100)
            ->where('duration', '<=', $tactTime+100)
            ->orderBy('time')
            ->get();

        $labels = [];
        $scatterData = [];

        foreach ($workHours as $index => $workHour) {
            $label = $workHour->start_time . ' - ' . $workHour->end_time;
            $labels[$index] = $label;

            $rangeData = $allData->filter(function ($item) use ($workHour) {
                $itemTime = Carbon::parse($item->time)->format('H:i:s');
                return $itemTime >= $workHour->start_time && $itemTime <= $workHour->end_time;
            });

            $rangeData = collect($rangeData)->reverse()->values();

            $count = 0;
            foreach ($rangeData as $item) {
                // Tambahkan jitter kecil di posisi X (misal: +0.1, +0.2, dst)
                $scatterData[] = [
                    'x' => $index + (rand(1, 10) / 100), // X jadi angka dengan jitter
                    'y' => $item->duration,
                    'time' => Carbon::parse($item->time)->format('H:i:s'),
                    'labelIndex' => $index
                ];
                $count++;
            }
        }

        // 12. Kirim data ke view
        return view('sensors.show', [
            'sensor'      => strtoupper($sensorModel->name),
            'data'        => $data,
            'labels'      => $labels,
            'tactTime'    => $tactTime,
            'ucl'         => $ucl,
            'lcl'         => $lcl,
            'scatterData' => $scatterData,
            'showSum'     => $showSum
        ]);
    }

    private function calculateDurations($data, $patternId){
        $durations = [];

        for ($i = 1; $i < $data->count(); $i++) {
            $prevTime = strtotime($data[$i - 1]->time);
            $currentTime = strtotime($data[$i]->time);
            $seconds = $currentTime - $prevTime;

            $durations[] = $seconds;

            $data[$i]->pattern_id = $patternId;
            $data[$i]->duration = $seconds;
            $data[$i]->save();
        }

        return $durations;
    }
}