<?php

namespace App\Infrastructure;

use App\Domain\Repositories\QuestionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class EloquentQuestion 
{
    // implement the getDailyQuestion method
    
    public function getDailyQuestion($themeName): Collection
    {
        $dailyQuestion = DB::table('questions')
            ->join('themes', 'questions.theme_id', '=', 'themes.id')
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->select('questions.*', 'answers.*')
            ->whereDate('questions.created_at', '=', \Carbon\Carbon::today())
            ->where('themes.name', '=', $themeName)
            ->get();
        
        return $dailyQuestion;
    }
}