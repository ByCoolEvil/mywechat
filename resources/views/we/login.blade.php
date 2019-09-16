<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微信授权登录</title>
</head>
<body>
<center>
        用户名：<input type="text"><br/>
        密码：<input type="password"><br/>
        第三方登录：<button id="but" type="button">微信授权登录</button>
</center>
<script src="{{asset('mstore/js/jquery.min.js')}}"></script>
<script>
    $(function(){
        $('#but').click(function(){
            window.location.href="{{url('we/wechat_login')}}";
        });
    });
</script>
</body>
</html>