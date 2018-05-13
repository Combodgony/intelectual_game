<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

/**
 * Class Game
 * @property date date
 * @property string place
 * @property int next_game_id
 * @property int tur_id
 *
 * @property Tur tur
 * @property Round[] rounds
 * @property GameParticipant[] gameParticipants
 *
 * @package App\Models
 */
class Game extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public const STATUS_NEW = "not scheduled";
    public const STATUS_PlAN = "planed";
    public const STATUS_GENERATED = 'scenario generated';
    public const STATUS_END = "completed";


    protected $table = 'game';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['date','place','tur_id','status'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getStatusList(){
        return [self::STATUS_NEW=>self::STATUS_NEW
            , self::STATUS_END=>self::STATUS_END
            , self::STATUS_PlAN=>self::STATUS_PlAN
            , self::STATUS_GENERATED=>self::STATUS_GENERATED
        ];
    }
    public function rounds(){
        return $this->belongsToMany('App\Models\Round','rounds_of_game',
            'game_id', 'round_id');
    }

    public function jury(){
        return $this->belongsToMany('App\Models\Round','rounds_of_game',
            'game_id', 'round_id');
    }

    public function participants(){
        return $this->belongsToMany('App\Models\Command','participant_of_game',
            'game_id', 'command_id');
    }

    public function gameParticipants(){
        return $this->hasMany('App\Models\GameParticipant');
    }





    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return Tur
     */
    public function tur()
    {
        return $this->belongsTo('App\Models\Tur');
    }

//    public function championship(){
//        $tur = Tur::find($this->tur_id);
//        return Championship::where('id', ()->championship_id);
//    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
