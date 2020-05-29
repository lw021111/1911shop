<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];//黑名单
    
    //protected $fillable = ['字段'];
    
    public static function getTopData(){
    	return self::select('cate_id','cate_name')->where(['parent_id'=>0,'is_nav_show'=>1])->take(4)->get();
    }
    
}
