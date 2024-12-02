<?php

namespace App\Infrastructure;

use App\Domain\Repositories\QuestionRepository;
use Illuminate\Support\Collection;
use App\Models\Question;

class EloquentQuestion implements QuestionRepository
{
    /**
     * Get the daily question for a specific theme.
     *
     * @param string $themeName
     * @return Collection
     */
    public function getDailyQuestion(string $themeName): array
    {
        $dailyQuestions = Question::with('answers') // Load the related answers
            ->whereHas('theme', function ($query) use ($themeName) {
                $query->where('name', '=', $themeName);
            })
            ->whereDate('generated_at', now()->toDateString()) // Filter by today's date
            ->get();

        return $dailyQuestions->toArray();
    }
}
