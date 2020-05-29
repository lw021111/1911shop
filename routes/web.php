<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('hello', function () {
    echo "hello PHP";
});

//走控制器路由
Route::get('index','TestController@index');

//视图路由
// Route::get('test', function () {
//     return view('test');
// });
//Route::get('test','TestController@test');
//Route::view('test','test');

Route::post('test1','TestController@test1');

//注册一个路由支持多种请求方式
//Route::any('test','TestController@test');
Route::match(['get','post'],'test','TestController@test');

//必选参数
Route::get('user/{id}', function ($id) {
    return 'User ' . $id;
});
// Route::get('goods/{id}', function ($id) {
//     return 'goods ' . $id;
// });
Route::get('goods/{id}/{name}','TestController@goods')->where(['name'=>'[a-zA-Z]+']);//约束

// 约束
// Route::get('user/{id}', function ($id) {
//     return 'User ' . $id;
// })->where('id','\d+');
// Route::get('goods/{id}/{name}','TestController@goods')->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);

//可选参数
Route::get('show/{id?}','TestController@show');
Route::get('detail/{id}/{name?}','TestController@detail');

Route::domain('admin.1911.com')->group(function(){
	//品牌管理
	Route::prefix('brand')->middleware('login')->group(function(){
		//列表
		Route::get('/','admin\BrandController@index');
		//添加视图
		Route::get('create','admin\BrandController@create');
		Route::post('store','admin\BrandController@store');	
		//编辑
		Route::get('edit/{id}','admin\BrandController@edit');
		Route::post('update/{id}','admin\BrandController@update');
		//删除
		Route::post('destroy','admin\BrandController@destroy');

		Route::post('checkName','admin\BrandController@checkName');
	});
	//分类管理
	Route::prefix('category')->middleware('login')->group(function(){
		Route::get('/','admin\CategoryController@index');
		Route::get('create','admin\CategoryController@create');
		Route::post('store','admin\CategoryController@store');	
		Route::get('edit/{id}','admin\CategoryController@edit');
		Route::post('update/{id}','admin\CategoryController@update');
		Route::post('destroy','admin\CategoryController@destroy');
		Route::post('checkName','admin\CategoryController@checkName');
	});
	//商品管理
	Route::prefix('goods')->middleware('login')->group(function(){
		Route::get('/','admin\GoodsController@index');
		Route::get('create','admin\GoodsController@create');
		Route::post('store','admin\GoodsController@store');	
		Route::get('edit/{id}','admin\GoodsController@edit');
		Route::post('update/{id}','admin\GoodsController@update');
		Route::post('destroy','admin\GoodsController@destroy');
		Route::post('checkName','admin\GoodsController@checkName');
	});
	//管理员
	Route::prefix('admin')->middleware('login')->group(function(){
		Route::get('/','admin\AdminController@index');
		Route::get('create','admin\AdminController@create');
		Route::post('store','admin\AdminController@store');	
		Route::get('edit/{id}','admin\AdminController@edit');
		Route::post('update/{id}','admin\AdminController@update');
		Route::post('destroy','admin\AdminController@destroy');
		Route::post('checkName','admin\AdminController@checkName');
	});
	//后台
	Route::get('/','admin\LoginController@index');
	Route::post('/logindo','admin\LoginController@logindo');
	Route::get('/quit','admin\LoginController@quit');
});

Route::domain('www.1911.com')->group(function(){
	//微商城前台首页
	Route::get('/','index\IndexController@index');
	Route::get('/login','index\LoginController@login');
	Route::get('/quit','index\LoginController@quit');
	Route::post('/logindo','index\LoginController@logindo');
	Route::get('/register','index\LoginController@register');
	Route::post('/registerdo','index\LoginController@registerdo');
	Route::get('prolist/index','index\ProlistController@index');//列表页
	Route::get('prolist/proinfo/{id}','index\ProlistController@proinfo');//详情页
	Route::any('car/index','index\CarController@index');
	Route::any('car/cart','index\CarController@cart')->middleware('checknumber');//购物车
	Route::any('car/getmoney','index\CarController@getMoney');
	Route::any('car/pay','index\CarController@pay');
	Route::get('user/index','index\UserController@index');
	Route::any('/sendSms','index\LoginController@sendSms');
	Route::any('/sendEmail','index\LoginController@sendEmail');
});




Route::prefix('article')->middleware('login')->group(function(){
	Route::get('/','admin\ArticleController@index');
	Route::get('create','admin\ArticleController@create');
	Route::post('store','admin\ArticleController@store');	
	Route::get('edit/{id}','admin\ArticleController@edit');
	Route::post('update/{id}','admin\ArticleController@update');
	Route::post('destroy','admin\ArticleController@destroy');
});
Route::prefix('student')->group(function(){
	Route::get('/list','admin\StudentController@index');
	Route::get('/create','admin\StudentController@create');
	Route::post('/store','admin\StudentController@store');
	//cookie练习
	Route::get('/setcookie','admin\StudentController@setcookie');
	Route::get('/getcookie','admin\StudentController@getcookie');
});