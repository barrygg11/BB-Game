<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Game;

class AutoSendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Auto:SendMessage {game_type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '輸錢警報-自動發送訊息給telegram機器人';

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
        $game_type = $this->argument('game_type');
        $getNewOrderNumInfo = Order::getNewOrderNumInfo($game_type);
        $game_num = $getNewOrderNumInfo[0]['game_num'];
        $user_id = $getNewOrderNumInfo[0]['user_id'];
        $game_id = $getNewOrderNumInfo[0]['game_id'];
        $getUserOrder = Order::getUserOrder($user_id,$game_id);

        $winGold = 0;
        foreach ($getUserOrder as $data) {
            $winGold += $data['wingold'];
        }

        $getGameResult = Game::getGameResult($game_type);

        if ($game_num == $getGameResult[0]['game_num']) {
            if ($winGold < -500) {
                $botToken="1721543109:AAGi2EZC1N9UTr9eoh1FQ2FNQNEtl-GRuro";
                $website="https://api.telegram.org/bot".$botToken;
                $chatId=-1001131746605;
                $params=[
                    'chat_id'=>$chatId,
                    'text'=>'使用者：'.$user_id.', 期數：'.$game_num.', 輸超過500'.', 金額：'.$winGold,
                ];
                $ch = curl_init($website . '/sendMessage');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                $json = json_decode($result, true);
                $repo = array_search("true",$json);
                if ($repo == 'ok') {
                    $this->info(date("Y-m-d H:i:s").' 傳送成功');
                } else {
                    $this->info(date("Y-m-d H:i:s").' 傳送失敗');
                }
                curl_close($ch);
            }
        } else {
            $this->info(date("Y-m-d H:i:s").' 目前無注單');
        }
    }
}
