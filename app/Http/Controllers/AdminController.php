<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tools\Tools;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    /*
     * 前台登录
     */
    public function login()
    {
        return view('admin/login');
    }
    /*
     * 前台登录执行
     */
    public function do_login(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $req = $request->all();
        $code = $redis->get('code');
        if($code && $req['code']!=$code){
            return ['msg'=>'验证码不正确或已过期'];
        }
        $result = DB::table('login')->where(['username'=>$req['username'],'password'=>$req['password']])->first();

        if($result){
            return redirect('/admin/index');
        }else{
            dd('用户名或密码错误');
        }
    }
    /*
     * 发送验证码
     */
    public function send(Request $request)
    {
        //链接reids
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        // 接收用户名和密码
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
        $username = $request->username;
        $password = $request->password;
        //获取token
        $token = $this->tools->get_wechat_access_token();
        //获取用户信息
        $userinfo = DB::table('login')->where(['username'=>$username])->first();
        $userinfo = collect($userinfo)->toArray();

        $code = rand(1000,9999);  // 验证码
        $redis->setex('code',180,$code);   #存redis
        $time = time();
        $data = [
            'touser'=>$userinfo['openid'],
            'template_id'=>'dyOImp_C9TJozQ_JEVSqqATlksP0Rt8VVJqG4XxuR3g',
            'url'=>'http://www.mywechat.com',
            'data' => [
                'code' => [
                    'value' => $code,
                    'color' => '',
                ],
                'name' => [
                    'value' => $userinfo['username'],
                    'color' => '',
                ],
                'time' => [
                    'value' => date('Y-m-d:H:i:s',time()),
                    'color' => '',
                ],
            ],
        ];
        $re = $this->tools->curl_post($url,json_encode($data));
        $info = [
            'username'=>$userinfo['username'],
            'code'=>$code,
            'time'=>$time
        ];
        $res = DB::table('code')->insert($info);
        dd($res);
    }
    /*
     * 绑定账号菜单
     */
    public function bang()
    {
        return view('/admin/bang');
    }
    /*
     * 执行绑定账号菜单
     */
    public function do_bang(Request $request)
    {
        $redirect_uri = 'http://www.mywechat.com/admin/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
    /*
     * 接收code
     */
    public function code(Request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        $re = json_decode($result,1);
    }
    /*
     * 后台首页
     */
    public function index()
    {
        return view('admin/index');
    }
    /*
     * Bootstrap 网站样式
     */
    public function a()
    {
        return view('admin/a');
    }

}
