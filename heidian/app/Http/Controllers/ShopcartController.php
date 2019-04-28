<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Shopcart;
use App\Model\Index;

class ShopcartController extends Controller
{
    // 展示购物车
    public function shopcart()
    {
        $where = [
            'user_id' => session('LoginInfo.user_id'),
            'cart_status'=>1,
        ];
        $goodsInfo = DB::table('shop_goods')
            ->join('shop_cart', 'shop_goods.goods_id', '=', 'shop_cart.goods_id')
            ->where($where)
            ->get();
        //购物车人气推荐
        $data = Index::orderBy('popularity','desc')->limit(4)->get();
        //dd($data);
        return view('shopcart', ['goodsInfo' => $goodsInfo,'data'=>$data]);
    }

    // 加入购物车
    public function shopcartAdd(Request $request)
    {
        if(session('LoginInfo') == ''){
            echo 5 ;die;
        }
        $goods_id = $request->post('goods_id');
        //dd($goods_id);
        $user_id = session('LoginInfo.user_id');
        $cart = new Shopcart;

        //查询购物车中是否有当前的商品数据
        $cardwhere = [
            'user_id' => $user_id,
            'goods_id' => $goods_id,
            'cart_status'=>1
        ];
        $cartInfo = Shopcart::where($cardwhere)->first();
        //dd($cartInfo);
        if (!empty($cartInfo)) {
            //修改
            $buy_number = $cartInfo['buy_number'] + 1;
            $res = DB::table("shop_cart")->where($cardwhere)->update(['buy_number' => $buy_number]);
            if ($res) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            $cart->goods_id = $goods_id;
            $cart->user_id = $user_id;
            $res = $cart->save();
            if ($res) {
                echo 1;
            } else {
                echo 2;
            }
        }


    }

    // 购物车 删除 / 批量删除
    public function shopcartDel(Request $request){
        $goods_id = $request->goods_id;
        //dd($goods_id);
        $goods_id = explode(',',$goods_id);
        //dd($goods_id);
        $cart = new Shopcart();
        $res =  $cart->where('user_id',session("LoginInfo.user_id"))
                     ->whereIn('goods_id',$goods_id)
                     ->update(['cart_status'=>2]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    // 修改购物车商品数量
    public function shopcartNum(Request $request){
        $goods_num = $request->post('buy_num');
        $goods_id = $request->post('goods_id');
        //dd($goods_num);
        $cartWhere = [
            'goods_id' => $goods_id,
            'user_id' => session("LoginInfo.user_id"),
        ];
        $cartInfo = Shopcart::where($cartWhere)->get();
        $res = Shopcart::where($cartWhere)->update(['buy_number'=>$goods_num]);




    }


}
