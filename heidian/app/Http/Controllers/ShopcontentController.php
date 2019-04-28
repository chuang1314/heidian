<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Allshops;
use App\Model\Index;

class ShopcontentController extends Controller
{
    //商品详情页
    public function shopcontent($goods_id){

        $data = Index::where('goods_id',$goods_id)->first();
        //dd($data);
        $goods_imgs = $data['goods_imgs'];
        $goods_imgs = rtrim($goods_imgs,'|');
        $goods_imgs = explode('|',$goods_imgs);
        //dd($goods_imgs);
        return view('shopcontent',['data'=>$data,'goods_imgs'=>$goods_imgs]);
    }
}
