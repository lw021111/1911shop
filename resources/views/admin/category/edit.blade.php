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
<center><h2>商品分类</h2></center>
<form class="form-horizontal" role="form" method="post" action="{{url('category/update/'.$info->cate_id)}}">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" value="{{$info->cate_name}}" id="firstname" 
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">父级分类</label>
	<div class="col-sm-10">
	    <select name="parent_id">
			<option value="0">--请选择--</option>
			@foreach($res as $k=>$v)
				<option value="{{$v->cate_id}}" {{$v->cate_id==$info->parent_id ? "selected" : ''}}>{{$v->cate_name}}</option>
			@endforeach
	    </select>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否显示</label>
	    <div>
	    	@if(($info->is_show)==1)
	        <input type="radio" name="is_show" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_show" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_show" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_show" id="optionsRadios1" value="2" checked> 否
	        @endif
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否在导航栏显示</label>
	    <div>
	    	@if(($info->is_nav_show)==1)
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="1" checked> 是
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="2"> 否
	        @else
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="1"> 是
	        <input type="radio" name="is_nav_show" id="optionsRadios1" value="2" checked> 否
	        @endif
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="cate_desc" id="lastname">{{$info->cate_desc}}</textarea>
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