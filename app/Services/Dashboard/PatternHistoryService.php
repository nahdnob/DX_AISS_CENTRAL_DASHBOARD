<?php

namespace App\Services\Dashboard;

use App\Models\PatternHistory;

class PatternHistoryService
{
    public function get(): PatternHistory|null
    {
        return PatternHistory::latest()->first();
    }
}