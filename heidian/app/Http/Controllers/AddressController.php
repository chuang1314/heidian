<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\Index;
use App\Model\Address;



class AddressController extends Controller
{
    public function AddressIndex()
    {
        //收货地址页面
        $data = Address::where('user_id',session('LoginInfo.user_id'))->get();
        return view('address', ['data' => $data]);
    }

    //收货地址添加页面
    public function AddressAddIndex()
    {
        return view('writeaddr');
    }

    //收货地址添加
    public function AddressAdd(Request $request)
    {
        $data = $request->obj;
        $data['user_id'] = session("LoginInfo.user_id");
        $address = new Address();
        if ($data['is_default'] == 1) {
            //开启事务
            DB::beginTransaction(); //开启事务
            $result = $address->where('user_id', session("LoginInfo.user_id"))->update(['is_default' => 2]);//改
            $res = $address->insert($data);//添

            if ($result !== false && $res) {
                DB::commit();  //提交
                echo 1;
            } else {
                DB::rollback();  //回滚
                echo 2;
            }
        } else {
            $addressInfo = $address->insert($data);
            if ($addressInfo) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }

    //收货地址改为默认
    public function AddressDefault(Request $request)
    {
        $address = new Address();
        $address_id = $request->address_id;
        DB::beginTransaction(); //开启事务
        $where = [
            'user_id' => session("LoginInfo.user_id"),
            'address_id' => $address_id,
        ];
        $result = $address->where('user_id', session("LoginInfo.user_id"))->update(['is_default' => 2]);
        $res = $address->where($where)->update(['is_default' => 1]);
        if ($result && $res) {
            DB::commit();  //提交
            echo 1;
        } else {
            DB::rollback();  //回滚
            echo 2;
        }
    }

    //删除地址
    public function AddressDel(Request $request)
    {
        $address_id = $request->address_id;
        $where = [
            'address_id' => $address_id,
            'user_id' => session('LoginInfo.user_id'),
        ];
        $res = Address::where($where)->delete();
        if ($res) {
            echo 1;
        } else {
            echo 2;
        }
    }

    //修改地址页面
    public function AddressUpdate($address_id)
    {
        $data = Address::where('address_id', $address_id)->first();
        return view('addressupdate', ['data' => $data]);
    }

    //修改地址
    public function AddressEdit(Request $request)
    {
        $data = $request->obj;
        $data['user_id'] = session("LoginInfo.user_id");
        $address = new Address();
        $where = [
            'address_id' => $data['address_id'],
            'user_id' => session('LoginInfo.user_id')
        ];
        if ($data['is_default'] == 1) {
            DB::beginTransaction(); //开启事务
            $result = $address->where('user_id', session("LoginInfo.user_id"))->update(['is_default' => 2]);//改
            $res = $address->where($where)->update($data);//修改

            if ($result !== false && $res) {
                DB::commit();  //提交
                echo 1;
            } else {
                DB::rollback();  //回滚
                echo 2;
            }
        }else{
            $res = $address->where($where)->update($data);//修改
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }
}
