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
}
