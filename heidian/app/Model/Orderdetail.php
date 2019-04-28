<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shop_order_detail';


    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    public $timestamps = true;

    protected  $primaryKey = 'id';
}
