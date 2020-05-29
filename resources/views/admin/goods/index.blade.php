<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品展示</title>
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
			<li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
			<li><a href="{{url('/admin')}}">管理员管理</a></li>
			<li><a style="float: right;">欢迎 [ {{session('res')->admin_name}} ]</a></li>
		</ul>
		<a href="{{url('/quit')}}">退出</a>
	</div>
	</div>
</nav>
<center><h2>商品</h2></center>
<a href="{{url('goods/create')}}" class="btn btn-primary">添加</a><hr>
<form action="" method="">
	<input type="text" name="goods_name" value="{{$goods_name}}" placeholder="请输入商品名称关键字">
	<input type="text" name="min_price" placeholder="最小价格">-
	<input type="text" name="max_price" placeholder="最大价格">
	<select name="cate_id">
		<option value="">请选择商品分类</option>
		@foreach($categoryInfo as $v)
		<option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected" @endif>{{str_repeat('|一',$v->level)}}{{$v->cate_name}}</option>
		@endforeach
	</select>	
	<button>搜索</button>
</form>
<hr>
<table class="table table-hover">
	
	<thead>
		<tr>
			<th>ID</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>是否上架</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品主图</th>
			<th>商品相册</th>
			<th>商品详情</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->is_show1==1?'√':'×'}}</td>
			<td>{{$v->is_new==1?'√':'×'}}</td>
			<td>{{$v->is_best==1?'√':'×'}}</td>
			<td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="50">
				@endif
			</td>
			<td>
				@if($v->goods_imgs)
				@php $imgarr=explode('|',$v->goods_imgs);@endphp
				@foreach($imgarr as $img)
				<img src="{{env('UPLOADS_URL')}}{{$img}}" width="50">
				@endforeach
				@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td>
				<a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="javascript:;" goods_id="{{$v->goods_id}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=14 align="center">{{$info->appends(['goods_name'=>$goods_name])->links()}}</td></tr>
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
	var id=_this.attr('goods_id');
	if(confirm('是否确认删除?')){
		$.ajax({
			url:"{{url('goods/destroy')}}",
			type:'post',
			data:{id:id},
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