<?php

namespace App\Infrastructure;

use App\Domain\Repositories\ThemeRepository;
use App\Models\Theme;

class MockTheme implements ThemeRepository
{
    private readonly array $themes;

    public function __construct()
    {
        $this->themes = [
            Theme::create(['id' => 0, 'name' => 'PHP']),
            Theme::create(['id' => 1, 'name' => 'SQL']),
            Theme::create(['id' => 2, 'name' => 'Python']),
            Theme::create(['id' => 3, 'name' => 'Java']),
            Theme::create(['id' => 4, 'name' => 'C#']),
            Theme::create(['id' => 5, 'name' => 'Ruby']),
        ];
    }

    public function getThemes(): array
    {
        return $this->themes;
    }

    public function getThemeByName(string $themeName): Theme
    {
        foreach ($this->themes as $theme) {
            if ($theme->name === $themeName) {
                return $theme;
            }
        }
        throw new \Exception('Theme not found');
    }
}
