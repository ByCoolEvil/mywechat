<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>你好，Bootstrap！</h1>
<table class="table table-striped">
    <tr>
        <td>#</td>
        <td>一</td>
        <td>二</td>
        <td>三</td>
        <td>
            <!-- Standard button -->
            <button type="button" class="btn btn-default">默认样式</button>
        </td>
    </tr>
    <tr>
        <td>1</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
            <button type="button" class="btn btn-primary">首选项</button>
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Indicates a successful or positive action -->
            <button type="button" class="btn btn-success">成功</button>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Contextual button for informational alert messages -->
            <button type="button" class="btn btn-info">一般信息</button>
        </td>
    </tr>
    <tr>
        <td>4</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Indicates caution should be taken with this action -->
            <button type="button" class="btn btn-warning">警告</button>
        </td>
    </tr>
    <tr>
        <td>5</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Indicates a dangerous or potentially negative action -->
            <button type="button" class="btn btn-danger">危险</button>
        </td>
    </tr>
    <tr>
        <td>6</td>
        <td>123</td>
        <td>456</td>
        <td>789</td>
        <td>
            <!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
            <button type="button" class="btn btn-link">链接</button>
        </td>
    </tr>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</table>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>