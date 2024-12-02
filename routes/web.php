<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuizController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ScoreboardController;

Route::get('/', fn() => view('welcome'))->name('welcome')
    ->withoutMiddleware(['role']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(
        function () {
            Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
            Route::get('/dailyquiz', [ThemeController::class, 'showTheme'])->name('theme.show');
            Route::get('/dailyquiz/{theme}', [DailyQuizController::class, 'showQuestion'])->name('dailyquiz.show');
            Route::get('/scoreboard', [ScoreboardController::class, 'show'])->name('scoreboard.show');
            Route::get('/scoreboard/store', [ScoreboardController::class, 'store'])->name('scoreboard.store');
        }
    )->withoutMiddleware(['role']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        // Define sub-routes under /admin
        Route::post('/dashboard', [DailyQuizController::class, 'storeAnswer'])->name('admin.dashboard.store');
        // Add more admin-related routes here
    });
