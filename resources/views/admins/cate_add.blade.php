@extends('layouts.layout')
@section('title','添加')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类添加</title>
</head>
@endsection
<body>
<form action="{{url('admins/cate_do_add')}}" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">分类名称</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="c_name" id="cate" placeholder="分类名称"><span id="span"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">顶级分类</label>
        <div class="col-sm-2">
            <select name="pid" class="form-control">
                <option value="0">无父类</option>
                @foreach($data as $v)
                    <option value="{{$v->cat_id}}">{{$v->c_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-4">
            <button type="submit" id="submit" class="btn btn-success">添加</button>
        </div>
    </div>
</form>
@section('bottom')
@endsection
<script src="{{asset('layui/jquery-3.3.1.min.js')}}"></script>
<script>
    $('#cate').blur(function(){
        var c_name=$(this).val();
//         alert(c_name);
        $.get(
            "{{url('admins/cate_check')}}",
            {c_name:c_name},
            function(res){
                // console.log(res);
                if(res==0){
                    $('#span').html('该分类已存在');
                    $('#submit').attr('disabled','true');

                }else{
                    $('#span').html('');
                    $('#submit').removeAttr('disabled');
                }
            }
        );
    });
</script>
</body>
</html>