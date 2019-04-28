<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Shopcart;
use App\Model\Index;
use App\Model\Ordersite;
use App\Model\Order;
use App\Model\Orderdetail;
use App\Model\Address;

class PaymentController extends Controller
{
    //结算页面
    public function PaymentIndex(){
        $goods_id = session('GoodsId');
        $goods_id = explode(',',$goods_id);
        //dd($goods_id);
        $goods = new Index();
        $data = $goods ->where(['user_id'=>session('LoginInfo.user_id'),'cart_status'=>1])
                      ->whereIn('shop_cart.goods_id',$goods_id)
                      ->join('shop_cart', 'shop_goods.goods_id', '=', 'shop_cart.goods_id')
                      ->get(['goods_name','goods_img','self_price','buy_number']);

        $price=0;
        foreach($data as $v){
            $price += intval($v['self_price'])*intval($v['buy_number']);

        }
        return view('payment',['data'=>$data,'price'=>$price]);
    }

    //接收goods_id
    public function paymentGoodId(Request $request){
        $goods_id = $request->goods_id;
        if($goods_id == ''){
            echo 2;die;
        }
        //dd($goods_id);
        session(["GoodsId"=>$goods_id]);
        //dd( session("GoodsId"));
        if(session("GoodsId")!=''){
            echo  1;
        }
    }

    //确认结算
    public function orderAdd(Request $request)
    {
        $order=new Order();
        $goods_id=explode(',',session('GoodsId'));
        $goodsinfo=Shopcart::whereIn('shop_cart.goods_id',$goods_id)
            ->where(['user_id'=>session('LoginInfo.user_id'),'cart_status'=>1])
            ->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')
            ->get(['self_price','buy_number','shop_cart.goods_id','goods_name','buy_number','goods_num','goods_img'])
            ->toarray();
        //dd($goodsinfo);
        $order_price=0;
        foreach ($goodsinfo as $v){
            $order_price+=intval(intval($v['self_price'])*intval($v['buy_number']));
        }
        //dd($order_price);
        DB::beginTransaction();
        //获取订单总价
        $order->order_price=$order_price;
        //获取订单号
        $order->order_no=time().rand(11111,99999);
        $user_id=session('LoginInfo.user_id');
        $order->user_id=$user_id;
        //dd($order);
        $res1=$order->save();
        //dd($res1);
        //获取刚刚添加的id
        $order_id=$order->order_id;
        //订单详情添加
        //dd($goodsinfo);
        $str='';
        foreach($goodsinfo as $v){
            $goods_name=$v['goods_name'];
            $goods_img = $v['goods_img'];
            //dump($goods_img);
            $str.='('.$order_id.','.$user_id.','.$v['self_price'].','.$v['buy_number'].','."'$goods_img'".','.$v['goods_id'].','."'$goods_name'".')'.',';
        }
        $str=rtrim($str,',');

        //echo $str;die;
        $res2=DB::insert("insert into shop_order_detail (order_id,user_id,self_price,buy_number,goods_img,goods_id,goods_name) value $str");
            //dd($str);
        //订单地址
        $addressinfo=Address::where('is_default',1)->first(['address_name','address_tel','address_area'])->toarray();
        $addressinfo['order_id']=$order_id;
        $addressinfo['user_id']=$user_id;
        $addressinfo['created_at']=time();
        $addressinfo['updated_at']=time();
        //dd($addressinfo);
        $res3=Ordersite::insert($addressinfo);
        //dd($goodsinfo);
        //减少商品数量
        foreach($goodsinfo as $v){
            $res4=Index::where('goods_id',$v['goods_id'])->update(['goods_num'=>$v['goods_num']-$v['buy_number']]);
        }
        //删除购物车数据
        $cart=new Shopcart();
        $res5=$cart->where('user_id',$user_id)
            ->whereIn('goods_id',$goods_id)
            ->update(['cart_status'=>2]);
        //判断结果
        if($res1 && $res2 && $res3 && $res4 && $res5){
            DB::commit();
            echo '成功';
        }else{
            DB::rollBack();
            echo '失败';
        }

    }

}
