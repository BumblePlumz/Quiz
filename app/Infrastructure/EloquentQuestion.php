<?php

namespace App\Infrastructure;

use App\Domain\Repositories\QuestionRepository;
use Illuminate\Support\Collection;
use App\Models\Question;

class EloquentQuestion implements QuestionRepository
{

    /**
     * @inheritDoc
     */
    public function getDailyQuestion(string $themeName): array
    {
        $dailyQuestions = Question::with('answers')
            ->whereHas('theme', function ($query) use ($themeName) {
                $query->where('name', '=', $themeName);
            })
            ->whereDate('generated_at', now()->toDateString()) // Filter by today's date
            ->get();

        return $dailyQuestions->toArray();
    }
}
