<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Cart;
use App\Model\Product;
use App\Model\GoodsAttr;
use App\Model\Goods;

class LoginController extends Controller
{
    // 登录
    public function login(Request $request)
    {
        // 用户名，密码
        $username = $request->input('username');
        $password = $request->input('password');
        // 查询数据库
        $userData = User::where(['username'=>$username,'password'=>$password])->first();
        // 判断如果账号或密码跟数据库不一致就报错
        if(!$userData){
            echo '用户名或密码错误';die;
        }
        // 用户登录成功

        // 生成token令牌
        $token = md5($userData['user_id'].time()); // 生成一个不重复的token令牌
        //修改数据库 将token令牌
        $userData->token = $token;
        $userData->expire_time = time()+7200;
        $userData->save();
        //返回给客户端
        return json_encode(['ret'=>1,'msg'=>'登录成功','token'=>$token]);
    }
    // 验证登录
    public function getUser(Request $request)
    {
        // 效验token令牌 效验用户身份
        $token = $request->input('token');
        if(empty($token)){
            // 报错
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }
        // 效验token是否正确
        $userData = User::where(['token'=>$token])->first();
        if(empty($userData)){
            // 报错
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }
        // 效验token有效期
        if(time() > $userData['expire_time']){
            // 报错
            return json_encode(['ret'=>201,'msg'=>'请先登录']);
        }
        // 延长token的有效期
        $userData->expire_time = time()+7200;
        $userData->save();

        //返回给客户端
        return json_encode(['ret'=>1,'msg'=>'登录成功','token'=>$token]);
    }
    // 加入购物车
    public function cartAdd(Request $request)
    {
        $userData =  $request->get('userData');//获取参数
//        var_dump($userData);die;
        // 效验token令牌 效验用户身份

        $goods_id = $request->input('goods_id');
        $goods_attr_list = implode(",",$request->input('goods_attr_list'));
        $user_id = $userData['user_id'];
//        var_dump($user_id);die;
        $buy_number = 1;
        // 判断库存量
        // 利用goods_id 属性id组合查询货品表 库存
        $productData = Product::where(['goods_id'=>$goods_id,'value_list'=>$goods_attr_list])->first();
        $product_num = $productData['product_num']; // 商品的库存量
        if($buy_number >= $product_num){
            // 数据库没有货
            $is_have_num = 0;
        }else{
            // 数据库有货
            $is_have_num = 1;
        }
        // 判断加入购物车商品 是否已存在？
        $cartData = Cart::where(['goods_id'=>$goods_id,'user_id'=>$user_id,'goods_attr_list'=>$goods_attr_list])->first();
        if(!empty($cartData)){
            // 如果存在 修改数量  数量+1
            $cartData->buy_number = $cartData->buy_number+$buy_number;
            $cartData->save();
        }else{
            // 如果数据不存在 添加数据
            Cart::create([
                'user_id' => $user_id,
                'goods_id' => $goods_id,
                'goods_attr_list' => $goods_attr_list,
                'buy_number' => $buy_number,
                'product_id' => $productData['product_id'],
                'is_have_num' => $is_have_num,
            ]);
        }
        return json_encode(['ret'=>1,'msg'=>'加入购物车成功']);
    }
    // 结算
    public function order_address(Request $request)
    {
//        接收中间件传递的参数
        $userData = $request->get('userData');
//        获取登录的用户id
        $user_id = $userData['user_id'];
//        查询购物车表数据
        $cartData = Cart::join('goods',"cart.goods_id","=","goods.goods_id")->where(['user_id'=>$user_id])->get()->toArray();
//        属性值的组合  颜色：xxx  内存：xxx
        foreach ($cartData as $key => $value){
//            explode() 函数使用一个字符串分割另一个字符串，并返回由字符串组成的数组
            $goods_attr_list = explode(",",$value['goods_attr_list']);
//            查询属性值表    whereIn：where另一个分支，可以匹配一个数组
            $goodsAttrData = GoodsAttr::join('attr',"goods_attr.attr_id","=","attr.attr_id")->whereIn("goods_attr_id",$goods_attr_list)->get()->toArray();
//            组装字符串
            $attr_show_list = "";// 颜色：xxx  内存：xxx
//            商品真实总价 = 商品基本价钱+每个属性的价钱
            $count_price = $value['goods_price'];

            foreach ($goodsAttrData as $k => $v){
                $attr_show_list .= $v['attr_name'].":".$v['attr_value'].",";
//                价钱的计算 加上每个属性的价钱
                $count_price += $v['attr_price'];
            }
//            重新对数组元素赋值
            $cartData[$key]['attr_show_list'] = rtrim($attr_show_list,",");
            $cartData[$key]['goods_price'] = $count_price;
        }
//        dd($cartData);
        return json_encode($cartData);
    }
}