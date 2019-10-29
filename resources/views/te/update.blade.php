@extends('layouts.layout')
@section('title','修改')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
@endsection
<body>
    <table class="table table-bordered">
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>年龄</td>
            <td><input type="text" name="age"></td>
        </tr>
        <tr>
            <td><button type="submit" class="btn btn-success" id="update">修改</button></td>
        </tr>
    </table>
    @section('bottom')
    @endsection
    <script src="{{asset('/layui/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript">
        function getQueryString(name){
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if(r!=null)return  unescape(r[2]); return null;
        }
        var url = 'http://www.mywechat.com/api/user';
        var id = getQueryString('id');
//        alert(id);
        $.ajax({
            url:url+"/"+id,
            dataType:'json',
            success:function(res){
                // console.log(res.data);
                // alert(res.data.id)
                $('[name="name"]').val(res.data.name);
                $('[name="age"]').val(res.data.age);
            }
        });
        $('#update').click(function() {
            var id=getQueryString('id');
            var name = $("[name='name']").val();
            var age = $("[name='age']").val();
            // alert(name)
            $.ajax({
//                url:'http://www.mywechat.com/api/te/update',
                url:url+"/"+id,
                type:'POST', // _method = "PUT"
                data:{name:name,age:age,"_method":"PUT"},
                dataType:'json',
                success:function(res){
                    if (res.code = 1) {
                        alert(res.msg)
                        location.href='show';
                    };
                }
            });
        });
    </script>
</body>
</html>