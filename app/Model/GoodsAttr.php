<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $table = 'goods_attr';
    protected $primaryKey = "goods_attr_id";
    protected $guarded = [];
    public $timestamps = false;
}
