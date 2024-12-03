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
     * @inheritDoc
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
     * @inheritDoc
     */
    public function getThemeByName(string $themeName): Theme
    {
        return $this->themeRepository->getThemeByName($themeName); 
    }
}