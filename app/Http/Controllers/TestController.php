<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
    	echo "我是首页";
    }
    public function test(){
    	return view('test');
    }
    public function test1(request $request){
    	//接收所有值
    	//$data=$request->all();
    	//$data=$request->post();
    	$data=$request->input();
    	dump($data);

    	//接收单个值
    	//$name=$request->name;
    	//$name=$request->post('name');
    	$name=$request->input('name');
    	dump($name);
    	
    	//排除接收****
    	//$num=$request->except('_token');
    	$num1=$request->except(['_token','tel']);
    	dump($num1);

    	//只接受****
    	//$num2=$request->only('name');
    	$num2=$request->only(['_token','tel']);
    	dd($num2);
    }

    public function goods($id,$name){
    	echo $id.'-'.$name;
    }
    public function show($id=0){
    	echo $id;
    }
    public function detail($id,$name=null){
    	echo $id.'-'.$name;
    }

}
