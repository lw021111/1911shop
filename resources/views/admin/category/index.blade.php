<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类展示</title>
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
			<li><a href="{{url('/brand')}}">商品品牌</a></li>
			<li class="active"><a href="{{url('/category')}}">商品分类</a></li>
			<li><a href="{{url('/goods')}}">商品管理</a></li>
			<li><a href="{{url('/admin')}}">管理员管理</a></li>
	</div>
	</div>
</nav>
<center><h1>分类列表</h1></center>
<a href="{{url('category/create')}}" class="btn btn-primary">添加</a>
<table class="table table-hover">
	<caption>分类列表</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>是否在导航栏显示</th>
			<th>分类描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|一',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->is_show==1?'√':'×'}}</td>
			<td>{{$v->is_nav_show==1?'√':'×'}}</td>
			<td>{{$v->cate_desc}}</td>
			<td>
				<a href="{{url('category/edit/'.$v->cate_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="javascript:;" cate_id="{{$v->cate_id}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<script>
$(document).on('click',".btn-danger",function(){
	var _this=$(this);
	var id=_this.attr('cate_id');
	if(confirm('是否确认删除?')){
		$.ajax({
        	url:"{{url('category/destroy')}}",
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