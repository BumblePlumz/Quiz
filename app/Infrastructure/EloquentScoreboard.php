<?php

namespace App\Infrastructure;

use App\Domain\Repositories\ScoreboardRepository;
use App\Domain\Entities\Scoreboard as ScoreboardEntity;
use App\Models\User;
use App\Models\Theme;
use App\Models\Scoreboard;

class EloquentScoreboard implements ScoreboardRepository
{
    /**
     * @inheritDoc
     */
    public function getScores(int $userID): array
    {
        return Scoreboard::where('user_id', $userID)
            ->get()
            ->map(function ($scoreboard) {
                return $scoreboard->toDomainEntity();
            })
            ->toArray();
    }


    /**
     * @inheritDoc
     */
    public function addScore(ScoreboardEntity $scoreboardEntity): void
    {
        $user = User::find($scoreboardEntity->getUser()->getId());
        if (!$user) throw new \Exception('User not found');

        $theme = Theme::where('name', $scoreboardEntity->getTheme()->getName())->first();
        if (!$theme) throw new \Exception('Theme not found');

        $scoreboard = new Scoreboard();
        $scoreboard->user_id = $user->id;
        $scoreboard->theme_id = $theme->id;
        $scoreboard->game_mode = $scoreboardEntity->getGameMode();
        $scoreboard->score = $scoreboardEntity->getScore();
        $scoreboard->save();
    }
}
