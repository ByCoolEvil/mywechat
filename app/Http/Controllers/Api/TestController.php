<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Tools\Aes;
use App\Tools\Rsa;

class TestController extends Controller
{
    // 调用接口
    public function test()
    {
        // 调用接口
        $name = "张三";
        $phone = "123xxxxx789";

        //举个粒子
        $Rsa = new Rsa();
//         $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
//         p($keys);die;
        $privkey = file_get_contents("cert_private.pem");//$keys['privkey'];
        $pubkey  = file_get_contents("cert_public.pem");//$keys['pubkey'];
        //echo $privkey;die;
        //初始化rsaobject
        $Rsa->init($privkey, $pubkey,TRUE);

        //原文
        $data = '学习PHP太开心了';
        //私钥加密示例
        $encode = $Rsa->priv_encode($data);
        echo $encode;
        echo "<hr>";
        $ret = $Rsa->pub_decode($encode);
        echo $ret;


//        // 对手机号字段进行加密处理
//        $key = ""; // 把密钥放到配置文件里
//        $obj = new Aes($key);
//        // 调用加密方法
//        $phone = $obj->encrypt();
//
//        $url = "xxx?name={$name}&phone={$phone}";
//        $data = file_get_contents($url);
//        // 自己开发的接口
    }
    public function weather()
    {
        $city = request("city");
        if(!isset($city)){
            $city = "北京";
        }

        // 有缓存  读缓存
        $cache_key = "weather_data_".$city;
        $data = Cache::get($cache_key);
        if(empty($data)){
            echo '接口查询';
            // 没有缓存 调用k780天气接口  存入缓存里
            $url = "http://api.k780.com:88/?app=weather.future&weaid={$city}&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
            $data = file_get_contents($url);
//            获取当天24点的时间
            $date = date("Y-m-d"); // 2019-10-14    00:00:00
            $time24 = strtotime($date)+86400; // 把格式化时间转换成时间戳
//            获取当前时间
            $cache_time = $time24 - time();
//            weather_data：键名
            Cache::put($cache_key,$data,$cache_time); // 10分钟
//            只缓存到当天凌晨

        }

        return $data;
    }
}