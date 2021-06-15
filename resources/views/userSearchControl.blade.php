<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>會員輸贏金額查詢</title>
    </head>
    <body>
        <form action="userSearchControl" method="post">
            @csrf
            @if (isset($_POST["submit"]))
            <h2>會員輸贏金額查詢</h2>
                遊戲：
                    <select name="game_type" required>
                        <option value="">請選擇遊戲</option>
                        <option @if($_POST['game_type'] == 'TWBG') selected @endif value="TWBG">台灣賓果賓果</option>
                    </select>
                會員編號：<input type="text" name="user_id" value="{{Session::get('user_id')}}" required>
                <p>
                <input type="submit" name="submit" value="搜尋">
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @else
            <h2>會員輸贏金額查詢</h2>
                遊戲：
                    <select name="game_type" required>
                        <option value="">請選擇遊戲</option>
                        <option value="TWBG">台灣賓果賓果</option>
                    </select>
                會員編號：<input type="text" name="user_id" required>
                <p>
                <input type="submit" name="submit" value="搜尋">
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @endif
        </form>
        @if (isset($_POST['submit']) && !empty($userSearchOrder))
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
            <tr>
                <th>期數</th>
                <th>下注金額</th>
                <th>輸贏金額</th>
                <th>查看該期注單</th>
            </tr>
            @foreach ($userSearchOrder as $userOrder)
            <tr>
                <td>第{{ $userOrder['game_num'] }}期</td>
                <td>{{ $userOrder['gold'] }}</td>
                <td>{{ $userOrder['wingold'] }}</td>
                <td><a href = '/userSearchControl/{{ $userOrder['game_id'] }}'>查看</td>
            </tr>
            @endforeach
            <tr>
                <td>總計</td>
                <td>{{ $sum_gold }}</td>
                <td>{{ $sum_winGold }}</td>
                <td>會員：{{ $getNumUserWinGold }}</td>
            </tr>
        </table>
        @endif
    </body>
</html>