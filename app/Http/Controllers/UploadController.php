<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use App\Tools\Tools;

class UploadController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    public function upload()
    {
        return view('upload/upload');
    }
    public function do_upload(Request $request,Client $client)
    {
//        $name = "image";
//        if(!empty($request->hasFile($name)) && request()->file($name)->isValid()){
//            $path = request()->file($name)->store('upload');
//            dd('/storage/'.$path);
//        }
        $type = $request->all()['type'];
        $source_type = '';
        switch ($type){
            case 1: $source_type = 'image';break;
            case 2: $source_type = 'voice';break;
            case 3: $source_type = 'video';break;
            case 4: $source_type = 'thumb';break;
            default;
        }
        $name = 'file_name';
        if(!empty($request->hasFile($name)) && request()->file($name)->isValid()){
            //大小 资源类型限制
            $ext = $request->file($name)->getClientOriginalExtension();  //文件类型
            $size = $request->file($name)->getClientSize() / 1024 / 1024;
            if($source_type == 'image'){
                if(!in_array($ext,['jpg','png','jpeg','gif'])){
                    dd('图片类型不存在');
                }
                if($size > 2){
                    dd('图片过大');
                }
            }elseif($source_type == 'voice'){}
            $file_name = time().rand(1000,9999).'.'.$ext;
            $path = request()->file($name)->storeAs('upload/'.$source_type,$file_name); // upload/image/15680169074048.jpg
//            dd($path);
            $storage_path = '/storage/'.$path; // /storage/upload/image/15680170235715.jpg
//            dd($storage_path);
            $path = realpath('./storage/'.$path);
//            dd($path);

            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->get_wechat_access_token().'&type='.$source_type;
            $result = $this->guzzle_upload($url,$path,$client);
            $re = json_decode($result,1);

            //插入数据库
            DB::connection('mysql_wechat')->table('wechat_source')->insert([
                'media_id'=>$re['media_id'],
                'type' => $type,
                'path' => $storage_path,
                'add_time'=>time()
            ]);
            echo "入库成功";
        }
    }

    public function guzzle_upload($url,$path,$client){
        $result = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name'     => 'media',
                    'contents' => fopen($path,'r')
                ]
            ]
        ]);
        return $result->getBody();
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