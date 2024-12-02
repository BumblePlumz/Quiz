<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Scoreboard;

interface ScoreboardRepository
{
    public function getScores(): array;
    public function addScore(Scoreboard $scoreboard): void;
}