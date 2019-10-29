@extends('layouts.layout')
@section('title','商品属性列表')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品属性列表</title>
</head>
<body>
    <form action="{{url('admins/get_list')}}" method="get">
        属性名称:<input type="text" name="attr_name" id="">
        <input type="submit" value="搜索">
        <br/>
    </form>
<table border="1" class="table table-bordered">
    <tr>
        <td><input type="checkbox" id="xuan">选择</td>
        <td>ID</td>
        <td>属性名称</td>
        <td>是否可选</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
        <tr class="tr" id="{{$v->attr_id}}">
            <td><input type="checkbox" class="check"></td>
            <td>{{$v->attr_id}}</td>
            <td>{{$v->attr_name}}</td>
            <td>
                @if($v->attr_type==1)
                    是
                @else
                    否
                @endif
            </td>
            <td>
                <a href="{{url('admins/get_del')}}?attr_id={{$v->attr_id}}">删除</a>
            </td>
        </tr>
    @endforeach
    <td>
        <a href="" id="pi">批删</a>
    </td>
</table>
<div align="center">
     <td colspan="3">{{$data->appends(['attr_name'=>$attr_name])->links()}}</td>
</div>
</body>
</html>
@section('bottom')
@endsection
<script src="{{asset('layui/jquery-3.3.1.min.js')}}"></script>
    <script>
    $('#xuan').on('click',function(){
        // alert(111);
        var data=$(this).prop('checked');
        // alert(data);
        $('.check').prop('checked',data);
    })
    $('#pi').on('click',function(){
//         alert(111);
        var tr = $('.check:checked]' +
            '' +
            '');
//         console.log(tr);return false;
        var arr = new Array();
        tr.each(function(){
            var data = $(this).prop('checked');
            // console.log(data);
            var id = $(this).parents('.tr').attr('id');
            // console.log(id);
            arr.push(id);
        });
        location.href="{{url('admins/get_trundle')}}?arr="+arr;
        return false;
    })
</script>