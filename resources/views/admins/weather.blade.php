@extends('layouts.layout')
@section('title','天气查询')
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
    <form action="" method="post">
        <table>
            <tr>
                <td>查询的城市</td>
                <td><input type="text" name="city"></td>
            </tr>
            <tr>
                <td><input type="submit" name=""></td>
                <td></td>
            </tr>
        </table>
    </form>
@section('bottom')
@endsection
</body>
</html>