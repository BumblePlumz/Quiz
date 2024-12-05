<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\DailyQuiz;

interface DailyQuizInterface
{
    /**
     * Get the daily quiz.
     * 
     * @param string $themeName
     * @return DailyQuiz
     */
    public function getDailyQuiz(string $themeName): DailyQuiz;
}