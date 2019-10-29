@extends('layouts.layout')
@section('title','商品添加')
@section('content')
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品属性添加</title>
</head>
<body>
<form action="{{url('admins/type_do_add')}}" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">商品属性</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="type_name" id="type" placeholder="商品属性">
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
</body>
</html>