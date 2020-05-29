<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreGoodsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goods_name' => [
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                 Rule::unique('goods')->ignore(request()->id,'goods_id')
                ]
            'goods_number' => 'required|numeric|max:99999999|min:0',
            'goods_price' => 'required|numeric',
            'goods_sn' => 'required',
            'cate_id' => 'required',
            'brand_id' => 'required', 
        ];
    }

    public function messages(){ 
        return [ 
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'商品名称已存在',
            'goods_name.regex'=>'商品名称由2-50位中文、数字、字母、下划线组成',
            'goods_number.required'=>'商品库存必填',
            'goods_number.numeric'=>'商品库存由1-8位数字组成',
            'goods_number.max'=>'商品库存由1-8位数字组成',           
            'goods_price.required'=>'商品价格必填',
            'goods_price.numeric'=>'商品价格必须为数字',
            'goods_sn.required'=>'商品货号必填',
            'cate_id.required'=>'商品分类必选',
            'brand_id.required'=>'商品品牌必选',
        ]; 
    }


}
