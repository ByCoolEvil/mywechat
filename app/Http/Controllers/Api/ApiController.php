<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\GoodsAttr;
use DB;

class ApiController extends Controller
{
    public function news()
    {
//        后台设置跨域
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:POST");
        header("Access-Control-Allow-Headers:x-request-with,content-type");

//        if(isset($_GET['jsoncallback'])){
//            $function_name = $_GET['jsoncallback'];
//            echo $function_name."(".$data.")";die;
//        }

        $data = Goods::orderBy("goods_id","DESC")->limit(4)->get()->toArray();

        foreach($data as $key => $value){
            $base_path = "http://www.mywechat.com/img/20191022094456.jpg"; // 默认访问的图片
            if(!empty($value['goods_img'])){
                $data[$key]['goods_img'] = "http://www.mywechat.com/".$value['goods_img'];
            }else{
                $data[$key]['goods_img'] = $base_path;
            }
        }

        //echo "<pre>";
       // var_dump($data);die;
//        返回json
        return json_encode(['ret'=>1,'data'=>$data]);
    }
    /*
     * 商品详情
     */
    public function detail(Request $request)
    {
        //后台设置跨域
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods:POST");
        header("Access-Control-Allow-Headers:x-request-with,content-type");

        $goods_id = $request->input('goods_id');
        // 查询商品表基本信息
        $goodsData = Goods::where(['goods_id'=>$goods_id])->first()->toArray();
        // 查询商品 - 属性关系表 goods_attr
        $goodsAttrData = GoodsAttr::join("attr","goods_attr.attr_id","=","attr.attr_id")->where(['goods_id'=>$goods_id])->get()->toArray();
        $specData = []; //可选规格数组
        $argsData = []; //普通展示属性
        foreach($goodsAttrData as $key => $value){
            if($value['attr_type'] == 2){
                // 可选规格
                $status = $value['attr_name'];
                $specData[$status][] = $value;
            }else{
                $argsData[] = $value;
            }
        }
        return json_encode([
            'goodsData' => $goodsData,
            'specData' => $specData,
            'argsData' => $argsData
        ]);
    }
}