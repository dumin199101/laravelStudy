<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
//        return view('login.index',['data'=>$data]);
//        return view('login.index',compact('data'));
        return view('login.index')->with('data',$data);
    }
}
