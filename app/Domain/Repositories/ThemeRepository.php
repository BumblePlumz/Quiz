<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Theme;

interface ThemeRepository
{
    /**
     * Get the themes.
     * @return array
     */
    public function getThemes(): array;

    /**
     * Get the theme by name.
     * @param string $themeName
     * @return Theme
     */
    public function getThemeByName(string $themeName): Theme;
}