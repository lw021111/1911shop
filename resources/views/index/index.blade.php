    @extends('index.layouts.shop')
    @section('title', '首页')
    @section('content')
    <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="{{url('user/index')}}"><img src="/static/index/images/user5.jpg" /></a></dt>
       <dd>
       @if(session('res'))
        <h1 class="username" style="color: red;">{{session('res')->username}}</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
    
    @else
    <h1 class="username"></h1>
      <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('login')}}">登录</a></li>
      <li><a href="{{url('register')}}" class="rlbg">注册</a></li>
    @endif
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
    @if($slice)
    @foreach($slice as $v)
      <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" />
    @endforeach
    @endif
     </div><!--sliderA/-->
     <ul class="pronav">
    @if($category)
    @foreach($category as $v)
      <li><a href="{{url('/cate/'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
    @endforeach
    @endif 
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @foreach($info as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('prolist/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="500px;" height="400px;" /></a></dt>
        <dd class="ip-text"><a href="{{url('prolist/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></dd>
       </dl>
      </div>
      @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
     @foreach($info as $v)
      <dl>
       <dt><a href="{{url('prolist/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('prolist/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @include('index.common.footer')
     @endsection
     