<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>标签列表</title>
</head>
<body>
<center>
    <h1>公众号标签管理</h1>
    <a href="{{url('tag/add_tag')}}">添加标签</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{url('/wechat/get_user_list')}}">粉丝列表</a>
    <br/><br/>
    <table border="1">
        <tr>
            <td>tag_id</td>
            <td>tag_name</td>
            <td>标签下粉丝数</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>{{$v['count']}}</td>
            <td>
                <a href="{{url('/tag/tag_delete')}}?id={{$v['id']}}">删除</a> |
                <a href="{{url('/tag/tag_update')}}?id={{$v['id']}}">修改</a> |
                <a href="{{url('/tag/tag_openid_list')}}?tagid={{$v['id']}}">粉丝列表</a> |
                <a href="{{url('/tag/get_user_list')}}?tagid={{$v['id']}}">粉丝打标签</a> |
                <a href="{{url('/tag/push_tag_message')}}?tagid={{$v['id']}}">推送消息</a>
            </td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>