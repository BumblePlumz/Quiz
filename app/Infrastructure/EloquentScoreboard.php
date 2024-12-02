<?php

namespace App\Infrastructure;

use App\Domain\Repositories\ScoreboardRepository;
use App\Domain\Entities\Scoreboard as ScoreboardEntity;
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

    public function addScore(ScoreboardEntity $scoreboard): void
    {
        $user = User::find($scoreboard->getUser()->getId());
        if (!$user) throw new \Exception('User not found');

        $theme = Theme::where('name', $scoreboard->getTheme()->getName())->first();
        if (!$theme) throw new \Exception('Theme not found');

        $scoreboard = new Scoreboard();
        $scoreboard->user_id = $user->id;
        $scoreboard->theme_id = $theme->id;
        $scoreboard->game_mode = $scoreboard->getGameMode();
        $scoreboard->score = $scoreboard->getScore();
        $scoreboard->save();
    }
}