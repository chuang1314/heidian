@extends('master')

@section('title', '黑市 购物车')

@section('content')
    <body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($goodsInfo as $v)
                <li self_price = "{{$v->self_price}}" goods_id ="{{$v->goods_id}}">
                    <s class="xuan current"></s>
                    <a class="fl u-Cart-img" href="{{url("shopcontent/$v->goods_id")}}">
                        <img src="/uploads/{{$v->goods_img}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="{{url("shopcontent/$v->goods_id")}}" class="gray6">(已更新至第338潮){{$v->goods_name}}</a>
                        <span class="gray9">
                            <em>价值：￥{{$v->self_price}}</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min"><i></i></em>
                            <input class="text_box" name="num" maxlength="6" type="text" value="{{$v->buy_number}}" codeid="12501977">
                            <em class="num-add add"><i></i></em>
                            <input type="hidden" value="{{$v->goods_id}}" class="input">
                        </div>
                        <input type="hidden" value="{{$v->goods_id}}" class="input">
                        <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del" id="delete"><s></s></a>
                    </div>
                </li>
                 @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>0.00</em></p>

                </dt>
                <dd>
                    <a href="javascript:;" id="del" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="buy" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    @foreach($data as $v)
                    <li goods_id="{{$v->goods_id}}">
                        <a href="{{url("shopcontent/$v->goods_id")}}" class="g-pic">
                            <img src="/uploads/{{$v['goods_img']}}" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="{{url("shopcontent/$v->goods_id")}}">(第<i>368671</i>潮){{$v['goods_name']}}</a>
                        </p>
                        <ins class="gray9">价值:￥{{$v['self_price']}}</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;" id="cart"><s ></s></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--底部导航-->
        <div class="footer clearfix" id="clearfix">
            <ul>
                <li class="f_home"><a href="{{url('index')}}"><i></i>潮购</a></li>
                <li class="f_announced"><a href="{{url('allshops')}}" ><i></i>所有商品</a></li>
                <li class="f_single"><a href="javascript:;" ><i></i>最新揭晓</a></li>
                <li class="f_car"><a id="btnCart" href="{{url('shopcart')}}"  class="hover" ><i></i>购物车</a></li>
                <li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
            </ul>
        </div>
    </div>
        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
@endsection

@section('my-js')
<!---商品加减算总数---->
<script type="text/javascript">
    $(function () {
        //点击加号
        $(".add").click(function () {
            var add = $(this).prev();
            var _this = $(this);
            add.val(parseInt(add.val()) + 1);
            var buy_num = _this.siblings("input[class='text_box']").val();
            var goods_id = _this.siblings("input[class='input']").val();
            var _token = $("#_token").val();
            //console.log(buy_num);
            $.post(
                "{{url('shopcartNum')}}",
                {buy_num:buy_num,_token:_token,goods_id:goods_id},
                function (res) {
                    // console.log(res);
                }
            );
            GetCount();
        });
        //点击减号
        $(".min").click(function () {
            var min = $(this).next();
            var _this = $(this);
            var buy_num = _this.siblings("input[class='text_box']").val()-1;
            var _token = $("#_token").val();
            var goods_id = _this.siblings("input[class='input']").val();
            if(min.val()>1){
                min.val(parseInt(min.val()) - 1);
                GetCount();
                $.post(
                    "{{url('shopcartNum')}}",
                    {buy_num:buy_num,_token:_token,goods_id:goods_id},
                    function (res) {
                        // console.log(res);
                    }
                )
            }

        })
        //数量框改变
        $(".text_box").blur(function () {
            var _this = $(this);
            var buy_num = _this.val();
            console.log(buy_num);
            var _token = $("#_token").val();
            var goods_id = _this.siblings("input[class='input']").val();
            //console.log(goods_id);
            $.post(
                "{{url('shopcartNum')}}",
                {buy_num:buy_num,_token:_token,goods_id:goods_id},
                function (res) {

                    console.log(res);
                }
            )
            GetCount();
        })
        //点击购物车
        $(document).on('click',"#cart",function () {
            var _this = $(this);
            var goods_id = _this.parents('li').attr('goods_id');
            console.log(goods_id);
            var _token = $("#_token").val();
            var that = $(this);
            $.post(
                "{{url('shopcartAdd')}}",
                {goods_id:goods_id,_token:_token},
                function(res) {
                    if(res==1)
                    {
                        history.go(0);
                    }
                }
            )
        })
    });
    //删除
    $(document).on('click',"#delete",function () {
        //alert(1);
        var _this = $(this);
        var goods_id = _this.prev('input').val();
        console.log( $(this).parents('li'));
        var _token = $("#_token").val();
        $.post(
            "{{url('shopcartDel')}}",
            {goods_id:goods_id,_token:_token},
            function (res) {
                if( res==1)
                {
                    layer.msg('删除成功',{time:2000},function(){
                        _this.parents('li').remove();
                        history.go(0);
                    });

                }

            }
        )
    });

    //批量删除
    $(document).on('click','#del',function () {
        var goods_id = '';
        var _this = $(this);
        var _token = $("#_token").val();
        $(".xuan").each(function(index){
            if($(this).prop('class')=="xuan current"){
                goods_id+=$(this).parents('li').attr('goods_id')+',';
            }
        });
        goods_id = goods_id.substr(0,goods_id.length-1);
        //console.log(goods_id);
        $.post(
            "{{url('shopcartDel')}}",
            {goods_id:goods_id,_token:_token},
            function (res) {
                if(res==1){
                    layer.msg('删除成功',{time:2000},function(){
                        $(".xuan").each(function () {
                            if($(this).prop('class')=='xuan current'){
                                $(this).parent('li').remove();
                                history.go(0);
                            }
                        });
                    });
                }else{
                    layer.msg('请至少勾选一件商品');
                }
            }
        )
        GetCount()
    });

    //点击结算
    $(document).on("click",'#buy',function () {
        var goods_id = '';
        var _this = $(this);
        var _token = $("#_token").val();
        $(".xuan").each(function(index){
            if($(this).prop('class')=="xuan current"){
                goods_id+=$(this).parents('li').attr('goods_id')+',';
            }
        });
        goods_id = goods_id.substr(0,goods_id.length-1);
        //console.log(goods_id);
        $.post(
            "{{url('paymentGoodId')}}",
            {goods_id:goods_id,_token:_token},
            function (res) {
                if(res==1){
                    location.href="{{url('PaymentIndex')}}";
                }else if(res==2){
                    layer.msg('请至少勾选一件商品');
                }
            }
        )
    });

    // 全选
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");
                } else {
                    $(this).addClass("current");
                }
            });
            GetCount();
        }else{
            $(this).addClass('current');

            $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }


    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');
        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
            $('.quanxuan').addClass('current');

        }else{
            $('.quanxuan').removeClass('current');
        }
        // $("#total2").html() = GetCount($(this));
        GetCount();
        //alert(conts);
    });
    // 已选中的总额
    function GetCount() {
        var conts = 0;
        var aa = 0;
        $(".xuan").each(function () {
            if($(this).prop('class')=='xuan current'){
                var buy_number=$(this).siblings("div[class='u-Cart-r']").find("input[class='text_box']").val();
                var self_price=$(this).parent('li').attr('self_price');
                conts+=parseInt(buy_number)*parseInt(self_price);
            }
            //console.log(self_price);
            $(".total").html('<span>￥</span>'+(conts).toFixed(2));
        })
    }
    GetCount();

</script>
@endsection