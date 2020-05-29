<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 管理员添加 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员管理</h2></center>
<form class="form-horizontal" role="form" method="post" action="{{url('admin/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称">
			<b style="color:red;">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" id="lastname" 
				   placeholder="请输入密码">
			<b style="color:red;">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" id="lastname" 
				   placeholder="请输入密码">
			<b style="color:red;">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-5">
			<input type="file" class="form-control" name="admin_img" id="lastname">    
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_tel" id="lastname" 
				   placeholder="请输入手机号">
			<b style="color:red;">{{$errors->first('admin_tel')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_email" id="lastname" 
				   placeholder="请输入邮箱">
			<b style="color:red;">{{$errors->first('admin_email')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>