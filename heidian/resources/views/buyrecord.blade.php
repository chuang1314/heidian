<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>潮购记录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/buyrecord.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">潮购记录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('shopcart')}}" class="m-index-icon"><img src="/uploads/20190114/gouwuche.jpg" alt="恐龙吃掉了" width="45"></a>
</div>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
@if($data == [])
    <div class="nocontent">
        <div class="m_buylist m_get">
            <ul id="ul_list">
                <div class="noRecords colorbbb clearfix">
                    <s class="default"></s>您还没有购买商品哦~
                </div>
                <div class="hot-recom">
                    <div class="title thin-bor-top gray6">
                        <span><b class="z-set"></b>人气推荐</span>
                        <em></em>
                    </div>
                    <div class="goods-wrap thin-bor-top">
                        <ul class="goods-list clearfix">
                            @foreach($goodsInfo as $v)
                            <li goods_id="{{$v->goods_id}}">
                                <a href="{{url("shopcontent/$v->goods_id")}}" class="g-pic">
                                    <img src="/uploads/{{$v['goods_img']}}" width="136" height="136">
                                </a>
                                <p class="g-name">
                                    <a href="{{url("shopcontent/$v->goods_id")}}">(第<i>368671</i>潮){{$v->goods_name}}</a>
                                </p>
                                <ins class="gray9">价值:￥{{$v->self_price}}</ins>
                                <div class="btn-wrap">
                                    <div class="Progress-bar">
                                        <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                        </p>
                                    </div>
                                    <div class="gRate" data-productid="23458">
                                        <a href="javascript:;" id="cart"><s></s></a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    @else
        @foreach($data as $v)
        <div class="buyrecord-con clearfix">
            <div class="record-img fl">
                <img src="/uploads/{{$v['goods_img']}}" alt="图片被恐龙吃掉了">
            </div>
            <div class="record-con fl">
                <h3>(第<i>87390潮</i>){{$v['goods_name']}}</h3>
                <p class="winner">获得者：<i>emmmm</i></p>
                <div class="clearfix">
                    <div class="win-wrapp fl">
                        <p class="w-time"></p>
                        <p class="w-chao">第<i>23568</i>潮正在进行中...</p>
                    </div>

                    <div class="fr">
                        <input type="hidden" value="{{$v['goods_id']}}">
                        <i class="buycart"  id="cartadd"></i>
                    </div>
                </div>


            </div>
        </div>
        @endforeach
    @endif
<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>
<script src="{{url('js/all.js')}}"></script>
<script src="{{url('js/index.js')}}"></script>
<script src="{{url('js/lazyload.min.js')}}"></script>
<script src="{{url('js/mui.min.js')}}"></script>
<script src="{{url('js/swiper.min.js')}}"></script>
<script src="{{url('js/photo.js')}}" charset="utf-8"></script>
<script>
    $(function () {
        //没有购买商品点击购物车
        $(document).on('click',"#cart",function () {
            var _this = $(this);
            var goods_id = _this.parents('li').attr('goods_id');
            var _token = $("#_token").val();
            $.post(
                "{{url('shopcartAdd')}}",
                {goods_id:goods_id,_token:_token},
                function(res) {
                    if(res==1)
                    {
                        layer.msg('已加入购物车');
                    }
                }
            )
        })
        //有购买记录
        $(document).on('click',"#cartadd",function () {
            var _this = $(this);
            var goods_id = _this.prev('input').val();
            console.log(goods_id);
            //return false;
            var _token = $("#_token").val();
            $.post(
                "{{url('shopcartAdd')}}",
                {goods_id:goods_id,_token:_token},
                function(res) {
                    if(res==1)
                    {
                        layer.msg('已加入购物车');
                    }
                }
            )
        })
    })

</script>

</body>
</html>
