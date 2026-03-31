<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>存提款</title>
    </head>
    <body>
        <form action="" method="post">
            @csrf
            <h2>存提款</h2>
            金額：<input type="text" name="money" required> 元
            <p>
            <input type="radio" name="status" value="input" checked>存款
            <input type="radio" name="status" value="output">提款
            <p>
            <input type="submit" name="submit" value="確定">
            @if (Session::get('username') != 'root')
            <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/user'">
            @else
            <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @endif
            @include('flash-message')
        </form>
    </body>
</html>