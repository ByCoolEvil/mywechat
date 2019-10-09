<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use App\Tools\Tools;

class WechatController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    public function user_weixin($openid)
    {
        $access_token = $this->tools->get_access_token();
        $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
        $user_info = json_decode($wechat_user,1);
        return $user_info;
    }

//    jssdk获取地理位置
    public function location(Request $request)
    {
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $jsapi_ticket = $this->tools->get_wechat_jsapi_ticket();
        $timestamp = time();
        $nonceStr = rand(1000,9999).'suibian';
        $sign_str = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$url;
        $signature = sha1($sign_str);

        return view('wechat/location',['nonceStr'=>$nonceStr,'timestamp'=>$timestamp,'signature'=>$signature]);
    }

    /*
     * 调用频次清0
     */
    public function clear_api(){
        $url = 'https://api.weixin.qq.com/cgi-bin/clear_quota?access_token='.$this->get_wechat_access_token();
        $data = ['appid'=>env('WECHAT_APPID')];
        $this->curl_post($url,json_encode($data));
    }
    /*
     * 微信素材管理页面
     */
    public function wechat_source(Request $request,Client $client)
    {
        $req = $request->all();
        empty($req['source_type'])?$source_type = 'image':$source_type=$req['source_type'];
        if(!in_array($source_type,['image','voice','video','thumb'])){
            dd('类型错误');
        }
        if($req['page'] <= 0 ){
            dd('页码错误');
        }
        empty($req['page'])?$page = 1:$page=$req['page'];
        if($page <= 0 ){
            dd('页码错误');
        }
        $pre_page = $page - 1;
        $pre_page <= 0 && $pre_page = 1;
        $next_page = $page + 1;
        $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->get_wechat_access_token();
        $data = [
            'type' =>$source_type,
            'offset' => $page == 1 ? 0 : ($page - 1) * 20,
            'count' => 20
        ];
        dd($data);
        $re = $this->tools->redis->get('source_info');
//        dd($re);
        //$re = $this->curl_post($url,json_encode($data));
        $info = json_decode($re,1);
        $media_id_list = [];
        foreach($info['item'] as $v){
            $media_id_list[] = $v['media_id'];
        }
        $source_info = DB::connection('mysql_wechat')->table('wechat_source')->whereIn('media_id',$media_id_list)->get();
        //dd($source_info);
        return view('Wechat.source',['info'=>$source_info,'pre_page'=>$pre_page,'next_page'=>$next_page,'source_type'=>$source_type]);
    }
    public function download_source(Request $request)
    {
        $req = $request->all();
        $source_info = DB::connection('mysql_wechat')->table('wechat_source')->where(['id'=>$req['id']])->first();
        $source_arr = [1=>'image',2=>'voice',3=>'video',4=>'thumb'];
        $source_type = $source_arr[$source_info->type]; //image,voice,video,thumb
        //素材列表
        //$media_id = 'dcgUiQ4LgcdYRovlZqP88RB3GUc9kszTy771IOSadSM'; //音频
        //$media_id = 'dcgUiQ4LgcdYRovlZqP88dUuf1H6G4Z84rdYXuCmj6s'; //视频
        $media_id = $source_info->media_id;
        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$this->tools->get_wechat_access_token();
        $re = $this->tools->curl_post($url,json_encode(['media_id'=>$media_id]));
        if($source_type != 'video'){
            Storage::put('wechat/'.$source_type.'/'.$source_info->file_name, $re);
            DB::connection('mysql_wechat')->table('wechat_source')->where(['id'=>$req['id']])->update([
                'path'=>'/storage/wechat/'.$source_type.'/'.$source_info->file_name,
            ]);
            dd('ok');
        }
        $result = json_decode($re,1);
        //设置超时参数
        $opts=array(
            "http"=>array(
                "method"=>"GET",
                "timeout"=>3  //单位秒
            ),
        );
        //创建数据流上下文
        $context = stream_context_create($opts);
        //$url请求的地址，例如：
        $read = file_get_contents($result['down_url'],false, $context);
        Storage::put('wechat/video/'.$source_info['file_name'], $read);
        DB::connection('mysql_wechat')->table('wechat_source')->where(['id'=>$req['id']])->update([
            'path'=>'/storage/wechat/'.$source_type.'/'.$source_info->file_name,
        ]);
        dd('ok');
        //Storage::put('file.mp3', $re);
    }
    public function curl_post($url,$data)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $data = curl_exec($curl);
        $errno = curl_errno($curl);  //错误码
        $err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }
    /*
     * curl上传微信素材
     */
    public function curl_upload($url,$path)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        $form_data = [
            'media' => new \CURLFile($path)
        ];
        curl_setopt($curl,CURLOPT_POSTFIELDS,$form_data);
        $data = curl_exec($curl);
        // $errno = curl_errno($curl);  //错误码
        // $err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }
    public function post_test()
    {
        dd($_POST);
    }
//    获取用户列表
    public function get_user_list()
    {
//        获取用户列表接口
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->get_wechat_access_token().'&next_openid=');
        $re = json_decode($result,1);
        $last_info = [];
        foreach($re['data']['openid'] as $k=>$v){
//            获取用户基本信息接口
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            $user = json_decode($user_info,1);
            $last_info[$k]['nickname'] = $user['nickname'];
            $last_info[$k]['openid'] = $v;
        }
        dd($last_info);

        return view('wechat.userList',['info'=>$re['data']['openid']]);
    }
//    推送模板消息
    public function push_template_message()
    {
        $openid = 'ofv_zwfA4aRgwzVxwa1ScfWFkNPU';
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->get_wechat_access_token();
        $data = [
            'touser'=>$openid,
            'template_id'=>'9P4CVdJStkHtkXUybmbQBm7dUPCv1qi0MbFSC4MM4fQ',
            'url'=>'http://www.mywechat.com',
            'data' => [
                'first' => [
                    'value' => '消息',
                    'color' => '',
                ],
                'keyword1' => [
                    'value' => '阿伟已经死了',
                    'color' => '',
                ],
                'keyword2' => [
                    'value' => '你挑的偶像嘛',
                    'color' => '',
                ],
            ],
        ];
//        json_encode转换为字符串
        $re = $this->tools->curl_post($url,json_encode($data));
//        json_decode true为数组,false为对象,默认为false
        $result = json_decode($re,1);
        dd($result);
    }
//    获取access_token
    public function get_access_token()
    {
        return $this->get_wechat_access_token();
    }
    public function get_wechat_access_token()
    {
//        cmd-----redis-cli-----MONITOR监听
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
//        加入缓存
        $access_token_key = 'wechat_access_token';
        if($redis->exists($access_token_key)){
//            存在
            return $redis->get($access_token_key);
        }else{
//            不存在
//            获取Access_token接口
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
            $re = json_decode($result,1);
            $redis->set($access_token_key,$re['access_token'],$re['expires_in']); //加入缓存
            return $re['access_token'];
        }
    }
}