<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;
    protected $guarded = [];//黑名单

    public static function getGoodsIndex($pageSize){
    	return self::orderby('goods_id','desc')->paginate($pageSize);
    }

    public static function getSliceData(){
    	$where['is_slice']=1;
    	$where['is_show1']=1;
    	return self::select('goods_id','goods_img')->where($where)->take(5)->get();
    }

}
