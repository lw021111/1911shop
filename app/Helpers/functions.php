<?php 
	//文件上传
    function upload($filename){
        if(request()->file($filename)->isValid()){
            $file=request()->$filename;
            $path=request()->$filename->store('uploads');
            return $path;
        }
        return '文件上传过程出错';
    }

    //多文件上传
    function Moreupload($filename){
        $files=request()->$filename;
        if(!count($files)){
            return;
        }
        foreach ($files as $k => $v) {
            $path[]=$v->store('uploads');
        }
        return $path;
    }

    //无限极分类
    function CreateTree($info,$parent_id=0,$level=0){
        if(!$info) return;
        static $newArray=[];
        foreach ($info as $k => $v) {
            if ($v->parent_id==$parent_id) {
                $v->level=$level;
                $newArray[]=$v;
               	CreateTree($info,$v->cate_id,$level+1);
            }
        }
        return $newArray;
    }

 ?>