<?php

namespace App\Domain\Repositories;

interface QuestionRepository
{
    /**
     * Get the daily question.
     * @param string $themeName
     * @return array
     */
    public function getDailyQuestion(string $themeName): array;
}