<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests\StoreAdminPost;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config('app.pageSize');
        $info=Admin::orderby('admin_id','desc')->paginate($pageSize);
        if(request()->ajax()){
            return view('admin.admin.ajaxindex',['info'=>$info]);
        }
        return view('admin.admin.index',['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminPost $request)
    {
        $data=$request->except('_token');
        $data['create_time']=time();
        if($request->hasFile('admin_img')){
            $data['admin_img']=upload('admin_img');
        }
        $res=Admin::create($data);
        if($res){
            return redirect('/admin');
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
        $info=Admin::find($id);
        return view('admin.admin.edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdminPost $request, $id)
    {
        $data=$request->except('_token');
        $data['create_time']=time();
        if($request->hasFile('admin_img')){
            $data['admin_img']=upload('admin_img');
        }
        $res=Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin');
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
        $res=Admin::destroy($id);
        if($res){
             echo json_encode(['code'=>200,'font'=>'删除成功']);
        }else{
            echo json_encode(['code'=>300,'font'=>'删除成功']);
        }
    }
}
