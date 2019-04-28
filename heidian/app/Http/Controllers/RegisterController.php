<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\index\model\Record;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class RegisterController extends Controller
{
    //注册页面
    public function registerIndex(){
        return view('register');
    }

    //注册
    public function registerAdd()
    {
        $user_tel = request()->user_tel;
        $user_email = request()->user_email;
        $userInfo = User::where('user_tel', $user_tel)->first();
        if (empty($userInfo)) {
            if (is_numeric($user_tel)) {
                $curl = request()->session()->get('curl');
                //dd($curl);
                if ($curl != $user_email) {
                    return 2;
                } else {
                    $data = request()->only(['user_tel', 'user_name', 'user_pwd', 'user_email']);
                    $data['user_pwd'] = encrypt($data['user_pwd']);
                    $res = DB::table('shop_user')->insertGetId($data);
                    session(['LoginInfo' => $user_tel]);
                    return 1;
                }
            } else {
                $ma = request()->session()->get('ma');
                if ($ma != $user_email) {
                    return 2;
                } else {
                    $data = request()->only(['user_tel', 'user_tel', 'user_pwd', 'user_email']);
                    $data['user_pwd'] = encrypt($data['user_pwd']);
                    $res = DB::table('shop_user')->insertGetId($data);
                    $user_tel = $data['user_tel'];
                    session(['LoginInfo' => $user_tel]);
                    return 1;
                }
            }
        }else{
            return 3;
    }
}
    //验证码
    public function emails(Request $request){
        $code=rand(111111,999999);
        $data = $request->post();
        unset($data['_token']);
        $user_tel= $data['user_tel'];
        if(is_numeric($user_tel)){
            $this->note($user_tel,$code, $request);
        }else{
            $this->sendMail($user_tel,$code, $request);
        }
    }
    //邮箱
    public function sendMail($user_tel,$code, $request){
        Mail::send('login.gg',['name'=>$code],function($message)use($user_tel){
            $message->subject("您的注册信息");
            $message->to($user_tel);
        });
        $request->session()->put('ma', $code);
    }
    //发送短信验证码
    public function note($user_tel,$code, $request){
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "135c42bccbe84c59907c8446649fba46";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=$user_tel&param=code%3A$code&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $request->session()->put('curl', $code);
        //dd($request)
        var_dump(curl_exec($curl));

    }


}
