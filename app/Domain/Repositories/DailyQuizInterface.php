<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\DailyQuiz;

interface DailyQuizInterface
{
    public function getDailyQuiz(string $themeName): DailyQuiz;
}