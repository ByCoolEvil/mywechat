@extends('layouts.layout')
@section('title','接口登录添加')
@section('content')
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>token登录</title>
</head>
<body>
<form action="{{url('api/login/login')}}" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">用户名</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="username" id="username" placeholder="用户名">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">密码</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="password" id="password" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-1">
            <button type="submit" id="sub" class="btn btn-success">添加</button>
        </div>
    </div>
</form>
@section('bottom')
@endsection
<script src="{{asset('layui/jquery-3.3.1.min.js')}}"></script>
<script>
    $("#sub").on('click',function(){
        var username = $("#username").val();
        var password = $("#password").val();
        $.ajax({
            url:"{{url('api/login/login')}}",
            data:{username:username,password:password},
            dataType:"json",
            success:function(res){
                console.log(res);
            }
        });
    });
</script>
</body>
</html>