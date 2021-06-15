<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use App\Models\Config;


class AdminGameControlController extends Controller
{
    public function gameNumControlIndex() {
        return view('gameNumControl');
    }

    public function gameNumControl(Request $request) {
        $game_type = $request->input('game_type');
        $date = $request->input('create_time');
        $game_num = $request->input('game_num');
        $create_time = strtotime($date);

        $request->session()->put('date',$date);
        $request->session()->put('game_num',$game_num);

        $checkOrderTimeRange = Game::checkOrderTimeRange();
        $UnixTime = date("1970-01-01 08:00:00");

        foreach ($checkOrderTimeRange as $newTime) {
            if ($create_time < $newTime['create_time'] && $create_time + strtotime("$UnixTime+23 hour 59 min 59 seconds") > $newTime['create_time']) {
                $newTime = $newTime['create_time'];
                break;
            }
        }

        $gameNumControl = Game::gameNumControl($game_type, $newTime, $game_num);
        $getGameConfig = Config::getGameConfig();
        $count = count($gameNumControl);

        if ($count == 0) {
            return view('gameNumControl');
        } else {
            foreach ($gameNumControl as $data) {
                if ($data['game_type'] == $getGameConfig[0]['game_type']) {
                    $data['game_type'] = $getGameConfig[0]['game_name'];
                }

                if ($data['state'] == 1) {
                    $data['state'] = '開放';
                } else {
                    $data['state'] = '關閉';
                }

                $rets_array = json_decode($data['result'],true);

                if ($data['result'] == null) {
                    $data['result'] = '目前無賽果';
                } else {
                    $data['result'] = implode(" ",$rets_array);
                }

                $UnixOpenTime=$data['open_time'];
                $data['open_time'] = date('Y-m-d H:i:s',$UnixOpenTime);

                $UnixCloseTime=$data['close_time'];
                $data['close_time'] = date('Y-m-d H:i:s',$UnixCloseTime);

                $UnixResultTime=$data['result_time'];
                if ($data['result_time'] == null) {
                    $data['result_time'] = '尚未結算';
                } else {
                    $data['result_time'] = date('Y-m-d H:i:s',$UnixResultTime);
                }

                $UnixCreateTime=$data['create_time'];
                $data['create_time'] = date('Y-m-d H:i:s',$UnixCreateTime);

                $allData[] = $data;
            }
            return view('gameNumControl',compact('allData','gameNumControl'));
        }
    }

    public function gameOrdersControlIndex() {
        return view('gameOrdersControl');
    }

    public function gameOrdersControl(Request $request) {
        $game_type = $request->input('game_type');
        $game_num = $request->input('game_num');
        $result = $request->input('result');

        $request->session()->put('game_num',$game_num);

        $getSearchOrders = Order::getSearchOrders($game_type, $game_num, $result);
        $getAllUserInfo = User::getAllUserInfo();
        $UserInfoCount = count($getAllUserInfo);
        $getGameConfig = Config::getGameConfig();
        $wtypeName = array('Up'=>"上盤",'Down'=>"下盤",'Middle'=>"中盤",'Metal'=>"金",'Wood'=>"木",'Water'=>"水",'Fire'=>"火",'Earth'=>"土");

        if ($getSearchOrders != null) {
            foreach ($getSearchOrders as $orders) {
                for ($i=0; $i<$UserInfoCount; $i++) {
                    if ($orders['user_id'] == $getAllUserInfo[$i]['user_id']) {
                        $orders['user_id'] = $getAllUserInfo[$i]['username'];
                    }
                }
                    if ($orders['game_type'] == $getGameConfig[0]['game_type']) {
                        $orders['game_type'] = $getGameConfig[0]['game_name'];
                    }
                foreach ($wtypeName as $key => $chName){
                    if ($orders['wtype'] == $key) {
                        $orders['wtype'] = $chName;
                        break;
                    }
                }
                    if ($orders['result'] == 1) {
                        $orders['result'] = '贏';
                    } else if ($orders['result'] == 2) {
                        $orders['result'] = '輸';
                    } else {
                        $orders['result'] = '未結算';
                    }

                $UnixOrderTime=$orders['order_time'];
                $orders['order_time'] = date('Y-m-d H:i:s',$UnixOrderTime);   
                
                $allOrders[] = $orders;
            }
            return view('gameOrdersControl',compact('allOrders','getSearchOrders'));
        } else {
            return view('gameOrdersControl');
        }
    }

    public function userSearchControlIndex() {
        return view('userSearchControl');
    }

    public function userSearchControl(Request $request) {
        $game_type = $request->input('game_type');
        $user_id = $request->input('user_id');
        $request->session()->put('user_id',$user_id);

        $userSearchOrder = Order::userSearchOrder($game_type, $user_id);
        $sum_gold = 0;
        $sum_winGold = 0;
        $getNumUserWinGold = Order::getNumUserWinGold($user_id,$game_type);

        if ($getNumUserWinGold > 0) {
            $getNumUserWinGold = '贏';
        } else {
            $getNumUserWinGold = '輸';
        }

        if ($userSearchOrder != null) {
            foreach ($userSearchOrder as $total) {
                $sum_gold += $total['gold'];
                $sum_winGold += $total['wingold'];
            }
            return view('userSearchControl',compact('userSearchOrder','sum_gold','sum_winGold','getNumUserWinGold'));
        } else {
            return view('userSearchControl');
        }
    }

    public function userHyperlinkIndex(Request $request, $game_id) {
        $user_id = $request->session()->get('user_id');
        $getUserOrder = Order::getUserOrder($user_id,$game_id);
        foreach ($getUserOrder as $getUserOrders) {
            $order_time = date('Y-m-d H:i:s',($getUserOrders['order_time']));
        }
        return view('userAllOrder', compact('getUserOrder','order_time'));
    }
}
