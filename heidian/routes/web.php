<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//首页
route::any('LoginIndex','LoginController@LoginIndex');
route::any('/','IndexController@index');
//全部商品
route::any('allshops/{id?}','AllshopsController@allshops');
route::any('allshopsSearch','AllshopsController@allshopsSearch');
route::any('goodsInfo','AllshopsController@goodsInfo');
//个人中心
route::any('userpage','UserpageController@userpage');
//修改个人资料
route::any('EdituserIndex','UserpageController@EdituserIndex');
//超购记录
route::any('BuyrecordIndex','UserpageController@BuyrecordIndex')->middleware('login');
//我的钱包
route::any('MywalletIndex','UserpageController@MywalletIndex')->middleware('login');
//宣传我们
route::any('InviteIndex','UserpageController@InviteIndex');
//晒单
route::any('WillshareIndex','UserpageController@WillshareIndex')->middleware('login');
//退出登录
route::any('Userquit','UserpageController@Userquit');
//商品详情
route::any('shopcontent/{goods_id?}','ShopcontentController@shopcontent');
//登录
route::any('LoginIndex','LoginController@LoginIndex');
route::any('LoginAdd','LoginController@LoginAdd');
//注册
route::any('register','RegisterController@registerIndex');
route::post('emails','RegisterController@emails');
route::any('registerAdd','RegisterController@registerAdd');
//购物车
route::any('shopcart','ShopcartController@shopcart')->middleware('login');
route::any('shopcartAdd/{goods_id?}','ShopcartController@shopcartAdd');
route::any('shopcartIndex','ShopcartController@shopcartIndex');
route::any('shopcartDel','ShopcartController@shopcartDel');
route::any('shopcartNum','ShopcartController@shopcartNum');
route::any('shopCartPrice','ShopcartController@shopCartPrice');
//验证码
route::any('verify/create','CaptchaController@create');
route::any('note','LoginController@note');
//结算
route::any('PaymentIndex','PaymentController@PaymentIndex');
route::any('paymentGoodId','PaymentController@paymentGoodId');
route::any('orderAdd','PaymentController@orderAdd');
//结算成功
route::any('SuccessIndex','SuccessController@SuccessIndex');
//收货地址
route::any('AddressIndex','AddressController@AddressIndex')->middleware('login');
route::any('AddressAddIndex','AddressController@AddressAddIndex');
route::any('AddressAdd','AddressController@AddressAdd');
route::any('AddressDefault','AddressController@AddressDefault');
route::any('AddressDel','AddressController@AddressDel');
route::any('AddressUpdate/{address_id?}','AddressController@AddressUpdate');
route::any('AddressEdit','AddressController@AddressEdit');
//支付
route::any('AlipayIndex','AliyunController@AlipayIndex');
//异步
route::any('async','AliyunController@async');
//同步
route::any('sync','AliyunController@sync');
//测试
route::any('text','RegisterController@text');



