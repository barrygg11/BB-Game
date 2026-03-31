<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>註冊</title>
    </head>
    <body>
        <form action="register" method="post">
            @csrf
            <h2>註冊</h2>
            使用者：<input type="text" name="username" required>
            <p>
            密碼：<input type="password" name="password" required>
            <p>
            <input type="submit" name="submit" value="註冊">
            <input type="button" value="回登入介面" onclick="location.href='http://127.0.0.1:8000'">
            @include('flash-message')
        </form>
    </body>
</html>