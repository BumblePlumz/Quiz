<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Interfaces\DailyQuizInterface;
use App\Domain\Services\DailyQuizService;
use App\Domain\Interfaces\ShowThemeInterface;
use App\Domain\Services\ThemeService;
use App\Domain\Repositories\QuestionRepository;
use App\Infrastructure\EloquentQuestion;
use App\Domain\Repositories\ThemeRepository;
use App\Infrastructure\EloquentTheme;
use App\Domain\Interfaces\ScoreboardInterface;
use App\Domain\Services\ScoreboardService;
use App\Domain\Repositories\ScoreboardRepository;
use App\Infrastructure\EloquentScoreboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Domain
        $this->app->bind(DailyQuizInterface::class, DailyQuizService::class);
        $this->app->bind(ShowThemeInterface::class, ThemeService::class);
        $this->app->bind(ScoreboardInterface::class, ScoreboardService::class);

        // Infrastructure
        $this->app->bind(QuestionRepository::class, EloquentQuestion::class);
        $this->app->bind(ThemeRepository::class, EloquentTheme::class);
        $this->app->bind(ScoreboardRepository::class, EloquentScoreboard::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
