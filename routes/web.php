<?php

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

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

Route::get( '/', function(){
    return view( 'welcome' );
} );

Route::resource( 'users', 'UserController' );

Route::get( 'view', function(){
    return view( 'view' );
} );

Route::get( 'error', function(){
    return view( 'error' );
} );

//编写验证逻辑
//空白原因:如果错误,laravel自动回退提交页,所以拿不到错误数据;如果需要打印错误信息,可用给ajax请求得到json,,或使用make验证
//postman发送ajax:Content-Type设置为application/json,X-Requested-With设置为XMLHttpRequest,laravel会返回422状态的json,不会重定向
Route::post( 'validate', function( \Illuminate\Http\Request $request ){
    //return [ 'empty' => $request->input( 'empty' ) ];//
    //显示验证错误
    $request->validate( [
        'name'     => 'bail|required|unique:users,id|min:1',//bail第一次验证失败后停止
        'password' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );//参数1:字段数组;参数2:信息数组

    return [
        'request'  => $request,
        'name'     => $request->input( 'name' ),
        'password' => $request->input( 'password' ),
    ];
} );

//表单请求验证
//搭配使用
Route::post( 'make/request', function( App\Http\Requests\User\Insert $request ){
    return [
        'request'  => $request,
        'name'     => $request->input( 'name' ),
        'password' => $request->input( 'password' ),
    ];
} );

//手动创建验证器
Route::post( 'make', function( \Illuminate\Http\Request $request ){
    //$validator = Validator::make( $request->all(), [ 'name' => 'required' ] )->fails();
    $validator = Validator::make( $request->all(), [ 'name' => 'required' ] );//可以连续使用
    if( $validator->fails() ){
        return 0;//redirect('post/create')->withErrors($validator)->withInput();//如果跳转,带上错误和输入
    }

    return 1;
} );

//手动创建验证器-自动重定向
//或返回json
Route::post( 'make/request', function( \Illuminate\Http\Request $request ){
    Validator::make( $request->all(), [
        'name'     => 'required',
        'password' => 'required',
    ] )->validate();
} );

//命名错误包
Route::post( 'make/request/with/error', function( \Illuminate\Http\Request $request ){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );

    $validator->after( function( $validator ){//后钩子,后置中间件,等价于新建类的withValidator
        $validator->errors()->add( 'after', 'after field' );//添加字段
    } );

    if( $validator->fails() ){
        return redirect( 'error' )->withErrors( $validator, 'login' );//->withInput()影响输入值,不影响报错
    }
} );

//验证后钩子
Route::post( 'make/request/after', function( \Illuminate\Http\Request $request ){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );

    $validator->after( function( $validator ){//后钩子,后置中间件,等价于新建类的withValidator
        $validator->errors()->add( 'after', 'after field' );//添加字段
    } );

    if( $validator->fails() ){
        $validator->validate();
    }
} );

//处理错误消息
Route::post( 'errors', function( \Illuminate\Http\Request $request ){
    //dd( $request->input());
    //dd( $request->all());
    $validator = Validator::make( $request->all(), [
        'name' => [
            //'required',//必需
            //'accepted',//yes, on, 1, true.服务条款是否同意
            //'active_url',//成功解析, a记录或aaaa记录
            //'after:tomorrow',//明天以后//与before相对应
            //'after:start_date',//开始时间(一个传入的验证字段)以后
            //'after_or_equal:tomorrow',//明天或以后
            //'alpha',//字母:包括汉字等其他语言字符, 但不包括标点
            //'alpha_dash',//字母及数字,破折号,下划线
            //'alpha_num',//字母及数字
            //'array',//数组
            //'between:1,2',//size:字符串长度,数组元素数量,文件kb大小等
            //'boolean',//布尔值,true应该也正常.但不知postman如何发送true
            //'confirmed',//确认X_confirmation
            //'date',//合法日期
            //'date_equals:name',//等于日期:格式可以形如2017-12-31,也可以是一个传入字段
            //'date_format:Y-m-d',//日期格式
            //'different:field',//不同:只能是字段
            //'digits:1',//n位数字
            //'digits_between:0,2',//若干位数字
            //'dimensions:min_width=300,min_height=300',//图片尺寸
            // Rule::dimensions()->minWidth(1)->minHeight(1),//图片尺寸-方法模式
            //'distinct',//不同,验证数组
            //'email',//邮箱格式
            //'exists:users,name',//数据库表存在字段;不加会自动映射
            // Rule::exists( 'users' ,'name')->where( function( $query ){ $query->where( 'email','email1' );} ),//更多条件//额外的条件,与存在不同
            //'file',//文件
            //'filled',//存在时不能为空,但可以不存在
            //'image',//图像格式
            //'in:1,2',//在...内
            // Rule::in(['1', '2']),//在...内
            //'in_array:array.*',//在另一个数组字段内,注意加*或其他标识符,因为可能有多个字段
            //'integer',//整数
            //'ip',//合法ip格式
            //'json',//json格式:注意,必须是双引号包起来
            //'max:2',
            //'min:2',//最大,最小:类似between
            //'nullable',//允许null:即使有其他条件,也可以为null;但不能排除required
            //'not_in:1,2,3',//不在范围内
            //'numeric',//必须是数字:可以是正负浮点数
            //'present',//存在性:比required多了允许为空等
            //'regex:/^[a-zA-Z0-9|`|~|!@|#|$|%|^|&|*|(|)|-|_|=|+|[|{|\]|}|\\|\||;|:|\'|"|,|<|.|>|?]{6,18}$/',//正则表达式//注意用数组,不要用|分隔
            //'required_if:email,1,2,3',//如果其他字段等于这些值
            //'required_unless:email,1,2,3',//当等于这些值,可以为空;等价于,除非不等于这些值,才必需 ^p->q <=> ^p|^q <=>^(p&q)
            //'required_with:param1,param2,param3',//任一存在
            //'required_with_all:param1,param2,param3',//全部存在
            //'required_without:param1,param2,param3',//任一不存在
            //'required_without_all:param1,param2,param3',//全部不存在
            //'same:email',//相同:可以其中一个为null,可以同时为空
            //size//大小
            //'string',//非空字符串
            //'timezone',//时区标识符,如Asia/Shanghai等
            //unique:users,id,name1,name',//唯一值://第四个参数idColumn是指忽略哪个字段
            //connection.users自定义数据库
            Rule::unique('users','id'),//需要定义字段
        ],
        'file'=>[
            //'mimetypes:text/plain,image/gif',//mime类型:支持*通配符
            //'mimes:jpeg',//根据后缀判断mime,不支持通配符
        ]
    ], [
        'required'          => ':attribute 必须传入',//自定义错误消息
        'name.required'     => ':attribute 必须传入',//为给定属性指定自定义消息
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );
    $errors = $validator->errors();
    $return = [
        'errors' => $errors,//错误消息
        'all'    => $errors->all(),//查看所有字段的错误消息
        'first'  => $errors->first( 'name' ),//查看特定字段的第一个错误消息
        'get'    => $errors->get( 'name' ),//查看特定字段的所有错误消息
        'has'    => $errors->has( 'name' ),//判断特定字段是否含有错误消息
        //'array'    => $errors->get( 'array.*' ),//验证表单的数组字段
    ];

    return $return;
} );


/**
 * question
 */
//页面空白或拿不到错误数据:使用make,构造ajax,或表单提交.
//unless:不符合推导过程?有需要时研究