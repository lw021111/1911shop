<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title> 文章添加 </title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>文章管理</h2></center>

<form class="form-horizontal" role="form" method="post" action="{{url('article/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="article_title" id="firstname" 
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
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="1" checked> 普通
	        <input type="radio" name="article_zhong" id="optionsRadios1" value="2"> 置顶
	    </div>
	</div>
	<div class="form-group">
	<label for="firstname" class="col-sm-2 control-label">是否显示</label>
	    <div>
	        <input type="radio" name="article_show" id="optionsRadios1" value="1" checked> 显示
	        <input type="radio" name="article_show" id="optionsRadios1" value="2"> 不显示
	    </div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="article_author" id="lastname" 
				   placeholder="请输入文章作者">
			<b style="color:red;">{{$errors->first('article_author')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="author_email" id="lastname" 
				   placeholder="请输入作者email">
			<b style="color:red;">{{$errors->first('author_email')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="article_keyword" id="lastname" 
				   placeholder="请输入关键字">
			<b style="color:red;">{{$errors->first('article_keyword')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-9">
			<textarea type="text" class="form-control" name="article_desc" id="lastname"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-7">
			<input type="file" class="form-control" name="article_file" id="lastname">    
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>