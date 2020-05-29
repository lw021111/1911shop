<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\StoreArticlePost;
use Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page?:1;
        $article_title=request()->article_title;
        $where=[];
        if($article_title){
            $where[]=['article_title','like',"%$article_title%"];
        }
        
        $info=Redis::get('info_'.$article_title);
        if(!$info){
            echo "DB==";
            $pageSize=config('app.pageSize');
            $info=Article::where($where)->paginate($pageSize);
            $info=serialize($info);
            Redis::setex('info_'.$article_title,60,$info);
        }
        $info= unserialize($info);
        return view('admin.article.index',['info'=>$info,'article_title'=>$article_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticlePost $request)
    {
        $data=$request->except('_token');
        $data['create_time']=time();
        if($request->hasFile('article_file')){
            $data['article_file']=$this->upload('article_file');
        }
        $res=Article::create($data);
        if($res){
            return redirect('/article');
        }
    }

    //文件上传
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $file=request()->$filename;
            $path=request()->$filename->store('uploads');
            return $path;
        }
        return '文件上传过程出错';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info=Article::find($id);
        return view('admin.article.edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticlePost $request, $id)
    {
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('article_file')){
            $data['article_file']=$this->upload('article_file');
        }
    
        $res=Article::where('article_id',$id)->update($data);
        if($res!==false){
            return redirect('/article');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id=request()->id;
        $res=Article::destroy($id);
        if($res){
            echo json_encode(['code'=>200,'font'=>'删除成功']);
        }else{
            echo json_encode(['code'=>300,'font'=>'删除成功']);
        }
    }
}
