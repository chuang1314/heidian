@extends('master')

@section('title', '黑市 登录')

@section('content')
    <body>

    <!--触屏版内页头部-->
    <div class="m-block-header" id="div-header">
        <strong id="m-title">登录</strong>
        <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
        <a href="{{url('index')}}" class="m-index-icon"><i class="home-icon"></i></a>
    </div>

    <div class="wrapper">
        <div class="registerCon">
            <div class="binSuccess5">
                <ul>
                    <li class="accAndPwd">
                        <dl>
                            <div class="txtAccount">
                                <input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                            </div>
                            <cite class="passport_set" style="display: none"></cite>
                        </dl>
                        <dl>
                            <input id="txtPassword" type="password" placeholder="密码"  maxlength="20" /><b></b>
                        </dl>
                        <dl>
                            <input id="verifycode" type="text" placeholder="请输入验证码"  maxlength="4" /><b></b>
                            <img src="{{url('/verify/create')}}" alt="" id="img">
                        </dl>
                    </li>
                </ul>
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
            </div>
            <div class="forget">
                <a href="">忘记密码？</a><b></b>
                <a href="{{url('register')}}">新用户注册</a>
            </div>
        </div>
        <div class="oter_operation gray9" style="display: none;">

            <p>登录666潮人购账号后，可在微信进行以下操作：</p>
            1、查看您的潮购记录、获得商品信息、余额等<br />
            2、随时掌握最新晒单、最新揭晓动态信息
        </div>
    </div>

    </body>
    </html>
@endsection
@section('my-js')
<script>
    $(function(){
        //点击验证码刷新
        $("#img").click(function(){
            $(this).attr('src',"{{url('/verify/create')}}"+"?"+Math.random())
        })
        //点击登录
        $(document).on('click',"#btnLogin",function () {
                var login_tel = $("#txtAccount").val();
                // console.log(login_name);
                var login_pwd = $("#txtPassword").val();
                var verifycode = $("#verifycode").val();
                //验证手机号
                if(login_tel =="")
                {
                    layer.msg('请输入您的手机号！');
                    return false;
                }

               //验证密码
                if(login_pwd=="")
                {
                    layer.msg('请输入您的密码！');
                    return false;
                }

                //验证验证码
                if(verifycode == '')
                {
                    layer.msg('请输入您的验证码！');
                    return false;
                }

                var _token = $("#_token").val();
                var that = $(this);
                $.post(
                    "{{url('LoginAdd')}}",
                    {login_tel:login_tel,login_pwd:login_pwd,_token:_token,verifycode:verifycode},
                    function (res) {
                        if(res==1)
                        {
                            layer.msg('登录成功',{time:2000},function(){
                                location.href="{{url('index')}}";
                            });
                        }else if(res==2){
                            layer.msg('账号或密码不正确', {icon: 2});
                        }else{
                            layer.msg('验证码不正确', {icon: 2});
                        }



                    }
                )
            })

    })
</script>
@endsection

