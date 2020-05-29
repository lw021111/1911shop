<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use Validator;
use App\Brand;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page??1;
        $brand_name=request()->brand_name;
        $info=Cache::get('info_'.$page.'_'.$brand_name);
        if(!$info){
            $where=[];
            if($brand_name){
                $where[]=['brand_name','like',"%$brand_name%"];
            }
            $pageSize=config('app.pageSize');
            //$info=DB::table('brand')->orderby('brand_id','desc')->paginate($pageSize);
            //ORM
            $info=Brand::getBrandIndex($pageSize,$where);
            Cache::put('info_'.$page.'_'.$brand_name,$info,60);
        }
        //ajax分页
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['info'=>$info,'brand_name'=>$brand_name]);
        }
        return view('admin.brand.index',['info'=>$info,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
    //public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种验证
        // $validatedData = $request->validate([ 
        //     'brand_name' => 'required|unique:brand', //验证|表名
        //     'brand_url' => 'required', 
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'网址必填',
        // ]);
        //接收值
        $data=$request->except('_token');
        $validator=Validator::make($data,[
            'brand_name' => 'required|unique:brand', 
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'网址必填',
        ]);
        if($validator->fails()){
            return redirect('brand/create')
                                ->withErrors($validator)
                                ->withInput();
        }
        //文件上传
        if($request->hasFile('brand_logo')){
            $data['brand_logo']=upload('brand_logo');
        }
        //$res=DB::table('brand')->insert($data);
        //ORM 第一种
        // $brand=new Brand();
        // $brand->brand_name=$data['brand_name'];
        // $brand->brand_url=$data['brand_url'];
        // $brand->brand_logo=$data['brand_logo'];
        // $brand->brand_desc=$data['brand_desc'];
        // $res=$brand->save();
        //ORM 第二种
        //$res=Brand::insert($data);
        //ORM 第三种
        $res=Brand::create($data);

        if($res){
            return redirect('/brand');
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
        //$info=DB::table('brand')->where('brand_id',$id)->first();
        //ORM
        $info=Brand::find($id);
        return view('admin.brand.edit',['info'=>$info]);
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
        $validatedData = $request->validate([ 
            'brand_name' => 'required', //验证|表名
            'brand_url' => 'required', 
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_url.required'=>'网址必填',
        ]);
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('brand_logo')){
            $data['brand_logo']=upload('brand_logo');
        }
        //$res=DB::table('brand')->where('brand_id',$id)->update($data);
        //ORM 第一种
        // $brand=Brand::find($id);
        // $brand->brand_name=$data['brand_name'];
        // $brand->brand_url=$data['brand_url'];
        // if(isset($data['brand_logo'])){
        //     $brand->brand_logo=$data['brand_logo'];
        // }
        // $brand->brand_desc=$data['brand_desc'];
        // $res=$brand->save();
        //ORM 第二种
        $res=Brand::where('brand_id',$id)->update($data);
        if($res!==false){
            return redirect('/brand');
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
        //$res=DB::table('brand')->where('brand_id',$id)->delete();
        //ORM
        $id=request()->id;
        $res=Brand::destroy($id);
        if($res){
            echo json_encode(['code'=>200,'font'=>'删除成功']);
        }else{
            echo json_encode(['code'=>300,'font'=>'删除失败']);
        }
    }



    //检查名称是否存在
    public function checkName(){
        $brand_name=request()->brand_name;
        $count=Brand::where('brand_name',$brand_name)->count();
        echo $count;
    }
}
