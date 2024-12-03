<?php

namespace App\Domain\Entities;

class User 
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string|null $email_verified_at,
        private string $password,
        private string|null $twoFactorSecret,
        private string|null $twoFactorRecoveryCodes,
        private string|null $twoFactorConfirmedAt,
        private string|null $remember_token,
        private string|null $current_team_id,
        private string|null $profile_photo_path,
        private string $created_at,
        private string $updated_at,
    ) {}

    /**
     * Get the id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the email.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the email verified at.
     * @return string
     */
    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }

    /**
     * Get the password.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Get the two factor secret.
     * @return string
     */
    public function getTwoFactorSecret(): string
    {
        return $this->twoFactorSecret;
    }

    /**
     * Get the two factor recovery codes.
     * @return string
     */
    public function getTwoFactorRecoveryCodes(): string
    {
        return $this->twoFactorRecoveryCodes;
    }

    /**
     * Get the two factor confirmed at.
     * @return string
     */
    public function getTwoFactorConfirmedAt(): string
    {
        return $this->twoFactorConfirmedAt;
    }

    /**
     * Get the remember token.
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->remember_token;
    }

    /**
     * Get the current team id.
     * @return string
     */
    public function getCurrentTeamId(): string
    {
        return $this->current_team_id;
    }

    /**
     * Get the profile photo path.
     * @return string
     */
    public function getProfilePhotoPath(): string
    {
        return $this->profile_photo_path;
    }

    /**
     * Get the created at.
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the updated at.
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Format the object to an array.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'two_factor_secret' => $this->twoFactorSecret,
            'two_factor_recovery_codes' => $this->twoFactorRecoveryCodes,
            'two_factor_confirmed_at' => $this->twoFactorConfirmedAt,
            'remember_token' => $this->remember_token,
            'current_team_id' => $this->current_team_id,
            'profile_photo_path' => $this->profile_photo_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}