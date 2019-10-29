<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WeController extends Controller
{
    public function login()
    {
        return view('we/login');
    }
    /*
     * 微信登录
     */
    public function wechat_login()
    {
        $redirect_uri = 'http://www.mywechat.com/we/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
    /*
     * 接收code
     */
    public function code(Request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://Api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        $re = json_decode($result,1);
//        获取自己微信信息
        $user_info = file_get_contents('https://Api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
        $openid = $re['openid'];
        $wechat_info = DB::connection('mysql_wechat')->table('user_wechat')->where(['openid'=>$openid])->first();
        if(!empty($wechat_info)){
//            存在,登录
            $request->session()->put('uid',$wechat_info->uid);
            echo "ok1";
//            return redirect(''); //跳转主页
        }else{
//            不存在,注册,登录
            DB::connection('mysql_wechat')->beginTransaction(); //打开事务
            $uid = DB::connection('mysql_wechat')->table('user')->insertGetId([
                'name' => $wechat_user_info['nickname'],
                'password' => '',
                'reg_time' => time()
            ]);
            $insert_result = DB::connection('mysql_wechat')->table('user_wechat')->insert([
                'uid' => $uid,
                'openid' => $openid
            ]);
//            登录操作
            $request->session()->put('uid',$wechat_info->uid);
            echo "ok2";
//            return redirect(''); //跳转主页
        }


    }
}