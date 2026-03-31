<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserApi extends Controller
{
    public function loginApi(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $newPassword = $request->input('newPassword');
        $userInfo = User::getUserInfo($username);
        $count =count($userInfo);

        if ($count == 0) {
            $rets = urlencode('無此使用者');
        } else {
            foreach ($userInfo as $data) {
                if ($username == $data['username'] && $password == $data['password'] && $newPassword != $data['password']) {
                    User::loginApi($username, $password, $newPassword);
                    $rets = urlencode('密碼更改成功');
                } else if ($password != $data['password']) {
                    $rets = urlencode('密碼錯誤');
                } else if ($newPassword == $data['password']) {
                    $rets = urlencode('密碼重複');
                }
            }
        }
        return urldecode(json_encode($rets));
    }

    public function registerUserApi(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $getUser = User::getUserInfo($username);
        $count = count($getUser);

        $start_time = microtime(true);

        if ($count == 1){
            $status = 'false';
            $msg = urlencode('已被註冊使用過');
        } else {
            User::registerUser($username, $password);
            $status = 'pass';
            $msg = urlencode('註冊成功');
        }
        $end_time = microtime(true);
        $run_time = sprintf("%f",$end_time - $start_time);
        return urldecode(json_encode(['status'=>$status,'msg'=>$msg,'rets'=>$getUser,'execution_time'=>$run_time."s"]));
    }
}
