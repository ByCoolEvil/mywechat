@extends('layouts.layout')
@section('title','数据类型列表')
@section('content')
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>数据类型列表</title>
</head>
<body>
<table border="1" class="table table-bordered">
    <tr>
        <td>类型ID</td>
        <td>类型名称</td>
        <td>属性数</td>
        <td>操作</td>
    </tr>
    @foreach($data as $k => $v)
        <tr>
            <td>{{$v["type_id"]}}</td>
            <td>{{$v["type_name"]}}</td>
            <td>{{$v->count[$k]}}</td>
            <td>
                <a href="{{url("admins/get_list")}}">属性列表</a>
            </td>
        </tr>
    @endforeach
</table>
@section('bottom')
@endsection
</body>
</html>