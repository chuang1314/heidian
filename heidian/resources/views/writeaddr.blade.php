<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;" class="m-index-icon" id="save">保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">  
  
</form> -->
<form class="layui-form" action="">
  <div class="addrcon">
    <ul>
      <li><em>收货人</em><input type="text" id="address_name" placeholder="请填写真实姓名"></li>
      <li><em>手机号码</em><input type="number" id="address_tel" placeholder="请输入手机号"></li>
      <li><em>所在区域</em><input id="area" type="text"  name="input_area" placeholder="请选择所在区域"></li>
      <li class="addr-detail"><em>详细地址</em><input type="text" placeholder="20个字以内"  id="address_desc" class="addr"></li>
    </ul>
    <div class="setnormal"><span>设为默认地址</span><input type="checkbox" name="checked" id ="checked" lay-skin="switch">  </div>
  </div>
</form>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">

<!-- SUI mobile -->
<script src="{{url('dist/js/LArea.js')}}"></script>
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>

<script>
  //Demo
layui.use('form', function(){
  var form = layui.form();
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

</script>
<script>
    $(function () {
        $(document).on('click',"#save",function () {
            var obj = {};
            var reg1= /^\d{11}$/;
            obj.address_name = $("#address_name").val();
            obj.address_tel = $("#address_tel").val();
            obj.address_desc = $("#address_desc").val();
            obj.address_area = $("#area").val();
            var checked = $("#checked").prop('checked');
            var _token = $("#_token").val();
            //console.log(checked);
            if(checked==true){
                obj.is_default = 1;
            }else{
                obj.is_default = 2;
            }
            console.log(obj.address_name);
            if(obj.address_name == ''){
                layer.msg('收货人姓名不得为空');
                return false;
            }else if(obj.address_tel == ''){
                layer.msg('收货人电话不得为空');
                return false;
            }else if(!reg1.test( obj.address_tel)){
                layer.msg('收货人电话必须为11位纯数字');
                return false;
            }else if(obj.address_area == ''){
                layer.msg('收货人地址不得为空');
                return false;
            }else if(obj.address_desc == ''){
                layer.msg('收货人详细地址不得为空');
                return false;
            }
            //console.log(obj);

            $.post(
                "{{url('AddressAdd')}}",
                {obj:obj,_token:_token},
                function (res) {
                   if(res==1){
                       layer.msg('加入地址成功',{time:2000},function(){
                           location.href="{{url('AddressIndex')}}";
                       });
                   }else{
                       layer.msg('加入地址失败', {icon: 2});
                   }
                }
            )
        })
    })
</script>

</body>
</html>
