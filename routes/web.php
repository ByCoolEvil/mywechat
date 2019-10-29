<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wechat/get_access_token','WechatController@get_access_token'); //获取access_token
Route::get('/wechat/get_user_list','WechatController@get_user_list'); //获取用户列表

Route::get('/wechat/user_weixin','WechatController@user_weixin');

Route::get('/wechat/clear_api','WechatController@clear_api'); //频次清0
Route::get('/wechat/source','WechatController@wechat_source'); //素材管理
Route::get('/wechat/download_source','WechatController@download_source'); //下载资源

Route::get('/wechat/push_template_message','WechatController@push_template_message'); //推送模板消息

Route::get('/wechat/location','WechatController@location'); //jssdk获取地理位置

Route::get('/we/login','WeController@login'); //微信网页授权
Route::get('/we/wechat_login','WeController@wechat_login'); //微信登录
Route::get('/we/code','WeController@code'); //获取code

Route::get('/wx/login','WxController@login'); //微信网页授权
Route::get('/wx/wechat_login','WxController@wechat_login'); //微信登录
Route::get('/wx/code','WxController@code'); //获取code

Route::get('/upload/upload','UploadController@upload'); //上传文件
Route::post('/upload/do_upload','UploadController@do_upload'); //执行上传文件

Route::get('/tag/add_tag','TagController@add_tag'); //添加标签
Route::post('/tag/do_add_tag','TagController@do_add_tag'); //执行添加标签
Route::get('/tag/tag_list','TagController@tag_list'); //标签列表
Route::get('/tag/tag_delete','TagController@tag_delete'); //删除标签
Route::get('/tag/tag_openid_list','TagController@tag_openid_list'); //标签下用户的openid列表
Route::post('/tag/tag_openid','TagController@tag_openid'); //为用户打标签
Route::get('/tag/user_tag_list','TagController@user_tag_list'); //用户下的标签列表
Route::get('/tag/push_tag_message','TagController@push_tag_message'); //推送标签消息
Route::post('/tag/do_push_tag_message','TagController@do_push_tag_message'); //执行推送标签消息
//留言+注册登录
Route::get('/liuyan/wechat_login','LiuYanController@wechat_login');//微信登录
Route::get('/liuyan/wechat_code','LiuYanController@wechat_code');//接收code
Route::get('/liuyan/login','LiuYanController@login');//页面登录
Route::post('/liuyan/do_login','LiuYanController@do_login');//执行页面登录
Route::get('/liuyan/do_del','LiuYanController@do_del');//删除留言
//菜单
Route::post('/menu/create_menu','MenuController@create_menu'); //创建菜单
Route::get('/menu/menu_list','MenuController@menu_list'); //菜单列表
Route::get('/menu/load_menu','MenuController@load_menu'); //刷新菜单
Route::get('/menu/del_menu','MenuController@del_menu'); //删除菜单
// -------------------------------------------------------------------------------------------------------------
Route::prefix('/admin')->group(function(){
    Route::get('/index','AdminController@index');// 后台页面
    Route::any('/login','AdminController@login');// 登录
    Route::any('/do_login','AdminController@do_login');// 执行登录
    Route::any('/send','AdminController@send');// 发送验证码
    Route::get('/a','AdminController@a');// Bootstrap 网站样式
    Route::get('/bang','AdminController@bang');// 绑定账号菜单
    Route::get('/do_bang','AdminController@do_bang');// 执行绑定账号菜单
    Route::get('/code','AdminController@code'); //获取code
});

// 接口测试添加页面
Route::get('/te/add',function(){
    return view('te.add');
});
// 接口测试展示页面
Route::get('/te/show',function(){
    return view('te.show');
});
// 接口测试修改页面
Route::get('/te/update',function(){
    return view('te.update');
});
// 测试接口
Route::any('/api/te/add','Api\TeController@add'); // 接口测试添加
Route::any('/api/te/show','Api\TeController@show'); // 接口测试展示
Route::any('/api/te/find','Api\TeController@find'); // 接口测试查询
Route::any('/api/te/update','Api\TeController@update'); // 接口测试修改
Route::any('/api/te/delete','Api\TeController@delete'); // 接口测试删除
Route::any('/api/test/weather','Api\TestController@weather'); // 接口天气预报
Route::any('/api/test/test','Api\TestController@test'); //公钥密钥

Route::any('/api/li/store','Api\LiController@store');
Route::any('/api/li/test','Api\LiController@test');
Route::any('/api/li/li','Api\LiController@li');

// 资源控制器
Route::resource('/api/user','Api\UserController'); // 查询数据

Route::prefix('/admins')->group(function(){
    Route::get('/cate_add','Admin\CategoryController@cate_add'); // 商品分类添加
    Route::post('/cate_do_add','Admin\CategoryController@cate_do_add'); // 执行商品分类添加
    Route::get('/cate_check','Admin\CategoryController@cate_check'); // 商品分类查询字段是否重复
    Route::get('/cate_list','Admin\CategoryController@cate_list'); // 商品分类列表

    Route::get('/type_add','Admin\CategoryController@type_add'); // 数据类型
    Route::post('/type_do_add','Admin\CategoryController@type_do_add'); // 添加数据类型
    Route::get('/type_index','Admin\CategoryController@type_index'); // 数据类型列表

    Route::get('/goods_add','Admin\CategoryController@goods_add'); // 商品添加
    Route::post('/goods_do_add','Admin\CategoryController@goods_do_add'); // 执行商品添加

    Route::get('/get_add','Admin\CategoryController@get_add'); // 添加商品属性
    Route::post('/get_do_add','Admin\CategoryController@get_do_add'); // 执行添加商品属性
    Route::get('/get_list','Admin\CategoryController@get_list'); // 商品属性列表
    Route::get('/get_del','Admin\CategoryController@get_del'); // 商品删除
    Route::get('/get_trundle','Admin\CategoryController@get_trundle'); // 商品批删
    Route::get('/getAttr','Admin\CategoryController@getAttr'); // 商品属性

    Route::get('/product/{goods_id}','Admin\CategoryController@product'); // 货品添加
    Route::post('/product_add','Admin\CategoryController@product_add'); // 执行货品添加

    Route::match(['get','post'],'getweather','Api\\WeatherController@getWeather'); // 天气接口
});
// 用户登录接口
Route::get('/login/login',function(){
    return view('login.login');
});
// 接口开发
Route::prefix('/api')->middleware('api')->namespace("Api")->group(function(){
    Route::any('/news/news','ApiController@news'); // 查询分类接口
    Route::any('/news/detail','ApiController@detail'); // 查询商品详情
    Route::any('/login/login','LoginController@login'); // 验证用户登录
    Route::any('/login/getUser','LoginController@getUser'); // 效验token令牌
        // 所有操作登录之后才能调用接口，不登录则不能调用，跳转登录接口登录
        Route::middleware('apiToken')->group(function(){
            Route::any('/login/cartAdd','LoginController@cartAdd'); // 加入购物车
            Route::any('/login/order_address','LoginController@order_address'); // 购物车查询
        });
});

// 8月考试A卷
Route::any('/api/port/test','Api\PortController@test'); // 调用Api接口




//调用登录中间件
Route::group(['middleware'=>['login']],function(){
    Route::get('/liuyan/index','LiuYanController@index');//留言板主页
    Route::get('/liuyan/send','LiuYanController@send');//留言
    Route::post('/liuyan/do_send','LiuYanController@do_send');//执行留言
});



