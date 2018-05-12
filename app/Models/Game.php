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
