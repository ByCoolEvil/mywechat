<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Te extends Model
{
    protected $table = 'te';
    protected $primaryKey = 'id';
    public $timestamps = false; //关闭自动填充时间
    protected $guarded = []; //不可以批量赋值字段
}