<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\DailyQuiz;

interface DailyQuizInterface
{
    public function getDailyQuiz(string $themeName): DailyQuiz;
}