<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Order;
use App\Models\User;
use App\Models\Game;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Update:OrderStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '手動執行過期注單改狀態為取消';

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
        $getNullOrderInfo = Order::getNullOrderInfo();
        $userInfo = User::getAllUserInfo();

        if (!empty($getNullOrderInfo)) {
            $user_id = $getNullOrderInfo[0]['user_id'];
            $game_num = $getNullOrderInfo[0]['game_num'];
            $getGameNumNotResult = Game::getGameNumNotResult($game_num);
            $unixTime = $getGameNumNotResult[0]['create_time'];
            $dateData = date('Y-m-d',$unixTime);
            $nowDate = date('Y-m-d');

            if ($dateData != $nowDate) {
                Order::updateNullOrder($game_num);
            }

            $userInfo = User::getAllUserInfo();
            foreach ($userInfo as $user) {
                if ($user['user_id'] == $user_id) {
                    $newSumGold = Order::getCancelSum($user_id,$game_num);
                    $userTotal = $user['money'] + $newSumGold;
                    User::saveMoney($user['username'],$userTotal);
                }
            }
        }
    }
}
