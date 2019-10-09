<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>菜单列表</title>
</head>
<body>
<center>
    <h2>创建菜单</h2>
    <form action="{{'/menu/create_menu'}}" method="post"><br/>
        @csrf
        一级菜单：<input type="text" name="name1"><br/><br/>
        二级菜单：<input type="text" name="name2"><br/><br/>
        菜单类型[click/view]：
        <select name="type" id="">
            <option value="1">click</option>
            <option value="2">view</option>
        </select><br/><br/>
        事件处理：<input type="text" name="event_value"><br/><br/>
        <input type="submit" value="提交">
    </form>

    <h2>菜单列表</h2>
    <table border="1">
        <tr>
            <td>name1</td>
            <td>name2</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v->name1}}</td>
            <td>{{$v->name2}}</td>
            <td><a href="{{url('menu/del_menu')}}?id={{$v->id}}">删除</a></td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>