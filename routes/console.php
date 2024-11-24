<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DailyQuiz;
use Illuminate\Support\Facades\Artisan;

Schedule::command(DailyQuiz::class)
->dailyAt('00:00')
->timezone('Europe/London')
->onFailure(function () {
    Artisan::call('command:daily-quiz');
});