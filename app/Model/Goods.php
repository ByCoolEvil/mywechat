<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey = "goods_id";
    protected $guarded = [];
    public $timestamps = false;
}
