<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        if ($request->isMethod('post')) {
            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
            $city = $request->city;
            $data = $redis->get('city:'.$city);
            $url = "http://api.k780.com:88/?app=weather.future&weaid={$city}&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
            if ($data) {
                echo '查询天气成功';
                dd($data);
                return view('admins.weather');
            } else{
                $re = file_get_contents($url);
                $redis->setex('city:' . $city, 7200, $re);
                echo '存入天气成功';
                dd($re);
            }
        }
    }
}
