<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Domain
        $this->app->bind(
            \App\Domain\Repositories\DailyQuizInterface::class,
            \App\Domain\Services\DailyQuizService::class
        );
        $this->app->bind(
            \App\Domain\Repositories\ShowThemeInterface::class,
            \App\Domain\Services\ThemeService::class
        );

        // Infrastructure
        $this->app->bind(
            \App\Domain\Repositories\QuestionRepository::class,
            \App\Infrastructure\MockQuestion::class
            // \App\Infrastructure\EloquentQuestion::class
        );
        $this->app->bind(
            \App\Domain\Repositories\ThemeRepository::class,
            \App\Infrastructure\MockTheme::class
            // \App\Infrastructure\EloquentTheme::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
