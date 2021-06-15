<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>會員輸贏金額查詢</title>
    </head>
    <body>
        <input type ="button" onclick="history.back()" value="回到上一頁"></input>
        <p>
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
            <tr>
                <th>使用者</th>
                <th>遊戲</th>
                <th>遊戲ID</th>
                <th>期數</th>
                <th>玩法</th>
                <th>賠率</th>
                <th>下注金額</th>
                <th>獲利</th>
                <th>結果</th>
                <th>下注時間</th>
            </tr>
            @foreach ($getUserOrder as $userOrder)
            <tr>
                <td>{{$userOrder['user_id']}}</td>
                <td>{{$userOrder['game_type']}}</td>
                <td>{{$userOrder['game_id']}}</td>
                <td>{{$userOrder['game_num']}}</td>
                <td>{{$userOrder['wtype']}}</td>
                <td>{{$userOrder['odds']}}</td>
                <td>{{$userOrder['gold']}}</td>
                <td>{{$userOrder['wingold']}}</td>
                <td>{{$userOrder['result']}}</td>
                <td>{{$order_time}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>