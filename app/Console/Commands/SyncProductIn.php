<?php

namespace App\Console\Commands;

use App\Services\Production\ProductInService;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

class SyncProductIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-product-in';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Product In data';

    /**
     * Execute the console command.
     */
    public function handle(ProductInService $service): int {

        Log::info('[PRODUCT-IN][START]', [
            
            'command' => $this->signature,
            'time'    => now()->toDateTimeString(),
        ]);

        try {
            $result = $service->sync(); // optional: return count

            Log::info('[PRODUCT-IN][SUCCESS]', [
                'processed' => $result,
            ]);

            return self::SUCCESS;

        } catch (\Throwable $e) {

            Log::error('[PRODUCT-IN][ERROR]', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return self::FAILURE;
        }
    }
}
