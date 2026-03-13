<?php

namespace App\Services\Dashboard;

use App\Models\ProductIn;
use App\Models\ProductOut;
use App\Models\Shift;
use App\Models\WorkHour;

use Carbon\Carbon;

use function Symfony\Component\Clock\now;

class ProductService
{
    public function get(){

        $products = ProductIn::select('part_id', 'part_number', 'time_in', 'quantity', 'created_at')
                             ->whereNull('product_out_id')
                             ->where('is_processed', 0)
                             ->orderBy('time_in', 'desc')
                             ->get()
                             ->toArray();

        if (empty($products)) {
            return [];
        }

        $statusApplied = $this->applyStatus($products);

        if (empty($statusApplied)) {
            return [];
        }

        return $this->groupProducts($statusApplied);
    }

    public function sync(){

    }

    private function applyStatus(array $products): array {

        $results = [];
        $count   = 0;

        foreach ($products as $product)
        {
            $next = $count + (int) $product['quantity'];

            $status = match (true) {

                $next <= 100 => 'SUB ASSY',
                $next <= 340 => 'PREHEAT',
                $next <= 580 => 'HARDENING',
                $next <= 660 => 'INSPECTION',
                $next <= 740 => 'PENDING',

                default      => null,
            };

            if (!$status) {
                ProductIn::where('part_id', $product['part_id'])->update(['is_processed' => 1]);
                continue;
            }

            $results[] = [
                'part_number' => $product['part_number'],
                'quantity'    => $product['quantity'],
                'time_in'     => $product['time_in'],
                'status'      => $status,
            ];

            $count = $next;
        }

        return $results;
    }

    private function groupProducts(array $items): array
    {
        $result  = [];
        $current = null;
        $qty     = 0;

        foreach ($items as $item) {

            if ($current === null) {

                $current = $item;
                $qty     = $item['quantity'];
                continue;
            }

            if ($item['part_number'] !== $current['part_number'] || $item['status'] !== $current['status']) {

                $result[] = $this->makeRow($current, $qty);
                $current  = $item;
                $qty      = $item['quantity'];

            } else {
                $qty += $item['quantity'];
            }
        }

        if ($current !== null) {
            $result[] = $this->makeRow($current, $qty);
        }

        return $result;
    }

    private function makeRow(array $item, int $qty): array {

        return [

            'part_number' => $item['part_number'],
            'quantity'    => $qty,
            'time_in'     => $item['time_in'],
            'status'      => $item['status'],
            'estimate'    => $this->estimateTime($item['time_in']),
        ];
    }

    private function estimateTime(string $timeIn): string {

        $shiftId = $this->getShiftId($timeIn);
        $start   = Carbon::parse($timeIn);
        $end     = $start->copy()->addHours(2);

        $workHours = WorkHour::where('shift_id', $shiftId)
                             ->orderBy('hour_number')
                             ->get();

        $breakMinutes = 0;
        $baseDate     = $start->copy()->startOfDay();

        foreach ($workHours as $wh) {

            if (!$wh->break_start) {
                continue;
            }

            $breakStart = $baseDate->copy()->setTimeFromTimeString($wh->break_start);
            $breakEnd   = $baseDate->copy()->setTimeFromTimeString($wh->break_end);

            if ($breakEnd->lessThan($breakStart)) {
                $breakEnd->addDay();
            }

            if ($end > $breakStart && $start < $breakEnd) {
                $breakMinutes += $breakEnd->diffInMinutes($breakStart);
            }
        }

        return $end->addMinutes($breakMinutes)->format('Y-m-d H:i:s');
    }

    private function getShiftId(string $time): ?int {
        
        return Shift::where(function ($query) use ($time) {

            $query->where('time_start', '<=', $time)->where('time_end', '>', $time);

        })->value('id');
    }

    
}