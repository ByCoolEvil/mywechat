<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'category';
    protected $primaryKey = "cat_id";
    protected $guarded = [];
    public $timestamps = false;
}
