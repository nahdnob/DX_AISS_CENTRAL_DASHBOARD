<?php

namespace App\Services\Dashboard;

use App\Models\MarqueeText;

class MarqueeTextService
{
    public function get(): MarqueeText|null
    {
        return MarqueeText::first();
    }
}