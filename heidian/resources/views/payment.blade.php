@extends('master')

@section('title', '黑市plus 结算页面')

@section('content')

    <!--触屏版内页头部-->
    <div class="m-block-header" id="div-header">
        <strong id="m-title">结算支付</strong>
        <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
        <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
    </div>
    <div>
        <div class="g-pay-lst">
            <ul>
                @foreach($data as $v)
                <li>
                    <a href="">
                        <span>
                            <img src="/uploads/{{$v['goods_img']}}" border="0" alt="">
                        </span>
                        <dl>
                            <dt>

                                (第449560潮){{$v['goods_name']}}
                            </dt>
                            <dd><em class="price">1</em>人次/<em>￥{{$v['self_price']}}</em></dd>
                        </dl>
                    </a>
                </li>
                @endforeach
            </ul>
            <div id="divMore">

            </div>

        </div>
        <p class="gray9">总需支付金额：<em class="orange"><i>￥</i>{{$price}}</em></p>
        <div class="other_pay marginB">


            <a href="javascript:;" class="wzf checked">
                <b class="z-set"></b>第三方支付<em class="orange fr"><span class="colorbbb">需要支付&nbsp;</span><b>￥</b>{{$price}}</em>
            </a>
            <div class="net-pay">
                <a href="javascript:;" class="checked" id="jdPay">
                    <span class="zfb"></span>
                    <b class="z-set"></b>
                </a>
            </div>
            <div class="paylip">我们提倡理性消费</div>
        </div>
        <a id="btnPay" style="display: inline-block; text-align: center; background: red; width: 400px;" href="{{url('AlipayIndex')}}" class="orangeBtn fr w_account">立即支付</a>

    </div>
@endsection

@section('my-js')
    <script>
        $("#clearfix").css('display','none');
        $(document).ready(function(){
            var total=0;
            console.log($('.g-pay-lst li').length);
            for(var i = 0;i<$('.g-pay-lst li').length;i++){

                total +=parseInt($('.g-pay-lst li').eq(i).find('dd em.price').text());

            }
            // $('.gray9 .orange').html('<i>￥</i>'+total.toFixed(2));
            // $('.wzf .orange').html('<span class="colorbbb">需要支付&nbsp;</span><b>￥</b>'+total.toFixed(2));

            // 判断选择余额支付还是潮购值支付
            var chaomoney =parseInt($('.other_pay .chaomoney span.gray9 em').text())/100;
            var leftmoney =parseInt($('.other_pay .leftmoney span.gray9 em').text());

            // 潮购不可支付
            if(chaomoney<total){
                $('.chaomoney').css('background','#e2e2e2');

            }

            $('.net-pay a').click(function(){
                if($(this).hasClass('checked')){

                }else{
                    $(this).addClass('checked').siblings('a').removeClass('checked');
                }
            })

            $('.other_pay a.method').click(function(){
                if($(this).children('i').hasClass('z-set')){

                }else{
                    $(this).children('i').addClass('z-set').parents('a').siblings('a').children('i').removeClass('z-set');
                }
            })
        });

        //使用keyup事件，绑定键盘上的数字按键和backspace按键
        payPassword.on('keyup',"input[name='payPassword_rsainput']",function(e){

            var  e = (e) ? e : window.event;

            //键盘上的数字键按下才可以输入
            if(e.keyCode == 8 || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)){
                k = this.value.length;//输入框里面的密码长度
                l = _this.size();//6

                for(;l--;){

                    //输入到第几个密码框，第几个密码框就显示高亮和光标（在输入框内有2个数字密码，第三个密码框要显示高亮和光标，之前的显示黑点后面的显示空白，输入和删除都一样）
                    if(l === k){
                        _this.eq(l).addClass("active");
                        _this.eq(l).find('b').css('visibility','hidden');

                    }else{
                        _this.eq(l).removeClass("active");
                        _this.eq(l).find('b').css('visibility', l < k ? 'visible' : 'hidden');

                    }

                    if(k === 6){
                        j = 5;
                    }else{
                        j = k;
                    }
                    $('#cardwrap').css('left',j*43+'px');

                }
            }else{
                //输入其他字符，直接清空
                var _val = this.value;
                this.value = _val.replace(/\D/g,'');
            }
        });


    </script>
@endsection