<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyQuizController extends Controller
{
    public function __construct() {}

    /**
     * Start the quiz by getting the daily quiz for the given theme.
     * @param Request $request The request object
     * @return \Illuminate\View\View
     */
    public function showQuestion(Request $request)
    {
        $themeName = $request->route('theme');
        return view('dailyquiz.show', ['theme' => $themeName]);
    }
}
