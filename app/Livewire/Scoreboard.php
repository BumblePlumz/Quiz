<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Domain\Interfaces\ScoreboardInterface;

class Scoreboard extends Component
{
    private readonly ScoreboardInterface $scoreboardInterface;
    public array $scores;

    public function mount(ScoreboardInterface $scoreboardInterface)
    {
        $this->scoreboardInterface = $scoreboardInterface;
        $user = Auth::user();
        $this->scores = $this->scoreboardInterface->getScores($user->id);
    }
    
    public function render()
    {
        return view('livewire.scoreboard', ['scores' => $this->scores]);
    }
}
