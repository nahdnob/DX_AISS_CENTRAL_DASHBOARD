<?php

namespace App\Services\Production;

use App\Models\ProductIn;
use App\Models\ProductOut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FifoService
{
    public function process(ProductOut $productOut): bool {

        return DB::transaction(function () use ($productOut) {

            $productIns = ProductIn::where('part_number', $productOut->part_number)
                                   ->whereNull('product_out_id')
                                   ->where('is_processed', 0)
                                   ->orderBy('time_in')
                                   ->lockForUpdate()
                                   ->get();

            $needed   = $productOut->quantity;
            $used     = 0;
            $usedRows = collect();

            foreach ($productIns as $pi) {

                if ($used >= $needed) {
                    break;
                }

                $used += $pi->quantity;
                $usedRows->push($pi);
            }

            // stok tidak cukup → JANGAN PROSES
            if ($used < $needed) {
                
                Log::warning('FIFO gagal: stok tidak cukup', [
                    'product_out_id' => $productOut->id,
                    'needed'         => $needed,
                    'available'      => $used,
                ]);

                return false;
            }

            foreach ($usedRows as $pi) {
                
                $pi->update([
                    'product_out_id' => $productOut->id,
                    'is_processed'   => 1,
                ]);
            }

            return true;
        });
    }
}
