<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    /**
     * 存提款介面
     */
    public function saveMoneyIndex() {
        return view('save-money');
    }

    /**
     * 存提款
     */
    public function saveMoney(Request $request) {
        $money = $request->input('money');
        $status = $request->input('status');
        $username = $request->session()->get('username');
        $getUserInfo = User::getUserInfo($username);
        $totalMoney = $getUserInfo[0]['money'];
    
        if ($status == 'output') {
            $money = -$money;
        }

        $total = $money + $totalMoney;

        if ($total < 0) {
            return redirect("/save-money")
            ->with('error',"餘額不足");
        }
        if ($money == 0) {
            return redirect("/save-money")
            ->with('error',"不能為零");
        }
        
        User::saveMoney($username,$total);
            return redirect("/save-money")
            ->with('success','交易成功');
    }
}
