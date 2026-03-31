<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Game;
use App\Models\User;
use App\Models\Config;

class GameController extends Controller
{
    public function bingoIndex() {
        return view('bingo');
    }

    public function bingo(Request $request) {
        $top_gold = $request->input('top_gold', 0);
        $mid_gold = $request->input('mid_gold', 0);
        $bot_gold = $request->input('bot_gold', 0);

        $metal_gold = $request->input('metal_gold', 0);
        $wood_gold = $request->input('wood_gold', 0);
        $water_gold = $request->input('water_gold', 0);
        $fire_gold = $request->input('fire_gold', 0);
        $earth_gold = $request->input('earth_gold', 0);

        $total_gold =$top_gold + $mid_gold + $bot_gold + $metal_gold + $wood_gold + $water_gold + $fire_gold + $earth_gold;

        $user_id = $request->session()->get('user_id');
        $username = $request->session()->get('username');
        $money = User::getUserInfo($username);
        $getGameConfig = Config::getGameConfig();
        $game_type = $getGameConfig[0]['game_type'];

        $orderTime = time();
        $nowGameInfo = [];
        $checkOrderTimeRange =Game::checkOrderTimeRange();

        foreach ($checkOrderTimeRange as $data) {
            if ($orderTime >= $data['open_time'] && $orderTime<= $data['close_time']) {
                $nowGameInfo = $data;
                break;
            }
        }
        $game_num = $nowGameInfo['game_num'];
        $game_id = $nowGameInfo['game_id'];

        if ($total_gold == 0) {
            return redirect("/bingo")
            ->with('error','至少下一注');
        }

        if ($total_gold > $money[0]['money']) {
            return redirect("/bingo")
            ->with('error','餘額不足');
        }

        $odds = array(
            'Up'=>2.47,
            'Middle'=>4.85,
            'Down'=>2.47,
            'Metal'=>9.2,
            'Wood'=>4.6,
            'Water'=>2.4,
            'Fire'=>4.6,
            'Earth'=>9.2
        );
        $golds = array('Up'=>$top_gold, 'Middle'=>$mid_gold, 'Down'=>$bot_gold, 'Metal'=>$metal_gold, 'Wood'=>$wood_gold, 'Water'=>$water_gold, 'Fire'=>$fire_gold, 'Earth'=>$earth_gold);
        
        foreach ($odds as $wtype => $odd) {
            if ($golds[$wtype] == 0) {
                continue;
            }
            Order::insertOrder($user_id, $game_type, $game_id, $game_num, $wtype, $odd, $golds[$wtype]);
        }

        $getNowUser = User::getUserInfo($username);
        $currentOrderGold = $getNowUser[0]['money'] - $total_gold;
        User::saveMoney($username,$currentOrderGold);

        return redirect("/bingo")
        ->with('success','下注成功');
    }
}
