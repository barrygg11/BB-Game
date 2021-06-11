<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'config';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * 取所有遊戲
     */
    public static function getGameConfig(){
        $rets = self::get()
        ->toArray();
        return $rets;
    }
}
