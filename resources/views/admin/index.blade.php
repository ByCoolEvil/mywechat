<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>主页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="refresh" content="" />
    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css" rel="stylesheet')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs" style="font-size:20px;">
                                    <i class="fa fa-area-chart"></i>
                                    <strong class="font-bold">hAdmin</strong>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">hAdmin
                    </div>
                </li>
                <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                    <span class="ng-scope">分类</span>
                </li>
                <li>
                    <a class="J_menuItem" href="javascript:;">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">接口测试</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/te/add">接口测试添加</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/te/show">接口测试展示</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">分类模块</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/cate_add">分类添加</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/cate_list">分类列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">商品类型模块</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/type_add">商品类型添加</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/type_index">商品类型列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">商品模块</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/goods_add">商品添加</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">属性模块</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/get_add">属性添加</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="http://www.mywechat.com/admins/get_list">属性列表</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        {{--<div class="row border-bottom">--}}
            {{--<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">--}}
                {{--<div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>--}}
                    {{--<form role="search" class="navbar-form-custom" method="post" action="search_results.html">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<ul class="nav navbar-top-links navbar-right">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-envelope"></i> <span class="label label-warning">16</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-messages">--}}
                            {{--<li class="m-t-xs">--}}
                                {{--<div class="dropdown-messages-box">--}}
                                    {{--<a href="profile.html" class="pull-left">--}}
                                        {{--<img alt="image" class="img-circle" src="{{asset('img/a7.jpg')}}">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<small class="pull-right">46小时前</small>--}}
                                        {{--<strong>小四</strong> 是不是只有我死了,你们才不骂爵迹--}}
                                        {{--<br>--}}
                                        {{--<small class="text-muted">3天前 2014.11.8</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="dropdown-messages-box">--}}
                                    {{--<a href="profile.html" class="pull-left">--}}
                                        {{--<img alt="image" class="img-circle" src="{{asset('img/a4.jpg')}}">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body ">--}}
                                        {{--<small class="pull-right text-navy">25小时前</small>--}}
                                        {{--<strong>二愣子</strong> 呵呵--}}
                                        {{--<br>--}}
                                        {{--<small class="text-muted">昨天</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a class="J_menuItem" href="mailbox.html">--}}
                                        {{--<i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-bell"></i> <span class="label label-primary">8</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-alerts">--}}
                            {{--<li>--}}
                                {{--<a href="mailbox.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-envelope fa-fw"></i> 您有16条未读消息--}}
                                        {{--<span class="pull-right text-muted small">4分钟前</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<a href="profile.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-qq fa-fw"></i> 3条新回复--}}
                                        {{--<span class="pull-right text-muted small">12分钟钱</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a class="J_menuItem" href="notifications.html">--}}
                                        {{--<strong>查看所有 </strong>--}}
                                        {{--<i class="fa fa-angle-right"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</nav>--}}
        {{--</div>--}}
        <div class="row J_mainContent" id="content-main">
            <iframe id="J_iframe" class="J_iframe" width="100%" height="100%" src="/index_v1.html" frameborder="0" data-id="index_v1.html" seamless></iframe>
        </div>
    </div>
    <!--右侧部分结束-->
</div>

<!-- 全局js -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('js/plugins/layer/layer.min.js')}}"></script>

<!-- 自定义js -->
<script src="{{asset('js/hAdmin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>

<!-- 第三方插件 -->
{{--<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>--}}
{{--<div style="text-align:center;">--}}
    {{--<p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>--}}
{{--</div>--}}
</body>
</html>