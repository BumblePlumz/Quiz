<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Theme;

interface ThemeRepository
{
    public function getThemes(): array;
    public function getThemeByName(string $themeName): Theme;
}