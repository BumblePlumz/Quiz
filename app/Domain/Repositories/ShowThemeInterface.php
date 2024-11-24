<?php

namespace App\Domain\Repositories;

interface ShowThemeInterface
{
    public function getThemes(): array;
}