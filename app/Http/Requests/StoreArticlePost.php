<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreArticlePost extends FormRequest
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
            'article_title' => [
                'regex:/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]{0,18}$/u',
                Rule::unique('article')->ignore(request()->id,'article_id')
            ],
            'article_cate' => 'required', 
            
        ];
    }
    public function messages(){ 
        return [ 
            'article_title.required'=>'文章标题必填',
            'article_title.unique'=>'文章标题已存在',
            'article_title.regex'=>'文章标题由中文字母数字组成',
            'article_cate.required'=>'文章分类必填',
            
        ]; 
    }
}
