<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function info()
    {
        return $this->hasOne(GoodsInfo::class,'goods_id','goods_id');
    }

    public function pics()
    {
        return $this->hasMany(GoodsPic::class, 'goods_id', 'goods_id');
    }
}
