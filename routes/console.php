<?php

use Illuminate\Foundation\Inspiring;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Default Artisan Command
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Dashboard Schedule Commands
Schedule::command('sync:product-in')
        ->everyMinute()
        ->withoutOverlapping()
        ->runInBackground();

Schedule::command('sync:product-out')
        ->everyMinute()
        ->withoutOverlapping()
        ->runInBackground();

Schedule::command('sensor:complete-data')
        ->everyMinute()
        ->withoutOverlapping()
        ->onOneServer()
        ->runInBackground();

Schedule::command('sensor:summary-data')
        ->everyMinute()
        ->withoutOverlapping()
        ->onOneServer()
        ->runInBackground();
