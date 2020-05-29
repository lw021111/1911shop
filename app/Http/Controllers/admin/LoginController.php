<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function index(){
    	return view('admin.login');
    }

    public function logindo(Request $request){
    	$data=$request->except('_token');
    	//dump($data);
    	$res=Admin::where('admin_name',$data['admin_name'])->first();
    	//dd($res['admin_pwd']);
    	if($res['admin_pwd']!=$data['admin_pwd']){
    		return redirect('/')->with('msg','用户名或密码错误');
    	}
    	//七天免登陆
    	if(isset($data['isremember'])){
    		Cookie::queue('res',serialize($res),60*24*7);
    	}

    	session(['res'=>$res]);
    	return redirect('/goods');
    }

    //退出
    public function quit(){
    	request()->session()->flush();
    	return redirect('/');
    }


}
