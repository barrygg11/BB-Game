<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\classes\ParserResult;
use App\Models\Game;
use App\Models\Order;
use App\Models\User;

class AutoGetResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:gameNum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動補賽果';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ParserResult::TWBG();
        $game_type = 'TWBG';
        $getGameResult = Game::getGameResult($game_type); //取最新有賽果的期數資訊
        $newRets = $getGameResult[0]['result']; //取最新賽果資料
        $newGameNum = $getGameResult[0]['game_num']; //取最新期數資料
        $nowGameRets =json_decode($newRets, true); //將最新賽果Json轉陣列

        // 計算出當期上下盤
        $up = 0;
        $down = 0;
        foreach ($nowGameRets as $data) {
            if ($data <= 40) {
                $up = $up +1;
            }
            if ($data >= 41) {
                $down = $down +1;
            }
        }

        if ($up > 10) {
            $gameRets = 'Up';
        } else if ($down > 10) {
            $gameRets = 'Down';
        } else if ($up == $down) {
            $gameRets = 'Middle';
        }

        $nowGameRetSum = array_sum($nowGameRets); //目前賽果總和

        if ($nowGameRetSum >= 210 && $nowGameRetSum <= 695) {
            $elementsRets = 'Metal';
        } else if ($nowGameRetSum >= 696 && $nowGameRetSum <= 763) {
            $elementsRets = 'Wood';
        } else if ($nowGameRetSum >= 764 && $nowGameRetSum <= 855) {
            $elementsRets = 'Water';
        } else if ($nowGameRetSum >= 856 && $nowGameRetSum <= 923) {
            $elementsRets = 'Fire';
        } else if ($nowGameRetSum >= 924 && $nowGameRetSum <= 1410) {
            $elementsRets = 'Earth';
        }

        $getOrderInfo = Order::getOrderInfo($newGameNum); // 抓最新注單資訊
        $userInfo = User::getAllUserInfo();

        if ($getOrderInfo != null){
            foreach ($getOrderInfo as $order) {
                if ($order['wtype'] == $gameRets || $order['wtype'] == $elementsRets) {
                    $result = 1;
                    $winGold = $order['gold']*$order['odds']-$order['gold'];
                } else {
                    $result = 2;
                    $winGold = -$order['gold'];
                }
                Order::updateOrderRets($newGameNum, $order['wtype'], $winGold, $result, $order['order_time']);
            }
            foreach ($userInfo as $user) {
                if ($getOrderInfo[0]['result'] == 0) {
                    $userSum =Order::getSumWinGold($user['user_id'],$newGameNum);
                    $userTotal = $user['money'] + $userSum;
                    User::saveMoney($user['username'],$userTotal);
                }
            }
        }
        $this->info(date("Y-m-d H:i:s").' 期賽果更新成功');
    }
}
