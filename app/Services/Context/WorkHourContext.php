<?php

namespace App\Services\Context;

use App\Models\WorkHour;
use Carbon\Carbon;

class WorkHourContext
{
    public function get(Carbon $time): ?int {

        return WorkHour::whereTime('start_time', '<=', $time->format('H:i:s'))
                       ->whereTime('end_time', '>=', $time->format('H:i:s'))
                       ->value('id');
    }
}
