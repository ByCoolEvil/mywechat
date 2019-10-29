@extends('layouts.layout')
@section('title','展示')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示页面</title>
</head>
@endsection
<a href="http://www.mywechat.com/te/add" class="btn btn-primary btn-lg active">添加页面</a>
<body style="margin-left:1%;margin-right:1%;margin-top:1%;">
    用户名:<input type="text" name="name">
    <input type="button" value="搜索" id="search">
    <table class="table table-bordered">
        <tr>
            <td>ID</td>
            <td>姓名</td>
            <td>年龄</td>
            <td colspan="2">操作</td>
        </tr>
        <tbody id="list">

        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{--<li>--}}
                {{--<a href="#" aria-label="Previous">--}}
                    {{--<span aria-hidden="true">&laquo;</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li><a href="#">1</a></li>--}}
            {{--<li><a href="#">2</a></li>--}}
            {{--<li><a href="#">3</a></li>--}}
            {{--<li><a href="#">4</a></li>--}}
            {{--<li><a href="#">5</a></li>--}}
            {{--<li>--}}
                {{--<a href="#" aria-label="Next">--}}
                    {{--<span aria-hidden="true">&raquo;</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </nav>
    @section('bottom')
    @endsection
    <script src="{{asset('/layui/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript">
        var url = 'http://www.mywechat.com/api/user';
        // 获取页码 val html text <div><p>1</p></div>
//         var page = $(this).text();
        // alert(page);return;
        $.ajax({
            url:url,
            dataType:'json',
            type:'GET',
//            data:{page:page},
            success:function(res){
                showData(res);
            }
        });

        // 分页功能 所有js动态渲染的节点 document绑定
        $(document).on('click','.pagination a',function(){
            //禁止a标签跳转事件 event.preventDefault();
            //获取搜索内容
            var name = $("[name='name']").val();
            //获取页码 val html text <div><p>1</p></div>
            var page = $(this).text();
            // alert(page);return;
            $.ajax({
                url:url,
                dataType:'json',
                type:'GET',
                data:{page:page,name:name},
                success:function(res){
                    showData(res);
                }
            });
        });

        $('#search').on('click',function(){
            //获取搜索内容
            var name = $("[name='name']").val();
            //发送请求
            $.ajax({
                url:url,
                dataType:'json',
                type:'GET',
                data:{name:name},
                success:function(res){
                    //渲染页面
                    showData(res);
                }
            });
        });

        /*
            根据后台数据，渲染表格数据
         */
        function showData(res)
        {
            //页面数据渲染
            $('#list').empty();
            $.each(res.data.data,function(k,v){
                var tr = $('<tr></tr>');
                tr.append('<td>'+v.id+'</td>');
                tr.append('<td>'+v.name+'</td>');
                tr.append('<td>'+v.age+'</td>');
                tr.append('<td><img src="/app/'+v.file+'" height="60px" width="60px"></td>');
                tr.append("<td><a href='http://www.mywechat.com/te/update?id="+v.id+"' class='btn btn-danger'>修改</a></td>");
                tr.append("<td><a href='http://www.mywechat.com/api/te/delete?id="+v.id+"' class='btn btn-success'>删除</a></td>");
                $('#list').append(tr);
                // console.log(res);
            });
            // 页面分页页码渲染
            var max_page = res.data.last_page;
            $('.pagination').empty();
            for (var i = 1;i <= max_page; i++){
                var li = "<li><a href='javascript:;'>"+i+"</a></li>";
                $('.pagination').append(li);
            }
        }
    </script>
</body>
</html>