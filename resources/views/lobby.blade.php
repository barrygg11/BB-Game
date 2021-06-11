<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>大廳</title>
    </head>
    <body>
            @csrf
            <h2>大廳</h2>
            {{Session::get('username')}}，您好！, <a href="{{ route('logout') }}">登出</a>
            <p>
            帳戶金額：{{ $getUserInfo[0]['money'] }}元
            <p>
            <a href="{{ route('save-money') }}">存提款</a>
            <a href="{{ route('edit-password') }}">修改密碼</a>
            <p>
            -----------------------------------------------
            <p>
            <a href="{{ route('bingo') }}">【台灣賓果賓果】</a>
            @include('flash-message')
    </body>
</html>