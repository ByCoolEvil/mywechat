<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:Api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('post_test','WechatController@post_test');

Route::any('/event/event','EventController@event'); //接收微信发送的消息