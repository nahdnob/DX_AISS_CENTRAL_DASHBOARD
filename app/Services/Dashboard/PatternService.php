<?php

namespace App\Services\Dashboard;

use App\Models\Pattern;
use Illuminate\Database\Eloquent\Collection;

class PatternService
{
    public function get(): Collection
    {
        return Pattern::all();
    }
}