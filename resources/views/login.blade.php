<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>登入</title>
    </head>
    <body>
        <form action="login" method="post">
            @csrf
            <h2>登入</h2>
            使用者：<input type="text" name="username" required>
            <p>
            密碼：<input type="password" name="password" required>
            <p>
            <input type="submit" name="submit" value="登入">
            <input type="button" value="註冊" onclick="location.href='http://127.0.0.1:8000/register'">
            @include('flash-message')
        </form>
    </body>
</html>