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

    /**
     * 取的最新期數
     */
    public static function getGameInfo($game_type){
        $rets = self::where('game_type',$game_type)
        ->orderBy('game_num','desc')
        ->get()
        ->toArray();
        return $rets;
    }
    
    /**
     * Insert 遊戲的內容
     */
    public static function insertGameNum($game_num,$game_type,$state,$open_time,$close_time){
        $rets = self::insert([
            'game_num' => $game_num,
            'game_type'=> $game_type,
            'state' => $state,
            'result'=> null,
            'open_time' => $open_time,
            'close_time' => $close_time,
            'result_time' => null,
            'create_time' => time()
        ]);
        return $rets;
    }
}
