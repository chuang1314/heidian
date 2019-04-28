@extends('master')

@section('title', '黑市plus 注册')

@section('content')
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">注册</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('LoginIndex')}}" class="m-index-icon">去登录</a>
</div>
    <div class="wrapper">
        <input name="hidForward" type="hidden" id="hidForward" />
        <div class="registerCon">
            @csrf
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <s class="phone"></s><input id="user_name" type="text" placeholder="请输入您的用户名"  />
                    </dl>
                    <dl>
                        <s class="phone"></s><input id="userMobile"  type="text" placeholder="请输入您的手机号码" value="" />
                        <span class="clear"></span>
                    </dl>
                    <dl>
                       <s class="phone"></s><input type="text" name="user_email" id="user_email" placeholder="输入验证码" />
                        <button id="ma">获取验证码</button>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input class="pwd" maxlength="11"  id="pwd" type="password" placeholder="6-16位数字、字母组成"  />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input class="conpwd" maxlength="11" id="user_pwd" type="password" placeholder="请确认密码" value="" />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl class="a-set">
                        <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                    </dl>

                </li>
                <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">立即注册</a></li>
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
            </ul>
        </div>


</div>
</body>
@endsection

@section('my-js')
    <script>
        $(function() {
        $('.registerCon input').bind('keydown',function(){
            var that = $(this);
            if(that.val().trim()!=""){

                that.siblings('span.clear').show();
                that.siblings('span.clear').click(function(){
                    console.log($(this));

                    that.parents('dl').find('input:visible').val("");
                    $(this).hide();
                })

            }else{
                that.siblings('span.clear').hide();
            }

        })
        function show(){
            if($('.registerCon input').attr('type')=='password'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        function hide(){
            if($('.registerCon input').attr('type')=='text'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        $('.registerCon s').bind({click:function(){
                if($(this).hasClass('eye')){
                    $(this).removeClass('eye').addClass('eyeclose');

                    $(this).prev().prev().prev().val($(this).prev().prev().val());
                    $(this).prev().prev().prev().show();
                    $(this).prev().prev().hide();


                }else{
                    console.log($(this  ));
                    $(this).removeClass('eyeclose').addClass('eye');
                    $(this).prev().prev().val($(this).prev().prev().prev().val());
                    $(this).prev().prev().show();
                    $(this).prev().prev().prev().hide();

                }
            }
        })
        function registertel(){
            //点击获取验证码
           $(document).on('click','#ma',function() {
               var user_tel=$("#userMobile").val();
               var _token=$("#_token").val();
               $.post(
                   "{{url('emails')}}",
                   {user_tel:user_tel,_token:_token},
                   function (res) {
                       console.log(res);
                   }
               )
           })
           //点击立即注册
            $('#btnNext').click(function(){
                // 手机号
                var user_name = $("#user_name").val();
                var user_tel = $("#userMobile").val();
                var pwd = $("#pwd").val();
                var user_email = $("#user_email").val();
                var user_pwd = $("#user_pwd").val();
                var reg1= /^\d{11}$/;
                var reg2=/^[0-9a-zA-Z]{6,16}$/;
                var that = $(this);
                // 购物协议
                if($("i[class='gou']").attr('class') == undefined){
                    $("#btnNext").css('class','disabled');
                    return false;
                }
                if(user_name == ''){
                    layer.msg('请输入您的用户名！');
                    return false;
                }
                else if( user_tel == '')
                {
                    layer.msg('请输入您的手机号！');
                    return false;
                }
                else if(!reg1.test(user_tel))
                {
                    layer.msg('手机号必须为11位的纯数字');
                    return false;
                }else if(user_email== ''){
                    layer.msg('验证码不能为空');
                    return false;
                }else if(pwd == ''){
                    layer.msg('请设置您的密码');
                    return false;
                }else if(!reg2.test(pwd)){
                    layer.msg('请输入6-16位数字或字母组成的密码!');
                    return false;
                }else  if(pwd != user_pwd){
                    layer.msg('您俩次输入的密码不一致哦！');
                    return false;
                }
                //提交数据到控制器
                var _token = $("#_token").val();
                $.post(
                    "{{url('registerAdd')}}",
                    {user_name:user_name,user_pwd:user_pwd,_token:_token,user_tel:user_tel,user_email:user_email},
                    function(res){
                        if(res==1){
                            layer.msg('注册成功',{time:2000},function(){
                                location.href="{{url('LoginIndex')}}";
                            });
                        }else if(res==2){
                            layer.msg('验证码不正确');
                        }else if(res==3){
                            layer.msg('此手机号已被注册');
                        }
                    }
                )
            })
        }
        registertel();
        // 购物协议
        $('dl.a-set i').click(function(){
            var that= $(this);
            if(that.hasClass('gou')){
                that.removeClass('gou').addClass('none');
                $('#btnNext').css('background','#ddd');
                layer.msg('请您勾选《666潮人购购物协议》');
                return false;

            }else{
                that.removeClass('none').addClass('gou');
                $('#btnNext').css('background','#f22f2f');

            }

        })

        })
    </script>
    <script src="js/all.js"></script>
@endsection