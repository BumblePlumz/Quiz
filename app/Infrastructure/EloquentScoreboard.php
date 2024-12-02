<?php

namespace App\Infrastructure;

use App\Domain\Repositories\ScoreboardRepository;
use App\Domain\Entities\User as UserEntity;
use App\Domain\Entities\Theme as ThemeEntity;
use App\Models\User;
use App\Models\Theme;
use App\Models\Scoreboard;

class EloquentScoreboard implements ScoreboardRepository
{
    public function getScores(): array
    {
        return Scoreboard::all()->map(function ($scoreboard) {
            return $scoreboard->toDomainEntity();
        })->toArray();
    }

    public function addScore(UserEntity $userEntity, ThemeEntity $themeEntity, int $score): void
    {
        $user = User::find($userEntity->getId());
        if (!$user) throw new \Exception('User not found');

        $theme = Theme::where('name', $themeEntity->getName())->first();
        if (!$theme) throw new \Exception('Theme not found');

        $scoreboard = new Scoreboard();
        $scoreboard->user_id = $user->id;
        $scoreboard->theme_id = $theme->id;
        $scoreboard->score = $score;
        $scoreboard->save();
    }
}