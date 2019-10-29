<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TeController extends Controller
{
    /*
     * 接口测试查询
     */
    public function show()
    {
        // 支持 搜索功能 支持分页

        // 查询数据库
        $data = \DB::table('te')->get();
        // 状态值 描述
        return json_encode([
            'ret' => 1,
            'msg' => '查询成功',
            'data' => $data
        ]);
    }
    /*
     * 接口测试添加
     */
    public function add(Request $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');
//        dd($request->photo);
        if(empty($name) || empty($age)){
            return json_encode(['ret'=>0,'msg'=>'参数不能为空']);
        }
//        处理文件上传
        if($request->hasFile('photo')){
            $res = $request->photo->store('images');
            var_dump($res);
        }
        $res = \DB::table('te')->insert([
            'name' => $name,
            'age' => $age,
            'file' => $res,
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'添加异常']);
        }
    }
    /*
     * 接口测试删除
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $data = DB::table('te')->where(['id'=>$id])->delete();
        if($data){
            return json_encode(['ret'=>1,'msg'=>'删除成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'删除异常']);
        }
    }
    /*
     * 接口测试查询
     */
    public function find(Request $request)
    {
        // 查询数据库
        $id = $request->input('id');
        $data = \DB::table('te')->where(['id'=>$id])->first();
        // 状态值 描述
//        return json_encode([
//            'ret' => 1,
//            'msg' => '查询成功',
//            'data' => $data,
//        ]);
        array($data);
        return json_encode(['data'=>$data]);
    }
    /*
     * 接口测试修改
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $age = $request->input('age');
        $res = \DB::table('te')->where(['id'=>$id])->update(['name'=>$name,'age'=>$age]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'修改成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'修改异常']);
        }
    }

}