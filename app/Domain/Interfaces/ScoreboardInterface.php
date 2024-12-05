<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\User;
use App\Domain\Entities\Theme;

interface ScoreboardInterface
{
    /**
     * Get the scores.
     * @return array
     */
    public function getScores(int $userID): array;

    /**
     * Add a score.
     * @param User $user
     * @param Theme $theme
     * @param string $gameMode
     * @param int $score
     * @return void
     */
    public function addScore(User $user, string $themeName, string $gameMode, int $score): void;
}