<?php

namespace App\Services\Context;

use App\Models\PatternHistory;

class PatternContext
{
    public function current(): ?int {
        
        return PatternHistory::latest()->value('pattern_id');
    }
}
