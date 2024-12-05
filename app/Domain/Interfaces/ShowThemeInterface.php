<?php

namespace App\Domain\Interfaces;

interface ShowThemeInterface
{
    /**
     * Get the themes.
     * @return array
     */
    public function getThemes(): array;
}