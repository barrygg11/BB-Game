<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>期數管理</title>
    </head>
    <body>
        <form action="gameNumControl" method="post">
            @csrf
            @if (isset($_POST["submit"]))
            <h2>期數管理</h2>
                遊戲類型：
                <select name="game_type" required>
                    <option value="">請選擇遊戲</option>
                    <option @if($_POST['game_type'] == 'TWBG') selected @endif value="TWBG">台灣賓果賓果</option>
                </select>
                    &emsp;
                日期：<input type="date" name="create_time" value="{{Session::get('date')}}" required>
                    &emsp;
                期數：<input type="text" name="game_num" autocomplete="off" value="{{Session::get('game_num')}}">
                    &emsp;
                <input type="submit" name="submit" value="搜尋">
                    <p>
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @else
            <h2>期數管理</h2>
                遊戲類型：
                <select name="game_type" required>
                    <option value="">請選擇遊戲</option>
                    <option value="TWBG">台灣賓果賓果</option>
                </select>
                    &emsp;
                日期：<input type="date" name="create_time" value="{{ date('Y-m-d') }}" required>
                    &emsp;
                期數：<input type="text" name="game_num" autocomplete="off">
                    &emsp;
                <input type="submit" name="submit" value="搜尋">
                    <p>
                <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @endif
        </form>
        @if (isset($_POST["submit"]) && !empty($gameNumControl))
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
            <tr>
                <th>遊戲期數</th>
                <th>遊戲類型</th>
                <th>狀態</th>
                <th>賽果</th>
                <th>開盤時間</th>
                <th>關盤時間</th>
                <th>結算時間</th>
                <th>建立時間</th>
            </tr>
            @foreach ($allData as $gameNum)
            <tr>
                <td>{{ $gameNum['game_num'] }}</td>
                <td>{{ $gameNum['game_type'] }}</td>
                <td>{{ $gameNum['state'] }}</td>
                <td>{{ $gameNum['result'] }}</td>
                <td>{{ $gameNum['open_time'] }}</td>
                <td>{{ $gameNum['close_time'] }}</td>
                <td>{{ $gameNum['result_time'] }}</td>
                <td>{{ $gameNum['create_time'] }}</td>
            <tr>
            @endforeach
        </table>
        @endif
    </body>
</html>