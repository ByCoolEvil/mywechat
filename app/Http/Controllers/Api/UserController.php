<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\te;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 搜索 带一个搜索参数
        $where = [];
        $name = request('name');
//        var_dump($name);
//        dd($name);
        if(isset($name)){
            $where[] = ['name','like',"%$name%"];
        }
        // 查询数据库
        $data = Te::where($where)->paginate(3);
        // 状态值 描述
        return json_encode([
            'ret' => 1,
            'msg' => '查询成功',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'create';die;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');
        if(empty($name) || empty($age)){
            return json_encode(['ret'=>0,'msg'=>'参数不能为空']);
        }

        $res = \DB::table('te')->insert([
            'name' => $name,
            'age' => $age,
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'添加异常']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // 查询数据库
//        $id = $request->input('id');
//        var_dump($id);die;
        $data = \DB::table('te')->where(['id'=>$id])->first();
        // 状态值 描述
        return json_encode([
            'ret' => 1,
            'msg' => '查询成功',
            'data' => $data,
        ]);
//        array($data);
//        return json_encode(['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'edit';die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        var_dump($id);die;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'destroy';die;
    }
}