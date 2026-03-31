<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class LobbyController extends Controller
{
    /**
     * 顯示大廳介面
     */
    public function lobbyIndex(Request $request) {
        $username = $request->session()->get('username');
        $getUserInfo = User::getUserInfo($username);

        if ($username == 'root') {
            return view('adminLobby',compact('getUserInfo'));
        } else {
            return view('lobby',compact('getUserInfo'));
        }
    }
}
