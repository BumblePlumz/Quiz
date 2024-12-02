<?php

namespace App\Domain\Entities;

class User 
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $email_verified_at,
        private string $password,
        private string $twoFactorSecret,
        private string $twoFactorRecoveryCodes,
        private string $twoFactorConfirmedAt,
        private string $remember_token,
        private string $current_team_id,
        private string $profile_photo_path,
        private string $created_at,
        private string $updated_at,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getTwoFactorSecret(): string
    {
        return $this->twoFactorSecret;
    }

    public function getTwoFactorRecoveryCodes(): string
    {
        return $this->twoFactorRecoveryCodes;
    }

    public function getTwoFactorConfirmedAt(): string
    {
        return $this->twoFactorConfirmedAt;
    }

    public function getRememberToken(): string
    {
        return $this->remember_token;
    }

    public function getCurrentTeamId(): string
    {
        return $this->current_team_id;
    }

    public function getProfilePhotoPath(): string
    {
        return $this->profile_photo_path;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}