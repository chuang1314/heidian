<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品详情</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/goods.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('css/fsgallery.css')}}" rel="stylesheet" charset="utf-8">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <style>
        .Countdown-con {padding: 4px 15px 0px;}
    </style>
</head>
<body fnav="2" class="g-acc-bg">
<div class="page-group">
    <div id="page-photo-browser" class="page">
        <!--触屏版内页头部-->
        <div class="m-block-header" id="div-header">
            <strong id="m-title">商品详情</strong>
            <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>

            <a href="{{url('shopcart')}}" class="m-index-icon"><img src="/uploads/20190114/gouwuche.jpg" alt="恐龙吃掉了" width="50"></a>

        </div>

        <!-- 焦点图 -->
        <div class="hotimg-wrapper">
            <div class="hotimg-top"></div>
            <section id="gallery" class="hotimg">
                <ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
                    @foreach($goods_imgs as $v)
                        <li style="width: 414px; float: left; display: block;" class="flex-active-slide">
                            <a href="/uploads/{{$v}}"><img src="/uploads/{{$v}}" alt="图片被恐龙吃掉了">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
        <!-- 产品信息 -->
        <div class="pro_info">
            <h2 class="gray6">
                (第<em id='Period'>10363</em>潮)
                {{$data['goods_name']}}<span>{{$data['goods_desc']}}</span>

            </h2>
            <input type="hidden" value="{{$data['goods_id']}}" id="input">
            <div class="purchase-txt gray9 clearfix">
                价值：￥{{$data['self_price']}}
            </div>

            <div class="clearfix">

                <div class="gRate">
                    <div class="Progress-bar">
                        <p class="u-progress" title="已完成90%">
                                    <span class="pgbar" style="width:90%;">
                                        <span class="pging"></span>
                                    </span>
                        </p>
                        <ul class="Pro-bar-li">
                            <li class="P-bar01"><em>27</em>已参与</li>
                            <li class="P-bar02"><em>30</em>总需人次</li>
                            <li class="P-bar03"><em>3</em>剩余</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--本商品已结束-->

        </div>


        <div class="pro_foot">
            <a href="" class="">第10364潮正在进行中<span class="dotting"></span></a>
            <a href="" class="shopping">立即参与</a>
                <span class="fr" id="cart" style="cursor: pointer"><i><b num="1">1</b></i></span>
        </div>
    </div>
</div>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">

<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
<script src="{{url('js/swiper.min.js')}}"></script>
<script src="{{url('js/photo.js')}}" charset="utf-8"></script>
<script src="{{url('layui/layui.js')}}"></script>

<script>
    $(function () {
        $('.hotimg').flexslider({
            directionNav: false,   //是否显示左右控制按钮
            controlNav: true,   //是否显示底部切换按钮
            pauseOnAction: true,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
            animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
            slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
            animationSpeed: 150,   //轮播效果切换时间,默认600ms
            direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
            randomize: false,   //是否随机幻切换
            animationLoop: true   //是否循环滚动
        });
        setTimeout($('.flexslider img').fadeIn());

        // 参与记录、历史获得者左右切换
        // $('.listtab a').click(function(){
        //     $(this).addClass('current').siblings('a').removeClass('current');
        //     if($('.partcon').css('display')=='block'){
        //         $('.partcon').css('display','none');
        //         $('.history-winwrapp').css('display','block');
        //     }else{
        //         $('.partcon').css('display','block');
        //         $('.history-winwrapp').css('display','none');
        //     }
        // })

        //加入购物车
        $(document).on('click',"#cart",function () {
            //alert(1);
            var goods_id = $("#input").val();
            console.log(goods_id);
            var _token = $("#_token").val();
            var that = $(this);
            $.post(
                "{{url('shopcartAdd')}}",
                {goods_id:goods_id,_token:_token},
                function(res) {
                    if(res==1)
                    {
                        alert('加入购物车成功');
                    }else if(res == 5){
                        alert('请先登录');
                    }
                }
            )
        })

        // 无内容判断
        if($('.partcon .part-record div.ann_list').length==0){
            $('.partcon .part-record').css('display','none');
            $('.partcon .nocontent').css('display','block');
        }else{
            $('.partcon .part-record').css('display','block');
            $('.partcon .nocontent').css('display','none');
        }


        if($('.history-winwrapp .history-win .win-list').length==0){
            $('.history-winwrapp .history-win').css('display','none');
            $('.history-winwrapp .nocontent').css('display','block');
        }else{
            $('.history-winwrapp .history-win').css('display','block');
            $('.history-winwrapp .nocontent').css('display','none');
        }

        // 滑动
        var tabsSwiper = new Swiper('#tabs-container',{
            speed:500,
            onSlideChangeStart: function(){
                $(".tabs .active").removeClass('active')
                $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active')
            }
        })
        $(".tabs a").on('touchstart mousedown',function(e){
            e.preventDefault()
            $(".tabs .active").removeClass('active')
            $(this).addClass('active')
            tabsSwiper.slideTo( $(this).index() )
        })
        $(".tabs a").click(function(e){
            e.preventDefault()
        })
    })
</script>
</body>
</html>





