<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Model\Curl;

class PortController extends Controller
{
    const news_key = "101d0236f5f9419fbbbbdd3fcc492d66";
    public function test()
    {
//        函数指定了当前所在php脚本的执行时间为100秒
//        set_time_limit(100);
//        搜索关键字从新闻热点里
        $url = "http://api.avatardata.cn/ActNews/LookUp?key=".self::news_key;
        $hotData = Curl::get($url);
        $hotData = json_decode($hotData,true);
        $keywordArr = []; // 热点
        // 循环取40个热点
        for($i=0; $i <= 40; $i++){
            $keywordArr[] = $hotData['result'][$i];
        }
//        var_dump($keywordArr);die;

//        要搜索的关键字
//        $keywordArr = ['奥巴马','王者荣耀','英雄联盟','灵魂摆渡','盗墓笔记'];
//        通过关键字   循环执行调用接口
        foreach($keywordArr as $k => $v){
            $url = "http://api.avatardata.cn/ActNews/Query?key=".self::news_key."&keyword=".$v;
//            发送get请求
            $data = Curl::get($url);
            $data = json_decode($data,true);
//            存储到数据库
//            如果返回的数据不为空
            if(!empty($data['result'])){
                // 循环数据入库
                foreach ($data['result'] as $key => $value){
//                    重复新闻不要入库    通过新闻标题  查询数据库
                    $newsData = News::where(['title'=>$value['title']])->first();
                    if(!$newsData){
                        // 添加入库
                        News::create([
                            'title' => $value['title'],
                            'content' => $value['content'],
                        ]);
                    }
                }
            }
        }


    }


}