<?php

namespace App\Services\Sensor;

use App\Models\Pattern;
use App\Models\SensorHistory;
use App\Models\SensorSummary;

use App\Services\Sensor\SensorContextService;
use App\Services\Sensor\SensorLimitService;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class CompletingDataService
{
    public function __construct(
        private SensorContextService $context,
        private SensorLimitService $limit
    ) {}

    public function run(): void
    {
        $now  = now();
        $time = $now->format('H:i:s');
        $date = production_date($now);

        $shift     = $this->context->currentShift($time);
        $workHour  = $this->context->currentWorkHour($time);
        $patternId = $this->context->currentPattern();

        if (!$shift || !$workHour || !$patternId) {
            Log::warning('[SENSOR][SKIP_CONTEXT]', compact('shift','workHour','patternId'));
            return;
        }

        $limit = $this->limit->get($patternId);
        $hour  = $this->context->shiftBoundary($shift);

        $sensors = Pattern::findOrFail($patternId)->sensors;

        foreach ($sensors as $sensor) {

            // 1️⃣ Sensor Summary
            $summaryId = SensorSummary::whereBetween(
                    'created_at',
                    [$date.' '.$hour['first_start'], $date.' '.$hour['last_end']]
                )
                ->where([
                    'work_hour_id' => $workHour,
                    'pattern_id'   => $patternId,
                    'sensor_id'    => $sensor->id,
                ])
                ->value('id');

            // 2️⃣ Ambil data belum diproses
            $histories = SensorHistory::where('sensor_id', $sensor->id)
                                      ->whereBetween('time', [
                                          $date.' '.$hour['first_start'],
                                          $date.' '.$hour['last_end'],
                                      ])
                                      ->orderBy('time', 'asc')
                                      ->get();

            if ($histories->count() < 2) {
                continue;
            }

            // 3️⃣ Hitung durasi per record
            for ($i = 1; $i < $histories->count(); $i++) {

                // SKIP jika sudah dihitung
                if (!is_null($histories[$i]->duration)) {
                    continue;
                }

                $prev = Carbon::parse($histories[$i - 1]->time);
                $curr = Carbon::parse($histories[$i]->time);

                $diff = $prev->diffInSeconds($curr);

                // Proteksi gap
                if ($diff > ($limit['ucl'] * 3)) {
                    continue;
                }

                $duration = in_array($sensor->id, [1, 5])
                    ? intdiv($diff, 2)
                    : $diff;

                $status = ($duration < $limit['lcl'] || $duration > $limit['ucl']) ? 0 : 1;

                $histories[$i]->update([
                    'sensor_summary_id' => $summaryId,
                    'pattern_id'        => $patternId,
                    'duration'          => $duration,
                    'status'            => $status,
                ]);

                Log::info('[SENSOR][UPDATED]', [
                    'sensor_id'  => $sensor->id,
                    'history_id' => $histories[$i]->id,
                    'duration'   => $duration,
                    'status'     => $status,
                ]);
            }
        }
    }
}
