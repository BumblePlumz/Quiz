<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domain\Interfaces\ScoreboardInterface;

class ScoreboardController extends Controller
{
    public function __construct(private readonly ScoreboardInterface $scoreboardInterface){}

    // Display the specified score
    public function show()
    {
        return view('scoreboard.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required',
            'gameMode' => 'required',
            'score' => 'required|integer',
        ]);
        $user = Auth::user();
        
        $this->scoreboardInterface->addScore($user->id, $request->theme, $request->gameMode, $request->score);

        return response()->noContent();
    }
}
