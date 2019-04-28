<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Allshops;
use App\Model\Index;

class AllshopsController extends Controller
{
    //展示所有商品
    public function allshops($id=''){
        $pid = Allshops::where('pid',0)->get();
        if(empty($id)){
            $data = Index::orderBy('goods_num','desc')->get();
        }else{
            $arr=Allshops::get();
            $c_id=soncateinfo($arr,$id);
//          var_dump($arr);
            $data = Index::whereIn('cate_id',$c_id)->get();
        }
        return view('allshops',['pid'=>$pid,'data'=>$data,'cate_id'=>$id]);

    }
    //分类下的商品
    public function goodsInfo(Request $request)
    {
        $search=$request->post('search');
        $nav=$request->post('nav');
        //echo $nav;die;
        if($nav==1){
            $field='popularity';
            $asc='desc';
        }else if($nav==2){
            $field='popularity';
            $asc='desc';
        }else if($nav==3){
            $field='self_price';
            $asc='asc';
        }else if($nav==4){
            $field='self_price';
            $asc='desc';
        }

        $arr=Index::where('goods_name','like',"%$search%")->orderBy($field,$asc)->get();
        return view('search',['data'=>$arr]);
    }


    //搜索
    public function allshopsSearch(Request $request){
        $search =$request->post('search');
        //dd($search);
        if(!empty($search)){
            $data = Index::where('goods_name','like',"%$search%")->get();
            return view('search',['data'=>$data,'search'=>$search]);
        }else{
            $data = Index::all();
            return view('search',['data'=>$data,'search'=>$search]);
        }
    }
}
