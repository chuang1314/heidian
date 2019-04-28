<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\alipay\wappay\service\AlipayTradeService;
use App\Tools\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;
use App\Model\Shopcart;
use App\Model\Index;

class AliyunController extends Controller
{
    public function AlipayIndex(Request $request){
        header("Content-type: text/html; charset=utf-8");

        $goods_id=explode(',',session('GoodsId'));
        $goodsinfo=Shopcart::whereIn('shop_cart.goods_id',$goods_id)
            ->where(['user_id'=>session('LoginInfo.user_id'),'cart_status'=>1])
            ->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')
            ->get(['self_price','buy_number','shop_cart.goods_id','goods_name','buy_number','goods_num'])
            ->toarray();
        //dd($goodsinfo);
        $price=0;
        $name='';
        foreach ($goodsinfo as $v){
            $price+=intval(intval($v['self_price'])*intval($v['buy_number']));
            $name.=$v['goods_name'];
        }

        $config = config('aliyun');

            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = time().rand(11111,99999);

            //订单名称，必填
            $subject = $name;

            //付款金额，必填
            $total_amount = $price;

            //商品描述，可空
            $body = Null;

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        }


    //异步通知
    public function async(Request $request){
       echo 1;
    }

    //同步通知
    public function sync(Request $request){
        dd($request->all());
    }
}
