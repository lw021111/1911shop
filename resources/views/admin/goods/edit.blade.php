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
<form class="form-horizontal" role="form" method="post" action="{{url('goods/update/'.$info->goods_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" value="{{$info->goods_name}}" id="firstname" 
				   placeholder="请输入商品名称">
			<b style="color:red;">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_sn" value="{{$info->goods_sn}}" id="firstname" 
				   placeholder="请输入商品货号">
			<b style="color:red;">{{$errors->first('goods_sn')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" value="{{$info->goods_price}}" id="firstname" 
				   placeholder="请输入商品价格">
			<b style="color:red;">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_number" value="{{$info->goods_number}}" id="firstname" 
				   placeholder="请输入商品库存">
			<b style="color:red;">{{$errors->first('goods_number')}}</b>
		</div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">商品分类</label>
	<div class="col-sm-10">
	    <select class="form-control" name="cate_id" id="firstname">
			<option value="0">--请选择--</option>
			@foreach($categoryInfo as $k=>$v)
			<option value="{{$v->cate_id}}" {{$v->cate_id==$info->cate_id ? "selected" : ''}}>{{str_repeat('|一',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
	    </select>
	    <b style="color:red;">{{$errors->first('goods_number')}}</b>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
	<div class="col-sm-10">
	    <select class="form-control" name="brand_id" id="firstname">
			<option value="0">--请选择--</option>
			@foreach($brandInfo as $k=>$v)
			<option value="{{$v->brand_id}}" {{$v->brand_id==$info->brand_id ? "selected" : ''}}>{{$v->brand_name}}</option>
			@endforeach
	    </select>
	    <b style="color:red;">{{$errors->first('cate_id')}}</b>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否幻灯片展示</label>
	    <div>
	        @if(($info->is_slice)==1)
	        <input type="radio" name="is_slice" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_slice" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_slice" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_slice" id="optionsRadios1" value="2" checked> 否
	        @endif
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否上架</label>
	    <div>
	        @if(($info->is_show1)==1)
	        <input type="radio" name="is_show1" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_show1" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_show1" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_show1" id="optionsRadios1" value="2" checked> 否
	        @endif
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否新品</label>
	    <div>
	        @if(($info->is_new)==1)
	        <input type="radio" name="is_new" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_new" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_new" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_new" id="optionsRadios1" value="2" checked> 否
	        @endif
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否精品</label>
	    <div>
	        @if(($info->is_best)==1)
	        <input type="radio" name="is_best" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_best" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_best" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_best" id="optionsRadios1" value="2" checked> 否
	        @endif 
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="goods_img" id="lastname">    
		</div>
		@if($info->goods_img)
			<img src="{{env('UPLOADS_URL')}}{{$info->goods_img}}" width="50">
		@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="goods_imgs[]" id="lastname" multiple="multiple">    
		</div>
		

	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname">{{$info->goods_desc}}</textarea>
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