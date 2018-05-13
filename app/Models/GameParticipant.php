<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $game_id
 * @property int $command_id
 * @property string $created_at
 * @property string $updated_at
 * @property Command $command
 * @property Game $game
 * @property GameQuestion[] $gameQuestions
 */
class GameParticipant extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'participant_of_game';

    /**
     * @var array
     */
    protected $fillable = ['game_id', 'command_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function command()
    {
        return $this->belongsTo('App\Models\\Command');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\\Game');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameQuestions()
    {
        return $this->hasMany('App\Models\GameQuestion');
    }
}
