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

Route::get('/wechat/clear_api','WechatController@clear_api'); //频次清0
Route::get('/wechat/source','WechatController@wechat_source'); //素材管理
Route::get('/wechat/download_source','WechatController@download_source'); //下载资源

Route::get('/wechat/push_template_message','WechatController@push_template_message'); //推送模板消息

Route::get('/we/login','WeController@login'); //微信网页授权
Route::get('/we/wechat_login','WeController@wechat_login'); //微信登录
Route::get('/we/code','WeController@code'); //获取code

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


//调用登录中间件
Route::group(['middleware'=>['login']],function(){
    Route::get('/liuyan/index','LiuYanController@index');//留言板主页
    Route::get('/liuyan/send','LiuYanController@send');//留言
    Route::post('/liuyan/do_send','LiuYanController@do_send');//执行留言
});