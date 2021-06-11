<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>台灣賓果</title>
    </head>
    <body>
        <form action="bingo" method="post" name="bingo">
            @csrf
            <h1>台灣賓果賓果</h1>
            <h2>上中下盤</h2>
            上盤：<input type="text" name="top_gold">
            中盤：<input type="text" name="mid_gold">
            下盤：<input type="text" name="bot_gold">
            <p>
            <h2>五行玩法</h2>
            金：<input type="text" name="metal_gold">
            木：<input type="text" name="wood_gold">
            水：<input type="text" name="water_gold">
            火：<input type="text" name="fire_gold">
            土：<input type="text" name="earth_gold">
            <p>
            <input type="submit" name="submit" value="下注">
            <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/user'">
            @include('flash-message')
        </form>
    </body>
</html>