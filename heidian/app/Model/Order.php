<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shop_order';


    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    public $timestamps = true;

    protected  $primaryKey = 'order_id';
}
