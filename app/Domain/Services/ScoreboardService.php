<?php

namespace App\Domain\Services;

use App\Domain\Interfaces\ScoreboardInterface;
use App\Domain\Repositories\ScoreboardRepository;
use App\Domain\Entities\User;
use App\Domain\Entities\Theme;

class ScoreboardService implements ScoreboardInterface
{
    public function __construct(private readonly ScoreboardRepository $scoreboardRepository) {}

    public function getScores(): array
    {
        return $this->scoreboardRepository->getScores();
    }

    public function addScore(User $user, string $themeName, int $score): void
    {
        $theme = new Theme(0, $themeName);
        $this->scoreboardRepository->addScore($user, $theme, $score);
    }
}