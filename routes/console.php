<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DailyQuiz;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Schedule::command(DailyQuiz::class)
->dailyAt('00:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
    Artisan::call('command:daily-quiz');
});