<?php

namespace App\Domain\Repositories;

use App\Models\Theme;

interface ThemeRepository
{
    public function getThemes(): array;
    public function getThemeByName(string $themeName): Theme;
}