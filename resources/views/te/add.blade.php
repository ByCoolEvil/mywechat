@extends('layouts.layout')
@section('title','添加')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
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
            <td>文件上传</td>
            <td><input type="file" name="photo"></td>
        </tr>
        <tr>
            <td><button type="submit" class="btn btn-success" id="add">添加</button></td>
        </tr>
    </table>
    @section('bottom')
    @endsection
    <script src="{{asset('/layui/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var url = 'http://www.mywechat.com/api/te/add';
        $("#add").on('click',function(){
             var name = $("[name='name']").val();
             var age = $("[name='age']").val();
//            文件上传
             var fd = new FormData();// 生成一个空表单
//            [0]. 是下标
//            files[0] 是属性
             fd.append('photo',$("[name='photo']")[0].files[0]);// 追加一个图片
//             追加到表单里面
             fd.append('name',name);
             fd.append('age',age);

             $.ajax({
                 url:url,
                 type:"POST",
                 data:fd,
                 dataType:'json',
//                 如果是带图片添加的必须加上下面的处理代码
                 contentType:false, //post数据类型 unlencode
                 processData:false, //处理数据
                 success:function(res){
                    if(res.ret == 1){
                        alert(res.msg);
                        location.href = "http://www.mywechat.com/te/show";
                    }else{
                        alert(res.msg);
                    }
                 }
             });
        });
    </script>
</body>
</html>