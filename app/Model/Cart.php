<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = "cart_id";
    protected $guarded = [];
    public $timestamps = false;
}
