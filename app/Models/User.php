<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Domain\Entities\User as UserEntity;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

/**
     * The questions answered by the user.
     * 
     * @return BelongsToMany
     */
    public function scoreboards(): BelongsToMany
    {
        return $this->belongsToMany(Scoreboard::class, 'scoreboards')
            ->withPivot('score')
            ->withTimestamps();
    }

    /**
     * Get the roles that belong to the user.
     * 
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function toDomainEntity(): UserEntity
    {
        return new UserEntity(
            $this->id,
            $this->name,
            $this->email,
            $this->email_verified_at,
            $this->password,
            $this->twoFactorSecret,
            $this->twoFactorRecoveryCodes,
            $this->twoFactorConfirmedAt,
            $this->remember_token,
            $this->current_team_id,
            $this->profile_photo_path,
            $this->created_at,
            $this->updated_at,
        );
    }
}
