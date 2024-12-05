<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Domain\Interfaces\DailyQuizInterface;
use App\Domain\Interfaces\ScoreboardInterface;
use App\Models\User;

class ShowQuestion extends Component
{
    private readonly DailyQuizInterface $dailyQuizInterface;
    private readonly ScoreboardInterface $scoreboardInterface;
    public array $dailyQuiz;
    public array $questions = [];
    public string $theme = '';
    public int $index = 0;
    public $userAnswer = null;
    public int $score = 0;

    public function mount(DailyQuizInterface $dailyQuizInterface, ScoreboardInterface $scoreboardInterface, $theme)
    {
        $this->dailyQuizInterface = $dailyQuizInterface;
        $this->scoreboardInterface = $scoreboardInterface;
        $this->dailyQuiz = $this->dailyQuizInterface->getDailyQuiz($theme)->toArray();
        $this->questions = $this->dailyQuiz['questions'];
        $this->theme = $theme;
    }

    public function hydrate()
    {
        $this->scoreboardInterface = app(ScoreboardInterface::class);
    }

    public function submitAnswer()
    {
        if ($this->index < count($this->questions)) {
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
        if ($this->index == count($this->questions)) {
            /** @var User $user */
            $user = Auth::user();
            $userEntity = $user->toDomainEntity();
            $this->scoreboardInterface->addScore($userEntity, $this->theme, 'dailyquiz', $this->score);
        }
    }

    public function render()
    {
        return view('livewire.show-question', ['questions' => $this->questions]);
    }
}
