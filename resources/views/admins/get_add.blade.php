@extends('layouts.layout')
@section('title','属性添加')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('admins/get_do_add')}}" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">属性名称</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="attr_name" placeholder="属性名称">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">所属类型</label>
            <div class="col-sm-4">
                <select class="form-control" name="type_id">
                    @foreach($data as $v)
                        <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">是否可选</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="attr_type" value="1" checked="checked">参数,是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="attr_type" value="2">规格,否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label"></label>
            <div class="col-sm-4">
                <button type="submit" id="submit" class="btn btn-success">添加</button>
            </div>
        </div>
    </form>
</body>
</html>
@section('bottom')
@endsection