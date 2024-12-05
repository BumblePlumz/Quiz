<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Scoreboard;

interface ScoreboardRepository
{
    /**
     * Get the scores.
     * @return array
     */
    public function getScores(int $userID): array;

    /**
     * Add a score.
     * @param Scoreboard $scoreboard
     * @return void
     */
    public function addScore(Scoreboard $scoreboard): void;
}