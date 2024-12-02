<?php

namespace App\Domain\Services;

use App\Domain\Interfaces\ShowThemeInterface;
use App\Domain\Repositories\ThemeRepository;
use App\Domain\Entities\Theme;

class ThemeService implements ShowThemeInterface
{
    /**
     * ThemeService constructor.
     * @param ThemeRepository $themeRepository The injected theme repository
     * @inject App\Domain\Repositories\ThemeRepository
     */
    public function __construct(private ThemeRepository $themeRepository) {}

    /**
     * Get all themes.
     * @return array
     */
    public function getThemes(): array
    {
        $result = [];
        $themes = $this->themeRepository->getThemes();
        foreach($themes as $theme) {
            $result[] = $theme;
        }
        return $result;
    }

    /**
     * Get a theme by its name.
     * @param string $themeName The name of the theme
     * @return Theme
     */
    public function getThemeByName(string $themeName): Theme
    {
        return $this->themeRepository->getThemeByName($themeName); 
    }
}