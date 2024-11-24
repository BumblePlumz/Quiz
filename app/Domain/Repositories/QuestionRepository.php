<?php

namespace App\Domain\Repositories;

interface QuestionRepository
{
    public function getDailyQuestion(string $themeName): array;
}