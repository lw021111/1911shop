<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 文章修改 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>文章管理</h2></center>

<form class="form-horizontal" role="form" method="post" action="{{url('article/update/'.$info->article_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="article_title" value="{{$info->article_title}}" id="firstname" 
				   placeholder="请输入文章标题">
			<b style="color:red;">{{$errors->first('article_title')}}</b>
		</div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">文章分类</label>
	<div class="col-sm-6">
	    <select class="form-control" name="article_cate" id="firstname">
			<option value="">--请选择--</option>
			<option value="1">散文</option>
			<option value="2">诗集</option>
			<option value="3">文言文</option>
			<option value="4">故事</option>
	    </select>
	    <b style="color:red;">{{$errors->first('article_cate')}}</b>
    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
	    <div>
	    	@if(($info->article_zhong)==1)
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="1" checked> 普通
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="2"> 置顶
	        @else
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="1"> 普通
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="2" checked> 置顶
	        @endif
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否显示</label>
	    <div>
	    	@if(($info->atticle_show)==1)
	        <input type="radio" name="article_show" id="optionsRadios1" value="1" checked> 显示
	        <input type="radio" name="article_show" id="optionsRadios1" value="2"> 不显示
			@else
			<input type="radio" name="article_show" id="optionsRadios1" value="1"> 显示
	        <input type="radio" name="article_show" id="optionsRadios1" value="2" checked> 不显示
	        @endif
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="article_author" value="{{$info->article_author}}" id="lastname" 
				   placeholder="请输入文章作者">
			<b style="color:red;">{{$errors->first('article_author')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="author_email" value="{{$info->author_email}}" id="lastname" 
				   placeholder="请输入作者email">
			<b style="color:red;">{{$errors->first('author_email')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="article_keyword" value="{{$info->article_keyword}}" id="lastname" 
				   placeholder="请输入关键字">
			<b style="color:red;">{{$errors->first('article_keyword')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-9">
			<textarea type="text" class="form-control" name="article_desc" id="lastname">{{$info->article_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="article_file" id="lastname">    
		</div>
		@if($info->article_file)
			<img src="{{env('UPLOADS_URL')}}{{$info->article_file}}" width="50">
		@endif
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>