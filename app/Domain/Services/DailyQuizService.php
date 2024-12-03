<?php

namespace App\Domain\Services;

use App\Domain\Entities\DailyQuiz;
use App\Domain\Interfaces\DailyQuizInterface;
use App\Domain\Entities\Theme;
use App\Domain\Entities\Question;
use App\Domain\Entities\Answer;
use App\Domain\Repositories\QuestionRepository;
use App\Domain\Repositories\ThemeRepository;

class DailyQuizService implements DailyQuizInterface
{
    public function __construct(private readonly QuestionRepository $questionRepository, private readonly ThemeRepository $themeRepository) {}

    /**
     * @inheritDoc
     */
    public function getDailyQuiz(string $themeName): DailyQuiz
    {
        $difficulty = 'moyen';

        $theme = $this->themeRepository->getThemeByName($themeName);
        $dailyQuestion = $this->questionRepository->getDailyQuestion($themeName);
        $questions = [];
        // 5 Questions
        for ($i = 0; $i < 5; $i++) {
            // 4 Answers (one true)
            $fourAnswers = [];
            for ($j = 0; $j < 4; $j++) {
                $fourAnswers[] = new Answer($dailyQuestion[$i]['answers'][$j]['answer'], $dailyQuestion[$i]['answers'][$j]['is_correct'], $dailyQuestion[$i]['answers'][$j]['id']);
            }
            // One question
            $questions[] =  new Question($dailyQuestion[$i]['question'], $difficulty, $fourAnswers);
        }
        $quiz = new DailyQuiz($theme, $questions);
        return $quiz;
    }
}
