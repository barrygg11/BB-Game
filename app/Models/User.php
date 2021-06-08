<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection;
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    /**
     * 取出指定使用者資訊
     */
    public static function getUserInfo($username){
        $rets = self::where('username',$username)
        ->get()
        ->toArray();
        return $rets;
    }

    /**
     * 取出所有使用者資訊
     */
    public static function getAllUserInfo(){
        $rets = self::get()
        ->toArray();
        return $rets;
    }

    /**
     * 註冊使用者
     */
    public static function registerUser($username, $password){
        $rets = self::insert(['username' => $username, 'password' => $password, 'money' => 0]);
        return $rets;
    }
}
