<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 品牌修改 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌</h2></center>

<form class="form-horizontal" role="form" method="post" action="{{url('brand/update/'.$info->brand_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" value="{{$info->brand_name}}" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red;">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url" value="{{$info->brand_url}}" id="lastname" 
				   placeholder="请输入网址">
			<b style="color:red;">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">LOGO</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="brand_logo" id="lastname">    
		</div>
		@if($info->brand_logo)
			<img src="{{env('UPLOADS_URL')}}{{$info->brand_logo}}" width="50">
		@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc" id="lastname">{{$info->brand_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>