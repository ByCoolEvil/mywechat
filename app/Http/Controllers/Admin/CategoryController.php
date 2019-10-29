<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use App\Model\Type;
use App\Model\Attr;
use App\Model\Goods;
use App\Model\GoodsAttr;
use App\Model\Product;
use DB;

class CategoryController extends Controller
{
    // 商品表
    public function cate_add()
    {
        $data = DB::connection('mysql_wechat')->table('category')->get();
        return view('admins/cate_add',['data'=>$data]);
    }
    // 商品分类查询字段是否重复
    public function cate_check(Request $request)
    {
        $c_name = $request->all()['c_name'];
        $where=[
            ['c_name','=',$c_name]
        ];
        $count=DB::connection('mysql_wechat')->table('category')->where($where)->count();
//        dd($count);
        if($count>0){
            return 0;
        }else{
            return 1;
        }
    }
    // 商品添加
    public function cate_do_add(Request $request)
    {
        $c_name = $request->all()['c_name']?:"";
        $pid = $request->all()['pid']?:"";
        if($c_name == ""){
            echo "分类不能为空";die;
        }
        $where = [
            ['c_name','=',$c_name]
        ];
        $count = DB::connection('mysql_wechat')->table('category')->where($where)->count();
        if($count>0){
            echo "该分类已经有了";die;
        }
        $arr = ['c_name' => $c_name,'pid' => $pid];
        $res = DB::connection('mysql_wechat')->table('category')->insert($arr);
        if($res){
            return redirect('admins/cate_add');
        }
    }
    //商品分类列表
    public function cate_list()
    {
        $data = DB::connection('mysql_wechat')->table('category')->get()->toArray();
        return view('admins/cate_list',['data'=>$data]);
    }
    // 商品类型添加
    public function type_add()
    {
        return view('admins/type_add');
    }
    // 执行商品类型添加
    public function type_do_add(Request $request)
    {
        $req =$request->all();
        $data = DB::connection('mysql_wechat')->table('type')->insert([
            'type_name' => $req['type_name'],
        ]);
        if($data){
            return redirect('admins/type_index');
        }
    }
    // 商品类型列表
    public function type_index()
    {
        $data = Type::get();
//        dd($data);
        $count = [];
        foreach ($data as $k => $v) {
            $count[] = Attr::where(["type_id"=>$v["type_id"]])->count();
            $v["count"] = $count;
        }
        return view('admins/type_index',["data"=>$data]);
    }
    // 商品添加
    public function goods_add()
    {
        // 查询分类数据
        $cateData = Cate::get()->toArray();
        // 查询所有类型
        $typeData = Type::get()->toArray();
        return view('admins/goods_add',[
            'cateData'=>$cateData,
            'typeData'=>$typeData
        ]);
    }
    //执行商品添加
    public function goods_do_add(Request $request)
    {
        $postData = $request->input();
        echo '<pre>';
        var_dump($postData);
        // 查询Goods表添加入库
        $goodsModel = Goods::create([
            'goods_name' => $postData['goods_name'],
            'cat_id' => $postData['cat_id'],
            'goods_price' => $postData['goods_price']
        ]);
//        var_dump($goodsModel);die;
        // 获取商品主键id
        $goods_id = $goodsModel->goods_id;
        // 商品属性信息入库
        $insertData = []; // 定义要添加入库的数据
        foreach($postData['attr_value_list'] as $key => $value){
            $insertData[] = [
                'goods_id' => $goods_id,
                'attr_id' => $postData['attr_id_list'][$key],
                'attr_value' => $value, // 属性的值
                'attr_price' => $postData['attr_price_list'][$key]
            ];
        }
//        var_dump($insertData);die;
//        GoodsAttr表入库
        $res = GoodsAttr::insert($insertData);
        var_dump($res);
    }
    // 添加商品属性
    public function get_add()
    {
        $data = DB::connection('mysql_wechat')->table('type')->get();
        return view('admins/get_add',['data'=>$data]);
    }
    // 添加商品属性
    public function get_do_add(Request $request)
    {
        $data = $request->all();
        $res = DB::connection('mysql_wechat')->table('attr')->insert([
            'type_id'=>$data['type_id'],
            'attr_name'=>$data['attr_name'],
            'attr_type'=>$data['attr_type']
        ]);
        if($res){
            return redirect('admin/get_list');
        }

    }
    // 商品属性列表
    public function get_list(Request $request)
    {
        $attr_name = $request->input('attr_name')?:"";
        $where=[];
        if($attr_name!=""){
            $where[]=['attr_name','like',"%$attr_name%"];
        }
        $data = DB::connection('mysql_wechat')->table('attr')->where($where)->paginate(3);
//        dd($data);
        return view('admins/get_list',['data'=>$data,'attr_name'=>$attr_name]);
    }
    // 商品删除
    public function get_del(Request $request)
    {
        $req = $request->all();
        $data = DB::connection('mysql_wechat')->table('attr')->where(['attr_id'=>$req['attr_id']])->delete();
        if($data){
            return redirect('admins/get_list');
        }else{
            false;
        }
    }
    // 商品批删
    public function get_trundle(Request $request)
    {
        $del = $request->input('arr');
        dd($del);
        $arr = explode(",",$del);
//        dd($arr);
        $data = DB::connection('mysql_wechat')->table('attr')->whereIn('attr_id',$arr)->delete();
//        dd($data);
        if($data){
            return redirect('admins/get_list');
        }else{
            false;
        }

    }
    // 商品属性
    public function getAttr(Request $request)
    {
        $type_id = $request->input('type_id');
        // 查属性表
        $attrData = Attr::where(['type_id'=>$type_id])->get()->toArray();
        return json_encode($attrData);
    }
    // 货物添加
    public function product($goods_id)
    {
//        // 根据商品id 查询商品基本信息表
        $goodsData = Goods::where(['goods_id' => $goods_id])->first();
//        // 根据商品id 查商品属性关系表（属性值）
        $goodsAttrData = GoodsAttr::join("attr","goods_attr.attr_id","=","attr.attr_id")->where(['goods_id' => $goods_id,'attr_type'=>2])->get()->toArray();
        $newArr = [];
        foreach ($goodsAttrData as $key => $value){
            $status = $value['attr_name'];
            $newArr[$status][] = $value;
        }
//        echo "<pre>";
//        var_dump($goodsAttrData);
        return view('admins/product',[
            'attrData' => $newArr,
            'goods_id' => $goods_id
        ]);
    }
    // 货物执行添加
    public function product_add(Request $request)
    {
        $postData = $request->input();
//        echo "<pre>";
//        var_dump($postData);die;

        // 属性只组合处理数据
        $size = count($postData['goods_attr']) / count($postData['product_number']);
        $goodsAttr = array_chunk($postData['goods_attr'],$size);
        echo '<pre>';
        var_dump($postData);
        var_dump($goodsAttr);
        foreach($goodsAttr as $key => $value){
            Product::create([
                'goods_id' => $postData['goods_id'],
                'value_list' => implode(",",$value),
                'product_number' => $postData['product_number'][$key],
            ]);
        }
    }



}