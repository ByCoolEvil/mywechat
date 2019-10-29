<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="refresh" />
    <link rel="shortcut icon"> <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
@yield('content')
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <!-- 全局js -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/plugins/layer/layer.min.js')}}"></script>
    <script></script>
    <!-- 自定义js -->
    <script src="{{asset('js/hAdmin.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
    <!-- 第三方插件 -->
<div style="text-align:center;">
</div>
</body>
</html>
@yield('bottom')