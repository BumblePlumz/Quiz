<?php

namespace App\Domain\Entities;

use DateTime;
use App\Domain\Entities\User;
use App\Domain\Entities\Theme;

class Scoreboard
{
    private int|null $id;


    public function __construct(private User $user, private Theme $theme, private int $score, private string $gameMode, private DateTime|null $createdAt = null, int $id = null)	
    {
        $this->id = $id;
    }

    /**
     * Get the id.
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the user.
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the user.
     * @param User $user
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the theme.
     * @return Theme
     */
    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    /**
     * Set the theme.
     * @param Theme $theme
     * @return self
     */
    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get the game mode.
     * @return string
     */
    public function getGameMode(): ?string
    {
        return $this->gameMode;
    }

    /**
     * Set the game mode.
     * @param string $gameMode
     * @return self
     */
    public function setGameMode(string $gameMode): self
    {
        $this->gameMode = $gameMode;

        return $this;
    }

    /**
     * Get the score.
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * Set the score.
     * @param int $score
     * @return self
     */
    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the created at.
     * @return DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * Format the object to an array.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->toArray(),
            'theme' => $this->theme->toArray(),
            'score' => $this->score,
            'game_mode' => $this->gameMode,
        ];
    }
}