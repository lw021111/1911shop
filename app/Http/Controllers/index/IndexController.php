<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	//$slice=Cache::get('slice');
        $slice=Redis::get('slice');
        //dump($slice);
    	$category=Cache::get('category');
    	//dump($slice);
    	if(!$slice){
    		echo "DB==";
    		//首页幻灯片
    		$slice=Goods::getSliceData();
    		//Cache::put('slice',$slice,60*60);
            $slice=serialize($slice);
            Redis::setex('slice',60,$slice);
    	}
        $slice=unserialize($slice);
    	//dd($slice);
    	if(!$category){
    		//echo "DB==";
    		//获取顶级分类
    		$category=Category::getTopData();
    		Cache::put('category',$category,60*60);
            //Redis::setex('slice',60,$slice);
    	}
    	//dd($category);
    	$info=Goods::all();
    	return view('index.index',['slice'=>$slice,'category'=>$category,'info'=>$info]);
    }
}
