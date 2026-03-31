<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>管理員介面</title>
    </head>
    <body>
            @csrf
            <h2>管理員大廳</h2>
            {{Session::get('username')}}，您好！, <a href="{{ route('logout') }}">登出</a>
            <p>
            帳戶金額：{{ $getUserInfo[0]['money'] }}元
            <p>
            1.<a href="{{ route('save-money') }}">存提款</a>
            &emsp;
            2.<a href="{{ route('edit-password') }}">修改密碼</a>
            &emsp;
            3.<a href="{{ route('gameNumControl') }}">期數管理</a>
            &emsp;
            4.<a href="{{ route('gameOrdersControl') }}">注單管理</a>
            &emsp;
            5.<a href="{{ route('userSearchControl') }}">會員輸贏金額查詢</a>
    </body>
</html>