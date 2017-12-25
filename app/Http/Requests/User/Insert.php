<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

//创建表单请求
class Insert extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        //dd($this->user());//能够获取,但不知通过什么判断
        return true;//false//用户访问权限
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            //
            'name'     => 'bail|required|unique:users,id|min:1',//bail第一次验证失败后停止,似乎不阻塞其他字段
            'password' => 'required',
        ];
    }

    //信息,重写方法,更多参见父类
    public function messages(){
        return [
            'name.required'     => ':attribute 必须传入',
            'password.required' => ':attribute 必须传入',
            //'array.key' => ':attribute 必须传入',//嵌套数组
        ];
    }

    //添加表单请求后钩子
    public function withValidator($validator){
        //添加表单请求后钩子=后置中间件,钩子=中间件,同一个概念
        $validator->after(function ($validator) {
            $validator->errors()->add('field', '233');
        });
    }
}
