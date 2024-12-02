<?php

namespace App\Livewire;

use Livewire\Component;
use App\Domain\Interfaces\DailyQuizInterface;

class ShowQuestion extends Component
{
    private readonly DailyQuizInterface $dailyQuizInterface;
    public array $dailyQuiz;
    public array $questions = [];
    public int $index = 0;
    public $userAnswer = null;
    public int $score = 0;

    public function mount(DailyQuizInterface $dailyQuizInterface, $theme)
    {
        $this->dailyQuizInterface = $dailyQuizInterface;
        $this->dailyQuiz = $this->dailyQuizInterface->getDailyQuiz($theme)->toArray();
        $this->questions = $this->dailyQuiz['questions'];
    }

    public function submitAnswer()
    {
        // FIXME: décommenter
        // $this->validate([ 'userAnswer' => 'required|integer']); 
        if ($this->index < count($this->questions)) 
        { 
            foreach ($this->questions[$this->index]['answers'] as $answer) {
                if ($answer['id'] == $this->userAnswer) {
                    if ($answer['isCorrect']) {
                        $this->score++;
                    };
                    $this->questions[$this->index]['userResponse'] = $answer;
                };
            };
            $this->index++;
            $this->userAnswer = null;
        }
    }

    public function render()
    {
        return view('livewire.show-question', ['questions' => $this->questions]);
    }
}
