<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\LinePerformanceService;
use App\Services\Dashboard\BestRecordService;
use App\Services\Dashboard\CycleTimeService;
use App\Services\Dashboard\MarqueeTextService;
use App\Services\Dashboard\PatternService;
use App\Services\Dashboard\PatternHistoryService;
use App\Services\Dashboard\ProductService;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private LinePerformanceService $linePerformanceService,
        private BestRecordService $bestRecordService,
        private CycleTimeService $cycleTimeService,
        private MarqueeTextService $marqueeTextService,
        private PatternService $patternService,
        private PatternHistoryService $patternHistoryService,
        private ProductService $productService,
    ) {}

    public function index(): View {

        // 1. Best Record
        $bestRecord = $this->bestRecordService->get();

        // 2. Line Performance
        $linePerformanceData = $this->linePerformanceService->get();

        // 3. Cycle Time
        $cycleTimeData = $this->cycleTimeService->get();

        // 3. Products Table
        $products = $this->productService->get();

        // 4. Marquee Text
        $marqueeText = $this->marqueeTextService->get();

        // 5. Pattern
        $patterns = $this->patternService->get();

        $patternId = $this->patternHistoryService->get()?->pattern_id;
        // dd($patterns);

        return view('dashboards.index', [
            'title'            => 'LINE 2', // Sesuaikan judulnya
            'products'         => $products,
            'best_record'      => $bestRecord,
            'cycleTimeData'    => $cycleTimeData,
            'linePerformances' => $linePerformanceData['linePerformances'],
            'labels'           => $linePerformanceData['labels'],
            'actual'           => $linePerformanceData['actual'],
            'minusOee'         => $linePerformanceData['minusOee'],
            'allowedTime'      => $linePerformanceData['allowedTime'],
            'marqueeText'      => $marqueeText,
            'patterns'         => $patterns,
            'patternId'        => $patternId,
        ]);
    }

    public function fetchProductsTable() {

        $products   = $this->productService->get();

        return view('dashboards.partials.product-table', compact('products'));
    }
}