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
    <center>
        <form action="{{url('/tag/do_add_tag')}}" method="post">
            @csrf
            标签名：<input type="text" name="tag_name" value=""><br/><br/>
            <input type="submit" value="提交">
        </form>
    </center>
</body>
</html>