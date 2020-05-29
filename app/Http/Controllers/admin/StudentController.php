<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //session应用
        //存储
        $request->session()->put('name','zhangsan');
        session(['class'=>'1911']);
        //获取
        echo $request->session()->get('name');
        echo session('class');

        //获取session所有  $_SESSION()
        dump($request->session()->all());

        //删除
        $request->session()->forget('name');
        session(['class'=>null]);

        dump($request->session()->get('name'));
        dump($request->session()->get('class'));
        //判断session里有没有此键
        dump($request->session()->has('name'));
        dump($request->session()->exists('name'));
    }

    public function setcookie(){
        //三种设置cookie的方式
        //return response('欢迎来到 Laravel 学院')->cookie('name','乐柠',1);
        //Cookie::queue(Cookie::make('name','沙河地铁',1));
        Cookie::queue('name','hello php',1);
    }
    public function getcookie(){
        //两种获取cookie
        //echo request()->cookie('name');
        echo Cookie::get('name');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->input();
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
