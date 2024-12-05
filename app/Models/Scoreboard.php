<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Entities\Scoreboard as ScoreboardEntity;

class Scoreboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_id',
        'game_mode',
        'score',
    ];

    /**
     * Get the user that owns the scoreboard.
     * 
     * @return BelongsTo
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Get the user that owns the scoreboard.
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toDomainEntity(): ScoreboardEntity
    {
        return new ScoreboardEntity(
            $this->user->toDomainEntity(),
            $this->theme->toDomainEntity(),
            $this->score,
            $this->game_mode,
            $this->created_at,
            $this->id,
        );
    }
}