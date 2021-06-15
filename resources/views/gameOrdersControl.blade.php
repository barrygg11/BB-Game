<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>注單管理</title>
    </head>
    <body>
        <form action="gameOrdersControl" method="post">
            @csrf
            @if (isset($_POST["submit"]))
            <h2>注單管理</h2>
                遊戲：
                <select name="game_type" required>
                    <option value="">請選擇遊戲</option>
                    <option @if($_POST['game_type'] == 'TWBG') selected @endif value="TWBG">台灣賓果賓果</option>
                </select>
                    &emsp;
                期數：<input type="text" name="game_num" value="{{Session::get('game_num')}}">
                    &emsp;
                狀態：
                <select name="result">
                    <option value="">請選擇狀態</option>
                    <option @if($_POST['result'] == '0') selected @endif value="0">未結算</option>
                    <option @if($_POST['result'] == '1') selected @endif value="1">贏</option>
                    <option @if($_POST['result'] == '2') selected @endif value="2">輸</option>
                </select>
                    <p>
                <input type="submit" name="submit" value="搜尋">
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @else
            <h2>注單管理</h2>
                遊戲：
                <select name="game_type" required>
                    <option value="">請選擇遊戲</option>
                    <option value="TWBG">台灣賓果賓果</option>
                </select>
                &emsp;
                期數：<input type="text" name="game_num">
                &emsp;
                狀態：
                <select name="result">
                    <option value="">請選擇狀態</option>
                    <option value="0">未結算</option>
                    <option value="1">贏</option>
                    <option value="2">輸</option>
                </select>
                    <p>
                <input type="submit" name="submit" value="搜尋">
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
                @endif
        </form>
        @if (isset($_POST["submit"]) && !empty($getSearchOrders))
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
            <tr>
                <th>注單ID</th>
                <th>使用者</th>
                <th>遊戲</th>
                <th>玩法</th>
                <th>期數</th>
                <th>賠率</th>
                <th>下注金額</th>
                <th>獲利</th>
                <th>結果</th>
                <th>注單時間</th>
            </tr>
            @foreach ($allOrders as $data)
            <tr>
                <td>{{ $data['order_id'] }}</td>
                <td>{{ $data['user_id'] }}</td>
                <td>{{ $data['game_type'] }}</td>
                <td>{{ $data['wtype'] }}</td>
                <td>{{ $data['game_num'] }}</td>
                <td>{{ $data['odds'] }}</td>
                <td>{{ $data['gold'] }}</td>
                <td>{{ $data['wingold'] }}</td>
                <td>{{ $data['result'] }}</td>
                <td>{{ $data['order_time'] }}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </body>
</html>