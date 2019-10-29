@extends('layouts.layout')
@section('title','分类列表')
@section('content')
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类列表</title>
</head>
<body>
<table border="1" class="table table-bordered">
    <tr>
        <td>分类ID</td>
        <td>分类名称</td>
        <td>父级ID</td>
    </tr>
    @foreach($data as $v)
        <tr>
            <td>{{$v->cat_id}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->pid}}</td>
        </tr>
    @endforeach
</table>
@section('bottom')
@endsection
</body>
</html>