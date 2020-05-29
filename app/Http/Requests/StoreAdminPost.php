<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAdminPost extends FormRequest
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
            'admin_name' => [
                'regex:/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]{0,18}$/u',
                Rule::unique('admin')->ignore(request()->id,'admin_id')
            ],
            'admin_tel' => 'required|regex:/^1[34578]\d{9}$/', 
            'admin_email' => 'required|email',
            'admin_pwd' => 'required|same:admin_pwd|regex:/^[a-zA-Z0-9_]{6,12}$/',
        ];
    }

    public function messages(){ 
        return [ 
            'admin_name.required'=>'管理员名称必填',
            'admin_name.unique'=>'管理员名称已存在',
            'admin_name.regex'=>'管理员名称由中文字母数字组成、 不超过18位',
            'admin_tel.required'=>'手机号必填',
            'admin_tel.regex'=>'手机号格式不正确',
            'admin_email.required'=>'邮箱必填',
            'admin_email.email'=>'邮箱格式不正确',
            'admin_pwd.required'=>'密码必填',
            'admin_pwd.regex'=>'密码由6-12位数字 字母 下划线组成',
            'admin_pwd.same'=>'两次密码不一致',
        ]; 
    }

}
