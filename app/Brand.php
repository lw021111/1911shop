<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    public $timestamps = false;
    protected $guarded = [];//黑名单
    
   // protected $fillable = ['字段'];//白名单

    

    public static function getBrandIndex($pageSize,$where){
    	return self::where($where)->orderby('brand_id','desc')->paginate($pageSize);
    }
}
