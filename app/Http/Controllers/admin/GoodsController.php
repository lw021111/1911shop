<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use App\Brand;
use Validator;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryInfo=Category::get();
        $categoryInfo=CreateTree($categoryInfo);
        //按商品名称搜索
        $goods_name=request()->goods_name;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        //按商品分类搜索
        $cate_id=request()->cate_id;
        if($cate_id){
            $where[]=['goods.cate_id','like',"%$cate_id%"];
        }
        //最小价格
        $min_price=request()->min_price;
        if($min_price){
            $where[]=['goods.goods_price','>=',$min_price];
        }
        //最大价格
        $max_price=request()->max_price;
        if($max_price){
            $where[]=['goods.goods_price','<=',$max_price];
        }

        $pageSize=config('app.pageSize');
        $info=Goods::leftjoin("category","goods.cate_id","=","category.cate_id")
                    ->leftjoin("brand","goods.brand_id","=","brand.brand_id")
                    ->where($where)
                    ->orderby('goods_id','desc')
                    ->paginate($pageSize);        
        //ajax分页
        if(request()->ajax()){
            return view('admin.goods.ajaxindex',['info'=>$info]);
        }
        return view('admin.goods.index',['info'=>$info,'goods_name'=>$goods_name,'cate_id'=>$cate_id,'categoryInfo'=>$categoryInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryInfo=Category::get();
        $categoryInfo=CreateTree($categoryInfo);
        $brandInfo=Brand::get();
        return view('admin.goods.create',['categoryInfo'=>$categoryInfo,'brandInfo'=>$brandInfo]);
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $validatedData = $request->validate([ 
            'goods_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:goods',
            'goods_number' => 'required|numeric|max:99999999|min:0',
            'goods_price' => 'required|numeric',
            'goods_sn' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'商品名称已存在',
            'goods_name.regex'=>'商品名称由2-50位中文、数字、字母、下划线组成',
            'goods_number.required'=>'商品库存必填',
            'goods_number.numeric'=>'商品库存由1-8位数字组成',
            'goods_number.max'=>'商品库存由1-8位数字组成',           
            'goods_price.required'=>'商品价格必填',
            'goods_price.numeric'=>'商品价格必须为数字',
            'goods_sn.required'=>'商品货号必填',
            'cate_id.required'=>'商品分类必选',
            'brand_id.required'=>'商品品牌必选',
        ]);
        
        //文件上传
        if($request->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        //多文件上传
        if(isset($data['goods_imgs'])){
            $data['goods_imgs']=Moreupload('goods_imgs');
            $data['goods_imgs']=implode('|',$data['goods_imgs']);
        }
        $res=Goods::create($data);
        if($res){
            return redirect('/goods');
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
        $categoryInfo=Category::get();
        $brandInfo=Brand::get();
        $categoryInfo=CreateTree($categoryInfo);
        $info=Goods::find($id);
        return view('admin.goods.edit',['info'=>$info,'categoryInfo'=>$categoryInfo,'brandInfo'=>$brandInfo]);
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
        $validatedData = $request->validate([ 
            'goods_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u', //|unique:goods
            'goods_number' => 'required|numeric|max:99999999|min:0',
            'goods_price' => 'required|numeric',
            'goods_sn' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            //'goods_name.unique'=>'商品名称已存在',
            'goods_name.regex'=>'商品名称由2-50位中文、数字、字母、下划线组成',
            'goods_number.required'=>'商品库存必填',
            'goods_number.numeric'=>'商品库存由1-8位数字组成',
            'goods_number.max'=>'商品库存由1-8位数字组成',           
            'goods_price.required'=>'商品价格必填',
            'goods_price.numeric'=>'商品价格必须为数字',
            'goods_sn.required'=>'商品货号必填',
            'cate_id.required'=>'商品分类必选',
            'brand_id.required'=>'商品品牌必选',
        ]);
        //文件上传
        if($request->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        //多文件上传
        if(isset($data['goods_imgs'])){
            $data['goods_imgs']=Moreupload('goods_imgs');
            $data['goods_imgs']=implode('|',$data['goods_imgs']);
        }
        $res=Goods::where('goods_id',$id)->update($data);
        if($res!==false){
            return redirect('/goods');
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
        $res=Goods::destroy($id);
        if($res){
            echo json_encode(['code'=>200,'font'=>'删除成功']);
        }else{
            echo json_encode(['code'=>300,'font'=>'删除失败']);
        }
    }

    //检查名称是否存在
    public function checkName(){
        $goods_name=request()->goods_name;
        $count=Goods::where('goods_name',$goods_name)->count();
        echo $count;
    }



}
