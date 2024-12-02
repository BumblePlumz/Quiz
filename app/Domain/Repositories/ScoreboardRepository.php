<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use App\Domain\Entities\Theme;

interface ScoreboardRepository
{
    public function getScores(): array;
    public function addScore(User $user, Theme $theme, int $score): void;
}