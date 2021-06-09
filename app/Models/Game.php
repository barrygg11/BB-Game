<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'game';
    protected $primaryKey = 'game_id';
    public $timestamps = false;

    /**
     * 更新賽果
     */
    public static function updateGameResult($game_num, $result){
        $rets = self::where('game_num',$game_num)
        ->where('result_time',null)
        ->update(['result' => $result]);
        return $rets;
    }

    /**
     * 關閉有賽果的期數紀錄賽果時間
     */
    public static function closeState(){
        $rets = self::where('result','!=',null)
        ->update(['state' => 2]);
        return $rets;
    }

    /**
     * 建立賽果結果時間
     */
    public static function addResultTime(){
        $rets = self::where('state',2)
        ->where('result_time',null)
        ->update(['result_time' => time()]);
        return $rets;
    }
}
