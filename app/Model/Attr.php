<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    protected $table = 'attr';
    protected $primaryKey = "attr_id";
    protected $guarded = [];
    public $timestamps = false;
}
