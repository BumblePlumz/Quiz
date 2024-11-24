<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\ShowThemeInterface;

class ThemeController extends Controller
{
    public function __construct(private readonly ShowThemeInterface $showThemeInterface) {}

    /**
     * Show the themes.
     * @return \Illuminate\View\View
     */
    public function showTheme()
    {  
        return view('theme.show', ['themes' => $this->showThemeInterface->getThemes()]);
    }
}
