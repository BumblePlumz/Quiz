<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Entities\Question as QuestionEntity;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'theme_id',
        'question',
        'difficulty',
        'generated_at',
    ];

    /**
     * Get the theme that owns the question.
     * 
     * @return BelongsTo
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Get the answers for the question.
     * 
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Convert the model to a domain entity.
     * 
     * @return QuestionEntity
     */
    public function toDomainEntity(): QuestionEntity
    {
        $answers = $this->answers->map(function ($answer) {
            return $answer->toDomainEntity();
        });

        return new QuestionEntity(
            $this->question,
            $this->difficulty,
            $answers,
            $this->id,
        );
    }
}
