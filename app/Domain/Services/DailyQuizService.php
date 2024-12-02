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
     * Function to get the five daily quizzes
     * @param string $themeName
     * @return DailyQuiz
     */
    public function getDailyQuiz(string $themeName): DailyQuiz
    {
        // TODO: Gérer la difficulté
        $difficulty = 'facile';

        // Récupérer le theme de la bd
        $theme = $this->themeRepository->getThemeByName($themeName);

        // Récupérer les questions de la bd
        $dailyQuestion = $this->questionRepository->getDailyQuestion($themeName);

        // Initialiser un tableau pour les questions pour l'objet DailyQuiz
        $questions = [];

        // Générer les objets de domaine
        // 5 Questions
        for ($i = 0; $i < 5; $i++) {
            // 4 Réponses (dont une correcte)
            $fourAnswers = [];
            for ($j = 0; $j < 4; $j++) {
                $fourAnswers[] = new Answer($dailyQuestion[$i]['answers'][$j]['answer'], $dailyQuestion[$i]['answers'][$j]['is_correct'], $dailyQuestion[$i]['answers'][$j]['id']);
            }
            // Une Question
            $questions[] =  new Question($dailyQuestion[$i]['question'], $difficulty, $fourAnswers);
        }
        // if (count($questions) < 5) {
        //     throw new \Exception('Not enough questions for the daily quiz');
        // }
        // if (count($questions) > 5) {
        //     $questions = array_slice($questions, 0, 5);
        // }

        // Le quiz
        $quiz = new DailyQuiz($theme, $questions);

        // Renvoyer une réponse au controller
        return $quiz;
    }
}
