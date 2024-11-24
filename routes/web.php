<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuizController;
use App\Http\Controllers\ThemeController;

Route::get('/', fn () => view('welcome'))->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(
        function () {
            Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
            Route::get('/dailyquiz', [ThemeController::class, 'showTheme'])->name('theme.show');
            Route::get('/dailyquiz/{theme}', [DailyQuizController::class, 'showQuestion'])->name('dailyquiz.show');
        }
    );
