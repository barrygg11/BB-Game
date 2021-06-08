<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>修改密碼</title>
    </head>
    <body>
        <form action="edit-password" method="post">
            @csrf
            <h2>修改密碼</h2>
            密碼：<input type="password" name="password" required>
            <p>
            <input type="submit" name="submit" value="修改">
            @if (Session::get('username') != 'root')
            <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/user'">
            @else
            <input type="button" value="回大廳" onclick="location.href='http://127.0.0.1:8000/lobby/root'">
            @endif
            @include('flash-message')
        </form>
    </body>
</html>