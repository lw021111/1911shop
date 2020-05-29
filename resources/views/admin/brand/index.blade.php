<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="#">微商城</a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
			<li><a href="{{url('/category')}}">商品分类</a></li>
			<li><a href="{{url('/goods')}}">商品管理</a></li>
			<li><a href="{{url('/admin')}}">管理员管理</a></li>
	</div>
	</div>
</nav>
<center><h2>品牌</h2></center>
<a href="{{url('brand/create')}}" class="btn btn-primary">添加</a>
<hr>
<form>
	<input type="text" name="brand_name" value="" placeholder="请输入关键字">
	<button>搜索</button>
</form>
<table class="table table-hover">
	<caption>品牌列表</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>品牌名称</th>
			<th>网址</th>
			<th>logo</th>
			<th>描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>
				@if($v->brand_logo)
				<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="50">
				@endif
			</td>
			<td>{{$v->brand_desc}}</td>
			<td>
				<a href="{{url('brand/edit/'.$v->brand_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="javascript:;" brand_id="{{$v->brand_id}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=6 align="center">{{$info->appends(['brand_name'=>$brand_name])->links()}}</td></tr>
	</tbody>
</table>
<script>
//无刷新分页
$(document).on('click','.page-item a',function(){
	var url=$(this).attr('href');
	$.get(url,function(res){
		$('tbody').html(res);
	});
	return false;
});

$(document).on('click',".btn-danger",function(){
	var _this=$(this);
	var id=_this.attr('brand_id');
	if(confirm('是否确认删除?')){
		$.ajax({
        	url:"{{url('brand/destroy')}}",
	        type:'post',
	        data:{id:id},
	        dataType:'json',
	        success:function(res){
	          	if(res.code==200){
	            	//把当前行移除掉
	               	_this.parents("tr").remove();
	            }
	        }
	    });
	}
})




</script>
</body>
</html>