@extends('layouts.layout')
@section('title','货品添加')
@section('content')
@endsection
<h3>货品添加</h3>
<form action="{{url('admins/product_add')}}" method="post">
<table width="100%" id="table_list" class='table table-bordered'>
    <input type="hidden" name="goods_id" value="{{$goods_id}}">
    <tbody>
    <tr>
        <th colspan="20" scope="col">商品名称：oppo11&nbsp;&nbsp;&nbsp;&nbsp;货号：ECS000075</th>
    </tr>
    <tr>
        <!-- start for specifications -->
        @foreach($attrData as $key => $value)
            <td scope="col"><div align="center"><strong>{{$key}}</strong></div></td>
        @endforeach
        {{--<td scope="col"><div align="center"><strong>颜色</strong></div></td>--}}
        <!-- end for specifications -->
        <td class="label_2">货号</td>
        <td class="label_2">库存</td>
        <td class="label_2">&nbsp;</td>
    </tr>
    <tr id="attr_row">
        <!-- start for specifications_value -->
        @foreach($attrData as $key => $value)
            <td align="center" style="background-color: rgb(255, 255, 255);">
                <select name="goods_attr[]">
                    <option value="" selected="">请选择...</option>
                    {{--<option value="64G">64G</option>--}}
                    {{--<option value="128G">128G</option>--}}
                    @foreach($value as $k => $v)
                    <option value="{{$v['goods_attr_id']}}">{{$v['attr_value']}}</option>
                    @endforeach
                </select>
            </td>
        @endforeach
        <!-- end for specifications_value -->
        <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
        <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
        <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button addRow" value=" + " ></td>
    </tr>
    <tr>
        <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
            <input type="submit" class="button" value=" 保存 ">
        </td>
    </tr>
    </tbody>
</table>
</form>
@section('bottom')
@endsection
<script src="{{asset('layui/jquery-3.3.1.min.js')}}"></script>
<script>
    // + - 号效果
    $(document).on('click','.addRow',function(){
        var val = $(this).val();
        if(val == " + "){
            // 选择 操作
            $(this).val(" - ");
            var tr = $(this).parent().parent();
            var tr_clone = tr.clone();
            $(this).val(" + ");
            tr.after(tr_clone);
        }else{
            $(this).parent().parent().remove();
        }
    });
</script>
