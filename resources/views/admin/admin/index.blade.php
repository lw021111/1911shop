<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员列表</title>
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
			<li><a href="{{url('/category')}}">商品分类</a></li>
			<li><a href="{{url('/goods')}}">商品管理</a></li>
			<li class="active"><a href="{{url('/admin')}}">管理员管理</a></li>
	</div>
	</div>
</nav>
<center><h2>管理员</h2></center>
<a href="{{url('admin/create')}}" class="btn btn-primary">添加</a><hr>
<table class="table table-hover">
	<caption>管理员列表</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>头像</th>
			<th>管理员名称</th>
			<th>手机号</th>
			<th>邮箱</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->admin_id}}</td>
			<td>
				@if($v->admin_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="50">
				@endif
			</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>			
			<td>{{$v->admin_email}}</td>
			<td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
			<td>
				<a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="javascript:;" admin_id="{{$v->admin_id}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=7 align="center">{{$info->links()}}</td></tr>
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
	var id=_this.attr('admin_id');
	if(confirm('是否确认删除?')){
		$.ajax({
			url:"{{url('admin/destroy')}}",
			data:{id:id},
			type:'post',
			dataType:'json',
			success:function(res){
				if(res.code==200){
					_this.parents("tr").remove();
				}else{
					alert(res.font);
				}
			}
		})
	}
})


</script>
</body>
</html>