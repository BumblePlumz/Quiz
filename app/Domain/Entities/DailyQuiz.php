<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Theme;

class DailyQuiz 
{
    private int $id;
    public function __construct(private readonly Theme $theme, private readonly array $questions, $id = 0) 
    {
        $this->id = $id;
    }

    /**
     * Get the id.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the theme of the question
     * 
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * Get the questions.
     * 
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * Get the question.
     * 
     * @param int $index
     * @return Question
     */
    public function getQuestion(int $index): Question
    {
        return $this->questions[$index];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'theme' => $this->theme->toArray(),
            'questions' => array_map(fn($question) => $question->toArray(), $this->questions)
        ];
    }
}