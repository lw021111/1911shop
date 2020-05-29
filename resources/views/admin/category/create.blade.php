<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 分类管理 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>商品分类</h1></center>
<form class="form-horizontal" role="form" method="post" action="store" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red;">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">父级分类</label>
	<div class="col-sm-10">
	    <select class="form-control" name="parent_id" id="firstname">
			<option value="0">--请选择--</option>
			@foreach($info as $k=>$v)
			<option value="{{$v->cate_id}}">{{str_repeat('|一',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
	    </select>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否显示</label>
	    <div>
	        <input type="radio" name="is_show" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_show" id="optionsRadios1" value="2"> 否
	        <b style="color:red;">{{$errors->first('is_show')}}</b>
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否在导航栏显示</label>
	    <div>
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="2" checked> 否
	        <b style="color:red;">{{$errors->first('is_nav_show')}}</b>
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="cate_desc" id="lastname"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>
$('input[name="cate_name"]').blur(function(){
	$(this).next().empty();
	var cate_name=$(this).val();
	if(!cate_name){
		$(this).next().text('分类名称不能为空');
		return;
	}
	//验证唯一性
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.post('/category/checkName',{cate_name:cate_name},function(res){
		if(res>0){
			$('input[name="cate_name"]').next().text('分类名称已存在');
		}
	})
});


$('button').click(function(){
	var cate_name=$('input[name="cate_name"]').val();
	if(!cate_name){
		$('input[name="cate_name"]').next().text('分类名称不能为空');
		return;
	}
	var flag=true;
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.ajax({
		url:"/category/checkName",
		type:'post',
		data:{cate_name:cate_name},
		async:false,
		success:function(res){
			if(res>0){
				$('input[name="cate_name"]').next().text('分类名称已存在');
				flag=false;
			}
		}
	});
	if(!flag) return;
	
	$('form').submit();

});


</script>
</body>
</html>