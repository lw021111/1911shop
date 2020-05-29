<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$info=DB::table('category')->get();
        //ORM操作
        $info=Category::get();
        $info=CreateTree($info);
        return view('admin.category.index',['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$info=DB::table('category')->get();
        //ORM操作
        $info=Category::get();
        $info=CreateTree($info);
        return view('admin.category.create',['info'=>$info]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'cate_name' => 'required|unique:category', //验证|表名
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
        ]);
        $data=$request->except('_token');
        //$res=DB::table('category')->insert($data);
        //ORM操作
        $res=Category::create($data);
        if($res){
            return redirect('/category');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$res=DB::table('category')->get();
        //$info=DB::table('category')->where('cate_id',$id)->first();
        //ORM操作
        $res=Category::get();
        $info=Category::find($id);
        return view('admin.category.edit',['info'=>$info,'res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        //$res=DB::table('category')->where('cate_id',$id)->update($data);
        //ORM操作
        $res=Category::where('cate_id',$id)->update($data);
        if($res){
            return redirect('/category');
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
        //$res=DB::table('category')->where('cate_id',$id)->delete();
        //ORM操作
        $id=request()->id;
        
        $res=Category::destroy($id);
        if($res){
            echo json_encode(['code'=>200,'font'=>'删除成功']);
        }else{
            echo json_encode(['code'=>300,'font'=>'删除失败']);
        }
    }



    //检查名称是否存在
    public function checkName(){
        $cate_name=request()->cate_name;
        $count=Category::where('cate_name',$cate_name)->count();
        echo $count;
    }

}
