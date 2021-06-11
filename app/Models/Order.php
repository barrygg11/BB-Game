<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    /**
     * 指定期數取注單資訊
     */
    public static function getOrderInfo($game_num){
        $rets = self::where('game_num',$game_num)
        ->get()
        ->toArray();
        return $rets;
    }

    /**
     * 更新指定期數注單派彩結果
     */
    public static function updateOrderRets($game_num, $wtype, $wingold, $result, $order_time){
        $rets = self::where('game_num',$game_num)
        ->where('order_time',$order_time)
        ->where('wtype',$wtype)
        ->update(['wingold'=>$wingold,'result'=>$result]);
        return $rets;
    }

    /**
     * 計算該使用者的注單結果金額
     */
    public static function getSumWinGold($user_id,$game_num){
        $rets = self::where('user_id',$user_id)
        ->where('game_num',$game_num)
        ->where('result',1)
        ->sum(self::raw('gold + wingold'));
        return $rets;
    }

    /**
     * 輸入下注單
     */
    public static function insertOrder($user_id, $game_type, $game_id, $game_num, $wtype, $odds, $gold){
        $rets = self::insert([
            'user_id' => $user_id,
            'game_type' => $game_type,
            'game_id' => $game_id,
            'game_num' => $game_num,
            'wtype' => $wtype,
            'odds' => $odds,
            'gold' => $gold,
            'result'=>0,
            'wingold' => 0,
            'order_time' => time()
        ]);
        return $rets;
    }
}
