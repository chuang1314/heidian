<?php


function soncateinfo($cateinfo,$cate_id){
    static $arr=[];
    foreach ($cateinfo as $v){
        if($v['pid']==$cate_id){
            $arr[]=$v['cate_id'];
            soncateinfo($cateinfo,$v['cate_id']);
        }
    }
    return $arr;
}
/*
    * @content 生成随机验证码
    * @params $len  int   需要生成验证码的长度
    * @return  $code  string  生成的验证码
    * */

 function createcode($len)
{
    $code = '';
    for($i=1;$i<=$len;$i++){
        $code .=mt_rand(0,9);
    }

    return $code;
}
