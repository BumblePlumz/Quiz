<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\User;
use App\Domain\Entities\Theme;

interface ScoreboardInterface
{
    public function getScores(): array;
    public function addScore(User $user, string $themeName, int $score): void;
}