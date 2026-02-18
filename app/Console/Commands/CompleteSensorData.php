<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Services\Sensor\CompletingDataService;

class CompleteSensorData extends Command
{
    /**
     * Nama command
     */
    protected $signature = 'sensor:complete-data';

    /**
     * Deskripsi
     */
    protected $description = 'Complete sensor history data automatically';

    public function __construct(
        private CompletingDataService $service,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        Log::info('[COMMAND][SENSOR][START] complete-data');

        try {

            $this->service->run();

            $this->info('Sensor data completed successfully.');
            Log::info('[COMMAND][SENSOR][SUCCESS] complete-data');

            return Command::SUCCESS;

        } catch (\Throwable $e) {

            Log::error('[COMMAND][SENSOR][FAILED]', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $this->error('Failed to complete sensor data.');

            return Command::FAILURE;
        }
    }
}
