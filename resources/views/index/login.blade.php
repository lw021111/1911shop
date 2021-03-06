    @extends('index.layouts.shop')
    @section('title', '登录页')
    @section('content')
    <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->

     <form action="{{url('/logindo')}}" method="post" class="reg-login">
     <input type="hidden" name="refer" @if(isset(request()->refer)) value="{{request()->refer}}" @endif>
      <h3>还没有微商城账号？点此<a class="orange" href="{{url('/register')}}">注册</a></h3>
      <b style="color: red;">{{session('msg')}}</b>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="username" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="text" name="pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     @include('index.common.footer')
    @endsection