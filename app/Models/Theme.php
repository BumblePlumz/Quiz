<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Entities\Theme as ThemeEntity;

class Theme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the questions for the theme.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Convert the model to a domain entity.
     *
     * @return ThemeEntity
     */
    public function toDomainEntity(): ThemeEntity
    {
        return new ThemeEntity(
            $this->id,
            $this->name,
        );
    }
}
