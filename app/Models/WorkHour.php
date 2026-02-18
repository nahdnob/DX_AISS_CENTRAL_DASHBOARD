<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour_number',
        'time_start',
        'time_end',
        'break_start',
        'break_end',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // Relation to Sensor Summaries - One to Many
    public function sensorSummaries(){
        return $this->hasMany(SensorSummary::class);
    }
}
