@extends('master')

@section('title', '黑市 pLuS')

@section('content')
	<div class="marginB" id="loadingPicBlock">
		<!--首页头部-->
		<div class="m-block-header" style="display: none">
			<div class="search"></div>
			<a href="/" class="m-public-icon m-1yyg-icon"></a>
		</div>
		<!--首页头部 end-->

		<!-- 关注微信 -->
		<div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
			<div class="app-icon">
				<a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
				<a href="javascript:;" class="info-icon">
					<i class="set-icon"></i>
					<div class="info">
						<p>点击关注666潮人购官方微信^_^</p>
					</div>
				</a>
			</div>
		</div>
		<!-- 焦点图 -->
		<div class="hotimg-wrapper">
			<div class="hotimg-top"></div>
			<section id="sliderBox" class="hotimg">
				<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
					<li style="width: 414px; float: left; display: block;" class="clone">
						<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
							<img src="/uploads/20190114/25b1a92a79ac884f.jpg!q90.jpg" alt="">
						</a>
					</li>
					<li class="" style="width: 414px; float: left; display: block;">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
							<img src="/uploads/20190114/c2c330b3bd08186d.jpg" alt="">
						</a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%B8%85%E5%87%89%E4%B8%80%E5%A4%8F&amp;pf=weixin">
							<img src="/uploads/20190114/7ed66e94bf609ada.jpg!q80.jpg" alt="">
						</a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%96%B0%E9%B2%9C%E6%B0%B4%E6%9E%9C&amp;pf=weixin">
							<img src="/uploads/20190114/62e8573b78a18386.jpg!q90.jpg" alt=""></a>
					</li>
					<li style="width: 414px; float: left; display: block;" class="">
						<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
							<img src="/uploads/20190114/c40f89ee0bf75c86.jpg!q80.jpg" alt="">
						</a>
					</li>
					<li class="clone" style="width: 414px; float: left; display: block;">
						<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
							<img src="/uploads/20190114/01c4687200384808.jpg!q95.jpg" alt="">
						</a>
					</li>
				</ul>
			</section>
		</div>
		<!--分类-->
		<div class="index-menu thin-bor-top thin-bor-bottom">
			<ul class="menu-list">
				@foreach($pid as $v)
					<li>
						<a href= "{{url("allshops/$v->cate_id")}}" id="btnNew" class="btnNew">
							<i class="xinpin"></i>
							<span class="title">{{$v->cate_name}}</span>
						</a>
					</li>
				@endforeach
			</ul>
			<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
		</div>
		<!--导航-->
		<div class="success-tip">
			<div class="left-icon"></div>
			<ul class="right-con">
				@foreach($goodsInfo as $v)
					<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">{{$v['user_name']}}</span>获得了<span>{{$v['goods_name']}}</span></a>
					</span>
					</li>
				@endforeach
			</ul>
		</div>
		<!-- 猜你喜欢 -->
		<div class="line guess">
			<div class="hot-content">
				<i></i>
				<span>猜你喜欢</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<!--商品列表-->
		<div class="goods-wrap marginB">
			<ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($data as $k=>$v)
				<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
					<a href="{{url("shopcontent/$v->goods_id")}}" class="g-pic">
						<img class="lazy" name="goodsImg" src="/uploads/{{$v->goods_img}}" width="136" height="136">
					</a>
					<p class="g-name">(第<em>28436</em>潮){{$v->goods_name}}</p>
					<ins class="gray9">价值：￥{{$v->self_price}}</ins>
					<div class="Progress-bar">
						<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
						</p>

					</div>
					<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
						<a href="{{url('PaymentIndex')}}" class="buy-btn" codeid="12751965">立即潮购</a>
						<div class="gRate" codeid="12751965" canbuy="58">
							<input type="hidden" value="{{$v->goods_id}}" class="goods_id">
							<a href="javascript:;" id="cart"></a>
						</div>
					</div>
				</li>
				@endforeach
			</ul>
			<div class="loading clearfix"><b></b>正在加载</div>
		</div>

		<div id="div_fastnav" class="fast-nav-wrapper">
			<ul class="fast-nav">
				<li id="li_menu" isshow="0">
					<a href="javascript:;"><i class="nav-menu"></i></a>
				</li>
				<li id="li_top" style="display: none;">
					<a href="javascript:;"><i class="nav-top"></i></a>
				</li>
			</ul>
			<div class="sub-nav four" style="display: none;">
				<a href="#"><i class="announced"></i>最新揭晓</a>
				<a href="#"><i class="single"></i>晒单</a>
				<a href="#"><i class="personal"></i>我的潮购</a>
				<a href="#"><i class="shopcar"></i>购物车</a>
			</div>
		</div>
		<!--底部导航-->
		<div class="footer clearfix" id="clearfix">
			<ul>
				<li class="f_home"><a href="{{url('index')}}" class="hover"><i></i>潮购</a></li>
				<li class="f_announced"><a href="{{url('allshops')}}" ><i></i>所有商品</a></li>
				<li class="f_single"><a href="javascript:;" ><i></i>最新揭晓</a></li>
				<li class="f_car"><a id="btnCart" href="{{url('shopcart')}}" ><i></i>购物车</a></li>
				<li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
			</ul>
		</div>
	</div>
@endsection

@section('my-js')
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
			//点击购物车
            $(document).on('click',"#cart",function () {
                var _this = $(this);
                var goods_id = _this.prev('input').val();
                console.log(goods_id);
                var _token = $("#_token").val();
                var that = $(this);
                $.post(
                    "{{url('shopcartAdd')}}",
                    {goods_id:goods_id,_token:_token},
                    function(res) {
                        if(res==1)
                        {
                            layer.msg('加入购物车成功');
                        }else if(res == 5){
                            layer.msg('请先登录');
						}
                    }
                )
            })
        });
	</script>
	<script>
        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "images/loading2.gif",
                effect: "fadeIn",
            });

            // 返回顶部点击事件
            $('#div_fastnav #li_menu').click(
                function(){
                    if($('.sub-nav').css('display')=='none'){
                        $('.sub-nav').css('display','block');
                    }else{
                        $('.sub-nav').css('display','none');
                    }

                }
            )
            $("#li_top").click(function(){
                $('html,body').animate({scrollTop:0},300);
                return false;
            });

            $(window).scroll(function(){
                if($(window).scrollTop()>200){
                    $('#li_top').css('display','block');
                }else{
                    $('#li_top').css('display','none');
                }

            })


        });

	</script>
@endsection




