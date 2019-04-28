<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Index;
use App\Model\Allshops;
use App\Model\Orderdetail;
use App\Model\User;
class IndexController extends Controller
{
    //首页
    public function index(){
        $data = Index::all();
        $pid = Allshops::where('pid',0)->get();
        //dd($data);
        //首页用户购买提示
        $goodsInfo = Orderdetail::join('shop_user','shop_order_detail.user_id','=','shop_user.user_id')
                                  ->get();
        //dd($goodsInfo);
        return view('index',['data'=>$data,'pid'=>$pid,'goodsInfo'=>$goodsInfo]);
    }

}
