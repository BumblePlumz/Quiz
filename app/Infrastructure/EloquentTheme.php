<?php

namespace App\Infrastructure;

use App\Domain\Entities\Theme as ThemeEntity;
use App\Domain\Repositories\ThemeRepository;
use App\Models\Theme;

class EloquentTheme implements ThemeRepository
{
    public function getThemes(): array
    {
        // Récupère tous les thèmes depuis Eloquent et les convertit en entités de domaine
        return Theme::all()
            ->map(fn($theme) => $theme->toDomainEntity()->toArray())
            ->toArray();
    }

    public function getThemeByName(string $themeName): ThemeEntity
    {
        // Trouve un thème par nom et le convertit en entité de domaine
        $theme = Theme::where('name', $themeName)->firstOrFail();
        return $theme->toDomainEntity();
    }
}
