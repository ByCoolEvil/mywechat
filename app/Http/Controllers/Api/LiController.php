<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');
        $sign = $request->input('sign');
        if(empty($name) || empty($age)){
            return json_encode(['ret'=>0,'msg'=>'参数不能为空']);
        }
        if(empty($sign)){
            return json_encode(['ret'=>201,'msg'=>'签名没传']);
        }
        $mySign = md5("1902a".$name.$age); // 自己生成的签名
        if($mySign != $sign){
            return json_encode(['ret'=>201,'msg'=>'签名错误']);
        }

        $res = \DB::table('te')->insert([
            'name' => $name,
            'age' => $age,
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'添加异常']);
        }
    }
//    讲师的接口
    public function li(Request $request)
    {
        $url = "http://wym.yingge.fun/api/user/test";
        $name = "李乔盟";
        $age = "20";
        $mobile = "18617594655";
        $rand = rand(1000,9999);
        $sign = sha1("1902age={$age}&mobile={$mobile}&name={$name}&rand={$rand}");
        $url .="?name={$name}&age={$age}&rand={$rand}&mobile={$mobile}&sign={$sign}";
//        dd($url);
        $data = file_get_contents($url);
        var_dump($data);
    }
//    自己的接口，访问超时
    public function test()
    {
        $url = "http://www.mywechat.com/api/li/store";
        $name = "张三";
        $age = "22";
        $sign = md5("1902a".$name.$age);
        $url .= "?name={$name}&age={$age}&sign={$sign}";
        $data = file_get_contents($url);
        var_dump($data);die;
    }
}