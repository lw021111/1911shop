    @extends('index.layouts.shop')
    @section('title', '购物车')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
     @foreach($info as $k=>$v)
      <table>
      @if($k==0)
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
       </tr>
      @endif
       <tr>
        <td width="4%"><input type="checkbox" goods_id="{{$v->goods_id}}" class="box" name="check" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>加入时间：{{date('Y-m-d H:i:s',$v->add_time)}}</time>
        </td>
        <td align="right">
          <button class="decrease">-</button>
        <input type="text" id="buy_number" value="{{$v->buy_number}}" style="width:40px;" />
        <button class="increase">+</button>
        </td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
      </table>
      @endforeach
      
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
  $('.spinnerExample').spinner({});
  </script>
  </body>
</html>

@endsection
<script src="/static/index/js/jquery.min.js"></script>
<script>


$(document).on('click',".jiesuan",function(res){
  var goods_id='';
  goods_id+=$('input[name="check"]:checked').attr('goods_id')+',';
  goods_id=goods_id.substr(0,goods_id.length-1);
  alert(goods_id);
})
</script>