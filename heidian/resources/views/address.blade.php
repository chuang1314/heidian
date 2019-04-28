<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/address.css')}}">
    <link rel="stylesheet" href="{{url('css/sm.css')}}">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('AddressAddIndex')}}" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    <div class="addr-list">
         <ul>
             @foreach($data as $v)
            <li class="clearfix" style="border-top: red solid 1px">
                <span class="fl">{{$v['address_name']}}</span>
                <span class="fr">{{$v['address_tel']}}</span>
            </li>
            <li>
                <p>{{$v['address_area']}}</p>
            </li>

            <li class="a-set" address_id = "{{$v['address_id']}}">
                @if($v['is_default']==1)
                    <s class="z-set" style="margin-top: 6px;"></s>
                    <span style="color: red">默认</span>
                @elseif($v['is_default']==2)
                    <span id="default" style="cursor:pointer">设为默认</span>
                @endif
                <div class="fr">
                    <a href="{{url("AddressUpdate/$v->address_id")}}"><span class="edit" style="cursor: pointer">编辑</span></a>
                    <span class="remove" style="cursor: pointer">删除</span>
                </div>
            </li>
            @endforeach
        </ul>  
    </div>
    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
   
</div>

<script src="{{url('js/zepto.js')}}" charset="utf-8"></script>
<script src="{{url('js/sm.js')}}"></script>
<script src="{{url('js/sm-extend.js')}}"></script>

<!-- 单选 -->
<script>
     // 删除地址
    $(document).on('click','span.remove', function () {
        var _this = $(this);
        var address_id = _this.parents('li').attr('address_id');
        var _token = $("#_token").val();
        //console.log(address_id);
        var buttons1 = [
            {
              text: '删除',
              bold: true,
              color: 'danger',
              onClick: function() {
                $.alert("您确定删除吗？",function(){
                    $.post(
                        "{{url('AddressDel')}}",
                        {address_id:address_id,_token:_token},
                        function (res) {
                            if(res==1){
                                history.go(0);
                            }
                        }
                    )
                });


              }
            }
          ];
          var buttons2 = [
            {
              text: '取消',
              bg: 'danger'
            }
          ];
          var groups = [buttons1, buttons2];
          $.actions(groups);
    });
</script>
<script src="js/jquery-1.8.3.min.js"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
            // jquery相关代码
            $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){
                    
                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }   
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
                
            }
        )

    });
    
</script>

<script>
    $(function () {
        //设为默认
        $(document).on('click',"#default",function () {
            var _this = $(this);
            var address_id = _this.parent('li').attr('address_id');
            var _token = $("#_token").val();
            //console.log(address_id);
            $.post(
                "{{url('AddressDefault')}}",
                {address_id:address_id,_token:_token},
                function (res) {
                        if(res==1){
                            history.go(0);
                        }
                }
            )
        })

        //编辑
        {{--$(document).on('click',".edit",function () {--}}
            {{--var _this = $(this);--}}
            {{--var address_id = _this.parents('li').attr('address_id');--}}
            {{--var _token = $("#_token").val();--}}
            {{--//console.log(address_id);--}}
            {{--$.post(--}}
                {{--"{{url('AddressDefault')}}",--}}
                {{--{address_id:address_id,_token:_token},--}}
                {{--function (res) {--}}
                    {{--if(res==1){--}}
                       {{----}}
                    {{--}--}}
                {{--}--}}
            {{--)--}}
        {{--})--}}
    })
</script>
</body>
</html>
