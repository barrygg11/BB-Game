<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\classes\ParserResult;
use App\Models\Game;

class AutoCreateGameNum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:autoNum {game_type} {num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動新增期數';

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
        $num = $this->argument('num'); 
        $state = 1;
        $getGameInfo = Game::getGameInfo($game_type);
        $count = count($getGameInfo);
        
        if ($game_type == 'TWBG') {
            $open_time = date("Y-m-d 06:55:00"); //07:00
            $open_time = strtotime($open_time); //unix
            $end = date("Y-m-d 06:59:59"); //07:05
            $close_time= strtotime($end); //unix
            $open = date("1970-01-01 08:00:00"); //0
            $close = date("1970-01-01 08:00:00"); //0
            
            if ($count == 0 && !empty($num)) {
                $game_num = $num;
            } else if ($count == 0 && empty($num)) {
                $this->error('請帶入上期期數');
                exit;
            } else if ($count != 0 && empty($num)) {
                $game_num = $getGameInfo[0]['game_num'];
            } else if ($count != 0 && !empty($num)) {
                $this->error('已經有上期期數');
                exit;
            }
        
            $numbers = 0;
            while($numbers < 203) {
                $game_num++;  
                $open_time = $open_time + strtotime("$open+5 min");
                $close_time = $close_time + strtotime("$close+5 min");
                Game::insertGameNum($game_num,$game_type,$state,$open_time,$close_time);
                $numbers++;
            }

            ParserResult::TWBG();
            $this->info(date("Y-m-d H:i:s").' 自動拉期數已完成');
        }
    }
}
