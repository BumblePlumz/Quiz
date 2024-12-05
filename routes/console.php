<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DailyQuiz;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Schedule::call(function () {
    Artisan::call('command:daily-quiz', [
        'argument1' => 'PHP',
        'argument2' => 'medium',
    ]);
})
->dailyAt('02:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
});

Schedule::call(function () {
    Artisan::call('command:daily-quiz', [
        'argument1' => 'javascript',
        'argument2' => 'medium',
    ]);
})
->dailyAt('02:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
});

Schedule::call(function () {
    Artisan::call('command:daily-quiz', [
        'argument1' => 'python',
        'argument2' => 'medium',
    ]);
})
->dailyAt('02:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
});

Schedule::call(function () {
    Artisan::call('command:daily-quiz', [
        'argument1' => 'java',
        'argument2' => 'medium',
    ]);
})
->dailyAt('02:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
});

Schedule::call(function () {
    Artisan::call('command:daily-quiz', [
        'argument1' => 'c#',
        'argument2' => 'medium',
    ]);
})
->dailyAt('02:00')
->timezone('Europe/London')
->onFailure(function () {
    Log::scheduler('Daily Quiz Command Failed');
});

