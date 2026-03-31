<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CurrentOrderApi extends Controller
{
    public function OrderApi($game_type, $game_num) {

        $count_time = microtime(true);
        $getCurrentOrder = Order::getOrderInfo($game_num);
        $count = count($getCurrentOrder);

        if ($count == 0) {
            $status = 'false';
            $msg = urlencode("期數輸入錯誤");
        } else if ($game_type == $getCurrentOrder[0]['game_type'] && $game_num == $getCurrentOrder[0]['game_num']) {
            $status = 'true';
            $msg = urlencode("執行成功");
        } else if ($game_type != $getCurrentOrder[0]['game_type'] && $game_num == $getCurrentOrder[0]['game_num']) {
            $status = 'false';
            $msg = urlencode("遊戲類型輸入錯誤");
            $getCurrentOrder = [];
        }
        return urldecode(json_encode(['status'=>$status,'msg'=>$msg,'rets'=>$getCurrentOrder,'execution_time'=>(microtime(true)-$count_time)."s"]));
    }
}
