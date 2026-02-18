<?php

namespace App\Console\Commands;

use App\Services\Production\ProductOutService;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

class SyncProductOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-product-out';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Product Out data';

    /**
     * Execute the console command.
     */
    public function handle(ProductOutService $service): int {
        
        Log::info('[PRODUCT-OUT][START]', [
            'command' => $this->signature,
            'time'    => now()->toDateTimeString(),
        ]);

        try {
            $processed = $service->sync(); // return jumlah rows

            Log::info('[PRODUCT-OUT][SUCCESS]', [
                'processed' => $processed,
            ]);

            return self::SUCCESS;

        } catch (\Throwable $e) {
            Log::error('[PRODUCT-OUT][ERROR]', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return self::FAILURE;
        }
    }
}
