<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * 顯示登入介面
     */
    public function loginIndex(){
        return view('login');
    }

    /**
     * 使用者登入
     */
    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $getUser = User::getUserInfo($username);
        
        $count = count($getUser);

        if ($count == 0) {
            return redirect("/")
            ->with('error','無此使用者');
        }
        if ($username == $getUser[0]['username'] && $password == $getUser[0]['password']) {
            $request->session()->put('username',$username);
            $request->session()->put('user_id',$getUser[0]['user_id']);
        if ($username != 'root') {
            $username = 'user';
        }
            return redirect("/lobby/{$username}");
        } else {
            return redirect("/")
            ->with('error','密碼錯誤');
        }
    }

    /**
     * 登出使用者
     */
    public function logout(Request $request) {
        $request->session()->forget('username');
        return redirect("/");
    }

    /**
     * 顯示註冊介面
     */
    public function registerIndex() {
        return view('register');
    }

    /**
     * 註冊使用者，用count判斷，如果是1表示有註冊過,0表示沒有
     */
    public function register(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $getUser = User::getUserInfo($username);
        $count = count($getUser);

        if ($count == 1) {
            return redirect("/register")
            ->with('error','該使用者已重複');
        } else {
            User::registerUser($username, $password);
            return redirect("/register")
            ->with('success','註冊成功');
        }
    }
}
