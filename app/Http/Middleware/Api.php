<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class Api
{
    public function handle($request, Closure $next)
    {
        //后台设置跨域
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:POST");
        header("Access-Control-Allow-Headers:x-request-with,content-type");

        // 接口防刷处理
        // 根据ip做防刷

        // 获取到ip php如何获取客户端ip
        $ip = $_SERVER['REMOTE_ADDR'];  // 获取当前ip
//        var_dump($ip);die;
        // 记录当前ip 在1分钟访问了接口多少次
        $cache_name = "pass_time_".$ip;
//        var_dump($cache_name);die;
//         上一次访问多少次
        $num = Cache::get($cache_name);
//        var_dump($num);die;
        if(!$num){
            $num = 0;
        }
//         判断多长时间之内访问大于20次停止访问
        if($num >= 30){
            // ip记录到文件 服务器端配置屏蔽某个ip
            echo json_encode([
                'ret' => 201,
                'msg' => "访问过于频繁，请稍后再试"
            ]);die;
        }
        // 访问一次之后次数+1
        $num += 1;
//        echo $num;
//        数字指多长时间之后才能再次访问，以秒开始计算的
        Cache::put($cache_name,$num,30);
        return $next($request);
    }
}