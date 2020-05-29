<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章展示</title>
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
	
	</div>
</nav>
<center><h2>文章</h2></center>
<a href="{{url('article/create')}}" class="btn btn-primary">添加</a>
<form action="" method="">
	<input type="text" name="article_title" placeholder="请输入标题">
	<!-- <select name="article_cate">
			<option value="">--请选择--</option>
			<option value="1">散文</option>
			<option value="2">诗集</option>
			<option value="3">文言文</option>
			<option value="4">故事</option>
	</select> -->
	<button>搜索</button>
</form>
<table class="table table-hover">
	<caption>文章列表</caption>
	<thead>
		<tr>
			<th>编号</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>添加日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->article_id}}</td>
			<td>{{$v->article_title}}</td>
			<td>
				@if($v->article_cate==1)
				散文
				@elseif($v->article_cate==2)
				诗集
				@elseif($v->article_cate==3)
				文言文
				@else($v->article_cate==4)
				故事
				@endif
				
			</td>
			<td>{{$v->article_zhong==1?'普通':'置顶'}}</td>
			<td>{{$v->article_show==1?'√':'×'}}</td>
			<td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
			<td>
				<a href="{{url('article/edit/'.$v->article_id)}}" class="btn  btn-warning">编辑</a> || 
				<a href="javascript:;" class="btn btn-danger" article_id="{{$v->article_id}}">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=7 align="center">{{$info->appends(['article_title'=>$article_title])->links()}}</td></tr>
	</tbody>
</table>
<script>
$(document).on('click','.btn-danger',function(){
	var _this=$(this);
	var id=_this.attr('article_id');
	if(confirm('是否确认删除?')){
		$.ajax({
        	url:"{{url('article/destroy')}}",
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