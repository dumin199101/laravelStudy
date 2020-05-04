<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'=>'required|min:5|max:15',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required',
            'email'=>"required|email"
        ];
    }

    public function messages()
    {
        return [
            'username.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'password_confirmation.required'=>'确认密码不能为空',
            'email.required'=>'邮箱不能为空',
            'username.min'=>'用户名长度不能少于5位',
            'username.max'=>'用户名长度不能多于15位',
            'password.min'=>'密码长度不能少于5位',
            'password.confirmed'=>'密码跟确认密码不一致',
            'email.email'=>'邮箱格式不正确',
        ];
    }
}
