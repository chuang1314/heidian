<?php
namespace App\Http\Controllers;
Class WechatApiTest extends Controller
{
    public function valid()
    {
        $echostr = $_GET['echostr'];
        if($this->CheckSignature()){
            echo $echostr;die;
        }
    }

    private function CheckSignature()
    {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = 'cxy521swx';

        //将三个参数写入数组
        $arr = array($token,$timestamp,$nonce);
        //字典排序
        sort($arr,SORT_STRING);
        //拼接参数
        $str = implode($arr);
        $sign = sha1($str);
        if($sign == $signature){
            return true;
        }else{
            return false;
        }
    }
}


