<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
class CarController extends Controller
{
    public function index(){
    	if(!session('res')){
    		echo json_encode(['font'=>'请先登陆','code'=>400]);die;
    	}
    	$id=request()->id;
    	$buy_number=request()->buy_number;
    	$user_id=session('res.user_id');
    	$where=[
            ['user_id','=',$user_id],
            ['goods_id','=',$id],
            ['is_del','=',1]
        ];
        $cartInfo=Cart::where($where)->first();
        $goodsWhere=[
        	['goods_id','=',$id]
        ];
        $goods_number=Goods::where($goodsWhere)->value('goods_number');
        if(!empty($cartInfo)){
            $num=$cartInfo['buy_number']+$buy_number;//数据库中已经购买数量+将要购买量
            //检测库存
            if ($num>$goods_number) {
                $num=$goods_number;
            }
            //累加
            $res=Cart::where($where)->update(['buy_number'=>$num,'add_time'=>time()]);
            if ($res) {
                echo json_encode(['code'=>200,'font'=>'添加购物车成功']);
            }else{
                echo json_encode(['code'=>300,'font'=>'添加购物车失败']);
            }
        }else{
             $num=$cartInfo['buy_number']+$buy_number;//数据库中已经购买数量+将要购买量
            //检测库存
            if ($num>$goods_number) {
                $num=$goods_number;
            }
            //添加
            //把商品id 购买数量 用户id 添加时间 存入购物车表中
            $arr=['goods_id'=>$id,'buy_number'=>$buy_number,'user_id'=>$user_id,'add_time'=>time(),'is_del'=>1];
            $res=Cart::create($arr);
            if ($res) {
                echo json_encode(['code'=>200,'font'=>'添加购物车成功']);
                //return redirect('car/cart');
            }else{
                echo json_encode(['code'=>300,'font'=>'添加购物车失败']);
            }
        }
    }

    public function cart(){
    	$user_id=session('res.user_id');
    	$where=[
    		['is_del','=',1],
    		['user_id','=',$user_id]
    	];
    	$info=Cart::join("goods","cart.goods_id","=","goods.goods_id")
                   	->where($where)
                    ->orderby('add_time','desc')
                    ->get();           
    	return view('index.car',['info'=>$info]);
    }

    //获取总价
    public function getMoney(){
        //接收商品id
        $goods_id=request()->goods_id;
        $user_id=session('res.user_id');
        
        $where=[
            ['cart.goods_id','in',$goods_id],
            ['user_id','=',$user_id],
            ['is_del','=',1]
        ];
        $cartInfo=Cart::
        leftjoin("goods","goods.goods_id","=","cart.goods_id")
        ->where($where)
        ->get('goods_price','buy_number');
        //循环 单价*数量
        $money=0;
        foreach ($cartInfo as $k => $v) {
            $money+=$v['goods_price']*$v['buy_number'];
        }
        echo $money;
    }

public function pay(){
    return view('index.pay');
}


}
