<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;

class LoginController extends Controller
{
    public function index()
    {

        //Input类
        $username = Input::get('username','zhangsan');
        $password = Input::get('password','123123');
        dump($username,$password);
        dump(Input::all());
        dump(Input::only('username','age'));
        dump(Input::except('username'));
        dump(Input::has('username'));
        return 'Login';

    }

    public function index2(Request $request)
    {
        $username = $request->get('username','zhangsan');
        $password = $request->get('password','123123');
        dump($username,$password);
        dump($request->all());
        dump($request->only('username','age'));
        dump($request->except('username'));
        dump($request->has('username'));
        //判断请求类型
        dump($request->isMethod('get'));
        //助手函数
        dump(request()->get('username'));
    }

    public function index3()
    {
        //设置Cookie
        response('Cookie设置成功')->cookie('name','Good',1);
        return redirect()->route('login');
    }

    public function getCookie()
    {
        return request()->cookie('name');
    }

    public function index4()
    {
        //返回json
        return response()->json(['name'=>'zhangsan','age'=>22],201);
    }

    //指定视图
    public function index5()
    {
        $data = [
            'id'=>1,
            'name'=>'zhangsan'
        ];
        $title = '<a href="http://www.baidu.com">百度</a>';
        $age = 22;
        $user = [
          ['name'=>'lisi'],
          ['name'=>'wangwu'],
          ['name'=>'zhangsan'],
          ['name'=>'zhaosi'],
        ];
        $book = [];
//        return view('login.index',['data'=>$data]);
        return view('login.index',compact('data','title','age','user','book'));
//        return view('login.index')->with('data',$data);
    }

    public function index6()
    {
        return view('login.index1');
    }

    public function index7()
    {
        dump(Str::contains('abc','a'));
        dump(Str::endsWith('abc','c'));
        //将值转为驼峰
        dump(Str::camel('hello-world'));
        dump(Str::limit('abcdsfjlsf', 5));
        dump(Str::random(12));
    }

    //控制器验证
    public function register(Request $request)
    {
        if($request->isMethod('post')){
            $input = $this->validate($request,[
                'username'=>'required|min:5|max:15',
                'password'=>'required|min:6|confirmed',
                'password_confirmation'=>'required',
                'email'=>"required|email"
            ],[
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'password_confirmation.required'=>'确认密码不能为空',
                'email.required'=>'邮箱不能为空',
                'username.min'=>'用户名长度不能少于5位',
                'username.max'=>'用户名长度不能多于15位',
                'password.min'=>'密码长度不能少于5位',
                'password.confirmed'=>'密码跟确认密码不一致',
                'email.email'=>'邮箱格式不正确',
            ]);
            dd($input);
        }
        return view('login.register');
    }

    //独立验证
    public function register2(Request $request)
    {
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'username'=>'required|min:5|max:15',
                'password'=>'required|min:6|confirmed',
                'password_confirmation'=>'required',
                'email'=>"required|email"
            ],[
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'password_confirmation.required'=>'确认密码不能为空',
                'email.required'=>'邮箱不能为空',
                'username.min'=>'用户名长度不能少于5位',
                'username.max'=>'用户名长度不能多于15位',
                'password.min'=>'密码长度不能少于5位',
                'password.confirmed'=>'密码跟确认密码不一致',
                'email.email'=>'邮箱格式不正确',
            ]);
            //如果有错误，返回true
            if($validator->fails()){
                return redirect()->route('register2')->withErrors($validator);
            }
            dd($request->except('_token'));
        }
        return view('login.register2');
    }

    //验证器验证
    public function register3(Request $request)
    {
        return view('login.register3');
    }

    public function register3_post(RegisterRequest $request)
    {
            //1.自动对请求进行验证

            //2.获取验证通过的数据
            $validated = $request->validated();
            dd($validated);
    }
}
