<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class ProlistController extends Controller
{
    public function index(){
    	$info=Goods::all();

    	return view('index.prolist',['info'=>$info]);
    }

    public function proinfo($id){
    	$visit=Cache::add('visit_'.$id,1)?1:Cache::increment('visit_'.$id);
    	//$info=Cache::get('info_'.$id);
    	//辅助函数
    	//$info=cache('info_'.$id);
        $info=Redis::get('info_'.$id);
    	//dump($info);
    	if(!$info){
    		echo "DB==";
    		$info=Goods::where('goods_id',$id)->first();
    		//Cache::put('info_'.$id,$info,60);
    		//辅助函数
    		//cache(['info_'.$id=>$info],60);
            $info=serialize($info);
            Redis::setex('info_'.$id,$info,60);
    	}
    	$info=unserialize($info);
    	
    	return view('index.proinfo',['info'=>$info,'visit'=>$visit]);
    }

}
