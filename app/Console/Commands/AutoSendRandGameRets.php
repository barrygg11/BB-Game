<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Game;

class AutoSendRandGameRets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Auto:RandomResults {game_type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動補齊前天未寫入的賽果';

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
        $yesterday = date("Y-m-d",strtotime("-1 day"));
        $getGameInfo = Game::getGameInfo($game_type);
        foreach ($getGameInfo as $allGameInfo) {
            $unixDate = $allGameInfo['create_time'];
            $GameInfoDate = date("Y-m-d",$unixDate);
            if ($GameInfoDate == $yesterday) {
                $create_time = $unixDate;
            }
        }
        $randArray = array(1,2,3,4,5,6,7,8,9,10,
        11,12,13,14,15,16,17,18,19,20,
        21,22,23,24,25,26,27,28,29,30,
        31,32,33,34,35,36,37,38,39,40,
        41,42,43,44,45,46,47,48,49,50,
        51,52,53,54,55,56,57,58,59,60,
        61,62,63,63,65,66,67,68,69,70,
        71,72,73,74,75,76,77,78,79,80);

        $autoCreate = array_rand($randArray,20);
        for ($i=1; $i<=20; $i++) {
            if ($i < 10) {
                $i = '0'.$i;
            }
            $resp[$i] = $autoCreate[$i-1];
        }
        $result = json_encode($resp);
        Game::randomGameResult($game_type,$create_time,$result);
    }
}
