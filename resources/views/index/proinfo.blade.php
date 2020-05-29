<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
    
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="{{env('UPLOADS_URL')}}{{$info->goods_img}}" />
     </div><!--sliderA/-->
     <table class="jia-len">
     
      <tr>
       <th><strong class="orange">{{$info->goods_price}}</strong></th>
       <td>
        <button class="decrease">-</button>
        <input type="text" id="buy_number" value="1" style="width:40px;" />
        <button class="increase">+</button>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$info->goods_name}} | <span>访问量:{{$visit}}</span></strong>
           
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
      
     </table>

     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品相册</a>
      <a href="javascript:;">商品详情</a>
      
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      @if($info->goods_imgs)
        @php $imgarr=explode('|',$info->goods_imgs);@endphp
        @foreach($imgarr as $img)
        <img src="{{env('UPLOADS_URL')}}{{$img}}" width="800">
        @endforeach
        @endif
     </div><!--proinfoList/-->
     <div class="proinfoList">
      {{$info->goods_desc}}
     </div><!--proinfoList/-->

     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" class="car" id="{{$info->goods_id}}">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
    <script>
    $(function () {
     $("#sliderA").excoloSlider();
    });
  </script>
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
  $('.spinnerExample').spinner({});
  </script>
  </body>
</html>
<script>
$(document).on("click",'.increase',function(){
  var buy_number=parseInt($('#buy_number').val());//获取文本框的值
        var goods_number=parseInt("{{$info->goods_number}}");//获取库存
        //判断文本框的值<库存
        if(buy_number<goods_number){
            buy_number=buy_number+1;
            $("#buy_number").val(buy_number);
        }
});

$(document).on("click",'.decrease',function(){
  var buy_number=parseInt($('#buy_number').val());//获取文本框的值
        if(buy_number>1){
            buy_number=buy_number-1;
            $("#buy_number").val(buy_number);
        }
});
$(document).on("blur","#buy_number",function(){
        var buy_number=parseInt($('#buy_number').val());//获取文本框的值
        var goods_number=parseInt("{{$info->goods_number}}");//获取库存
        //验证
        var reg=/^\d+$/;
        if(buy_number==''||parseInt(buy_number)<1||!reg.test(buy_number)){
            $("#buy_number").val(1);
        }else if(parseInt(buy_number)>goods_number){
            $("#buy_number").val(goods_number);
        }else{
            $("#buy_number").val(parseInt(buy_number));
        }
    })
$(document).on("click",'.car',function(){
  var _this=$(this);
  var id=_this.attr('id');
  var buy_number=$("#buy_number").val();
  $.ajax({
    url:"{{url('car/index')}}",
    data:{id:id,buy_number:buy_number},
    type:'post',
    dataType:'json',
    success:function(res){
      if(res.code==200){
        alert(res.font);
        window.location.href = "/car/cart";
      }else if(res.code==300){
        alert(res.font);
      }else if(res.code==400){
        alert(res.font);
        location.href = "/login?refer="+location.href;
      }
    }
  })
});

</script>