<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Entities\Answer as AnswerEntity;

class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
    ];

    /**
     * Get the question that owns the answer.
     * 
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Convert the model to a domain entity.
     * 
     * @return AnswerEntity
     */
    public function toDomainEntity(): AnswerEntity
    {
        return new AnswerEntity(
            $this->answer,
            $this->is_correct,
            $this->id
        );
    }
}
