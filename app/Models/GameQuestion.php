<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $game_id
 * @property int $question_id
 * @property int $championship_id
 * @property int $participant_of_game_id
 * @property int $bal
 * @property string $created_at
 * @property string $updated_at
 * @property Championship $championship
 * @property Game $game
 * @property GameParticipant gameParticipant
 * @property Question $question
 */
class GameQuestion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'question_of_game';

    /**
     * @var array
     */
    protected $fillable = ['game_id', 'question_id', 'championship_id', 'participant_of_game_id', 'bal', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('App\Models\\Championship');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\\Game');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameParticipant()
    {
        return $this->belongsTo('App\Models\GameParticipant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\\Question');
    }
}
