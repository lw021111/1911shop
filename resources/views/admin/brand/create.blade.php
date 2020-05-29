<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 品牌添加 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌</h2></center>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger"> 
		<ul>
			@foreach ($errors->all() as $error) 
				<li>{{ $error }}</li> 
			@endforeach
		</ul> 
	</div> 
@endif -->
<form class="form-horizontal" role="form" method="post" action="store" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red;">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url" id="lastname" 
				   placeholder="请输入网址">
			<b style="color:red;">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">LOGO</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="brand_logo" id="lastname">    
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc" id="lastname"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>
$('input[name="brand_name"]').blur(function(){
	$(this).next().empty();
	var brand_name=$(this).val();
	if(!brand_name){
		$(this).next().text('品牌名称不能为空');
		return;
	}
	//验证唯一性
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.post('/brand/checkName',{brand_name:brand_name},function(res){
		if(res>0){
			$('input[name="brand_name"]').next().text('品牌名称已存在');
		}
	})
});
$('input[name="brand_url"]').blur(function(){
	$(this).next().empty();
	var brand_url=$(this).val();
	if(!brand_url){
		$(this).next().text('品牌网址不能为空');
		return;
	}
});

$('button').click(function(){
	var brand_name=$('input[name="brand_name"]').val();
	if(!brand_name){
		$('input[name="brand_name"]').next().text('品牌名称不能为空');
		return;
	}
	var flag=true;
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.ajax({
		url:"/brand/checkName",
		type:'post',
		data:{brand_name:brand_name},
		async:false,
		success:function(res){
			if(res>0){
				$('input[name="brand_name"]').next().text('品牌名称已存在');
				flag=false;
			}
		}
	});
	if(!flag) return;
	var brand_url=$('input[name="brand_url"]').val();
	if(!brand_url){
		$('input[name="brand_url"]').next().text('品牌网址不能为空');
		return;
	}
	
	$('form').submit();

});


</script>
</body>
</html>