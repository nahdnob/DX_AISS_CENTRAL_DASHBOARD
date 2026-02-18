<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Services\Sensor\SensorSummaryService;

class SummarySensorData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sensor:summary-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Summarize sensor data automatically';

    public function __construct(
        private SensorSummaryService $service
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('[COMMAND][SENSOR][START] summary-data');

        try {

            $this->service->run();

            $this->info('Sensor data summarized successfully.');
            Log::info('[COMMAND][SENSOR][SUCCESS] summary-data');

            return Command::SUCCESS;

        } catch (\Throwable $e) {

            Log::error('[COMMAND][SENSOR][FAILED]', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $this->error('Failed to summarize sensor data.');

            return Command::FAILURE;
        }
    }
}
