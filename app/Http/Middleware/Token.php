<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //后台设置跨域
//        header("Access-Control-Allow-Origin:*");
//        header("Access-Control-Allow-Methods:POST");
//        header("Access-Control-Allow-Headers:x-request-with,content-type");

        $token = $request->input("token");
        $userData = $this->checkToken($token);

        $mid_params = ['userData' => $userData];
        $request->attributes->add($mid_params);//添加参数

        return $next($request);
    }

    public function checkToken($token)
    {
        //后台设置跨域
//        header("Access-Control-Allow-Origin:*");
//        header("Access-Control-Allow-Methods:POST");
//        header("Access-Control-Allow-Headers:x-request-with,content-type");

        // 效验token令牌 效验用户身份
        if(empty($token)){
            // 报错
            echo json_encode(['ret'=>201,'msg'=>'请先登录']);die;
        }
        // 效验token是否正确
        $userData = User::where(['token'=>$token])->first();
        if(empty($userData)){
            // 报错
            echo json_encode(['ret'=>201,'msg'=>'请先登录']);die;
        }
        // 效验token有效期
        if(time() > $userData['expire_time']){
            // 报错
            echo json_encode(['ret'=>201,'msg'=>'请先登录']);die;
        }
        // 延长token的有效期
        $userData->expire_time = time()+7200;
        $userData->save();

        return $userData;
    }
}