<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 商品管理 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>商品管理</h1></center>
<form class="form-horizontal" role="form" method="post" action="{{url('goods/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入商品名称">
			<b style="color:red;">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_sn" id="firstname" 
				   placeholder="请输入商品货号">
			<b style="color:red;">{{$errors->first('goods_sn')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" id="firstname" 
				   placeholder="请输入商品价格">
			<b style="color:red;">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_number" id="firstname" 
				   placeholder="请输入商品库存">
			<b style="color:red;">{{$errors->first('goods_number')}}</b>
		</div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">商品分类</label>
	<div class="col-sm-6">
	    <select class="form-control" name="cate_id" id="firstname">
			<option value="">--请选择--</option>
			@foreach($categoryInfo as $k=>$v)
			<option value="{{$v->cate_id}}">{{str_repeat('|一',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
	    </select>
	    <b style="color:red;">{{$errors->first('cate_id')}}</b>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
	<div class="col-sm-6">
	    <select class="form-control" name="brand_id" id="firstname">
			<option value="">--请选择--</option>
			@foreach($brandInfo as $k=>$v)
			<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
			@endforeach
	    </select>
	    <b style="color:red;">{{$errors->first('brand_id')}}</b>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否幻灯片展示</label>
	    <div>
	        <input type="radio" name="is_slice" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_slice" id="optionsRadios1" value="2" checked> 否
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否上架</label>
	    <div>
	        <input type="radio" name="is_show1" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_show1" id="optionsRadios1" value="2"> 否
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否新品</label>
	    <div>
	        <input type="radio" name="is_new" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_new" id="optionsRadios1" value="2"> 否  
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否精品</label>
	    <div>
	        <input type="radio" name="is_best" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_best" id="optionsRadios1" value="2"> 否  
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_img" id="lastname">    
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_imgs[]" id="lastname" multiple="multiple">    
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>
$('input[name="goods_name"]').blur(function(){
	$(this).next().empty();
	var goods_name=$(this).val();
	var reg=/^[\u4e00-\u9fa5\w]{2,50}$/;
	if(!reg.test(goods_name)){
		$(this).next().text('商品名称可以包含中文,数字,字母,下划线且唯一,长度范围为2-50位');
		return;
	}
	//验证唯一性
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.post('/goods/checkName',{goods_name:goods_name},function(res){
		if(res>0){
			$('input[name="goods_name"]').next().text('商品名称已存在');
		}
	})
});
$('input[name="goods_sn"]').blur(function(){
	$(this).next().empty();
	var goods_sn=$(this).val();
	if(!goods_sn){
		$(this).next().text('商品货号不能为空');
		return;
	}
});
$('input[name="goods_price"]').blur(function(){
	$(this).next().empty();
	var goods_price=$(this).val();
	if(!goods_price){
		$(this).next().text('商品价格不能为空');
		return;
	}
});
$('input[name="goods_number"]').blur(function(){
	$(this).next().empty();
	var goods_number=$(this).val();
	if(!goods_number){
		$(this).next().text('商品库存不能为空');
		return;
	}
});


$('button').click(function(){
	var goods_name=$('input[name="goods_name"]').val();
	var reg=/^[\u4e00-\u9fa5\w]{2,50}$/;
	if(!reg.test(goods_name)){
		$('input[name="goods_name"]').next().text('商品名称可以包含中文,数字,字母,下划线且唯一,长度范围为2-50位');
		return;
	}
	var flag=true;
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$.ajax({
		url:"/goods/checkName",
		type:'post',
		data:{goods_name:goods_name},
		async:false,
		success:function(res){
			if(res>0){
				$('input[name="goods_name"]').next().text('商品名称已存在');
				flag=false;
			}
		}
	});
	if(!flag) return;
	var goods_sn=$('input[name="goods_sn"]').val();
	if(!goods_sn){
		$('input[name="goods_sn"]').next().text('商品货号不能为空');
		return;
	}

	var goods_price=$('input[name="goods_price"]').val();
	if(!goods_price){
		$('input[name="goods_price"]').next().text('商品价格不能为空');
		return;
	}
	var goods_number=$('input[name="goods_number"]').val();
	if(!goods_number){
		$('input[name="goods_number"]').next().text('商品库存不能为空');
		return;
	}
	
	$('form').submit();

});


</script>
</body>
</html>