    @extends('index.layouts.shop')
    @section('title', '注册页')
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
     <form action="{{url('/registerdo')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <b style="color: red;">{{session('msg')}}</b>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="username" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <b style="color: red;">{{session('msg')}}</b>
       <div class="lrList"><input type="text" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
    <script src="/static/index/js/jquery.min.js"></script>
    <script>
    $(document).on('click','button',function(){
      var username=$('input[name="username"]').val();
      var telreg=/^1[3|4|5|6|7|8|9]\d{9}$/;
      var emailreg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
      if(telreg.test(username)){
        //手机号发送验证码
        $.get('/sendSms',{username:username},function(res){     
            alert(res.msg);          
        },'json');
      }else if(emailreg.test(username)){
        //邮箱发送验证码
        $.get('/sendEmail',{username:username},function(res){      
            alert(res.msg);        
        },'json');
      }else{
        alert('请输入正确的手机号或邮箱');
      }

    });

    </script>

@include('index.common.footer')
    @endsection