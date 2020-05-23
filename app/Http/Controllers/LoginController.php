<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\ArticleModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Validator;
use DB;
use Cache;

class LoginController extends Controller
{
    public function index()
    {

        //Input类
        $username = Input::get('username', 'zhangsan');
        $password = Input::get('password', '123123');
        dump($username, $password);
        dump(Input::all());
        dump(Input::only('username', 'age'));
        dump(Input::except('username'));
        dump(Input::has('username'));
        return 'Login';

    }

    public function index2(Request $request)
    {
        $username = $request->get('username', 'zhangsan');
        $password = $request->get('password', '123123');
        dump($username, $password);
        dump($request->all());
        dump($request->only('username', 'age'));
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
        response('Cookie设置成功')->cookie('name', 'Good', 1);
        return redirect()->route('login');
    }

    public function getCookie()
    {
        return request()->cookie('name');
    }

    public function index4()
    {
        //返回json
        return response()->json(['name' => 'zhangsan', 'age' => 22], 201);
    }

    //指定视图
    public function index5()
    {
        $data = [
            'id' => 1,
            'name' => 'zhangsan'
        ];
        $title = '<a href="http://www.baidu.com">百度</a>';
        $age = 22;
        $user = [
            ['name' => 'lisi'],
            ['name' => 'wangwu'],
            ['name' => 'zhangsan'],
            ['name' => 'zhaosi'],
        ];
        $book = [];
//        return view('login.index',['data'=>$data]);
        return view('login.index', compact('data', 'title', 'age', 'user', 'book'));
//        return view('login.index')->with('data',$data);
    }

    public function index6()
    {
        return view('login.index1');
    }

    public function index7()
    {
        dump(Str::contains('abc', 'a'));
        dump(Str::endsWith('abc', 'c'));
        //将值转为驼峰
        dump(Str::camel('hello-world'));
        dump(Str::limit('abcdsfjlsf', 5));
        dump(Str::random(12));
    }

    //控制器验证
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $this->validate($request, [
                'username' => 'required|min:5|max:15',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'email' => "required|email"
            ], [
                'username.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
                'password_confirmation.required' => '确认密码不能为空',
                'email.required' => '邮箱不能为空',
                'username.min' => '用户名长度不能少于5位',
                'username.max' => '用户名长度不能多于15位',
                'password.min' => '密码长度不能少于5位',
                'password.confirmed' => '密码跟确认密码不一致',
                'email.email' => '邮箱格式不正确',
            ]);
            dd($input);
        }
        return view('login.register');
    }

    //独立验证
    public function register2(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:5|max:15',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'email' => "required|email"
            ], [
                'username.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
                'password_confirmation.required' => '确认密码不能为空',
                'email.required' => '邮箱不能为空',
                'username.min' => '用户名长度不能少于5位',
                'username.max' => '用户名长度不能多于15位',
                'password.min' => '密码长度不能少于5位',
                'password.confirmed' => '密码跟确认密码不一致',
                'email.email' => '邮箱格式不正确',
            ]);
            //如果有错误，返回true
            if ($validator->fails()) {
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

    //数据库
    public function db()
    {
        //dd(DB::connection());
        //原生SQL
        $users = DB::select("SELECT * FROM `sp_user`");
        $user = DB::selectOne("SELECT * FROM `sp_user` WHERE `user_id`=:id", ["id" => 1]);
        $result = DB::insert("INSERT INTO `sp_type` (`type_name`) VALUES (:type_name)", ['type_name' => '冰箱']);
        $result = DB::update('UPDATE sp_type SET type_name=:type_name WHERE `type_id`=:id', ['type_name' => '洗衣机', 'id' => 5]);
        $result = DB::delete('DELETE FROM `sp_type` WHERE `type_id`=:id', ['id' => 5]);
    }

    public function db2(Request $request)
    {
        //查询构建器
        $res = DB::table('user')->get();
        $res = DB::table('user')->get(['username', 'user_email']);
        $res = DB::table('user')->get(['username', 'user_email'])->toArray();
        //查询ID大于3
        $res = DB::table('user')->where('user_id', '>=', 3)->get(['username']);
        //查询ID大于3或者性别是男
        $res = DB::table('user')->where('user_id', '>=', 3)->orWhere('user_sex', '男')->get(['username']);
        //条件语句查询
        $con = $request->get('con');
        $res = DB::table('user')->when($con, function ($query) use ($con) {
            return $query->where('username', 'like', "%$con%");
        })->get();
        //获取单条数据
        $res = DB::table('user')->first();
        $res = DB::table('user')->value('username');
        $res = DB::table('user')->pluck('username', 'user_id');
        $res = DB::table('user')->count();

        //排序
        $res = DB::table('user')->orderBy('user_id', 'desc')->get();

        //分页
        $res = DB::table('type')->offset(1)->limit(2)->get();

        //添加数据
        $res = DB::table('type')->insert([
            ['type_name' => '手机'],
            ['type_name' => '电风扇'],
        ]);

        $res = DB::table('type')->insertGetId(['type_name' => '打印机']);

        //修改数据
        $res = DB::table('type')->where('type_id', 8)->update(['delete_time' => '12321454']);

        //删除数据
        $res = DB::table('type')->where('type_id', 8)->delete();

        dump($res);
    }

    public function db3()
    {
        //save方式
        //$article = new ArticleModel();
        /* $article->title = '文章1';
         $article->desc = 'Hello World';
         $res = $article->save();*/


        //insert方式
        /*$data = [
            'title'=>'中国疫情',
            'desc'=>'武汉'
        ];
        $res = $article->insert($data);*/


        //create方式
        /*$data = [
            'title'=>'中国足球',
            'desc'=>'北京'
        ];
        $res = $article->create($data);

        dump($res);*/

        /*$res = ArticleModel::where('article_id',1)->first();
        $res = ArticleModel::where('article_id','>',6)->get();
        $res = ArticleModel::all();
        $res = ArticleModel::where('article_id',12)->value('title');
        $res = ArticleModel::where('article_id','>',7)->pluck('title');
        $res = ArticleModel::count();
        $res = ArticleModel::where('article_id','>',8)->limit(2)->get();*/

        /*$article = ArticleModel::find(1);
        $article->title = '1234';
        $res = $article->save();*/

       /* $data = ['title'=>'Hello'];
        $res = ArticleModel::where('article_id',2)->update($data);
        dump($res);*/

      /* $article = ArticleModel::find(3);
       /*$res = $article->delete();*/

      /* $res = ArticleModel::destroy(4);
       dump($res);*/

//        $res = ArticleModel::destroy(4);

        /*$res = ArticleModel::all('title');
        $res = ArticleModel::onlyTrashed()->get();
        $res = ArticleModel::withTrashed()->get();
        $res = ArticleModel::onlyTrashed()->restore();*/

        $res = ArticleModel::where('article_id',6)->forceDelete();
        dump($res);


    }

    public function db4()
    {
        $data = [
            'title'=>'中国疫情',
            'desc'=>'武汉'
        ];
        $res = ArticleModel::create($data);
        dump($res);
    }

    //分页
    public function page(Request $request)
    {
        $title = $request->get('title');
        $data = ArticleModel::when($title,function(Builder $query) use($title){
           $query->where('title','like',"%{$title}%");
        })->paginate(env('PAGE_SIZE'));
        return view('login.page',compact('data'));
    }
    
    //session
    public function sess()
    {
        //设置
        session(['name'=>'lieyan']);
        //获取
        $name = session()->get('name');
        dump($name);
        //删除
        session()->forget('name');
        //删除所有
        session()->flush();
        dump(session()->has('name'));
        //闪存
        session()->flash('age', 22);
        dump(session()->get('age'));

    }
    
    //中间件
    public function mid()
    {
      return 1;
    }

    //缓存
    public function redis()
    {
        //设置
        Cache::add('name', 'laravel', 1);
        Cache::put('age', 22, 1);
        //获取
        $age = Cache::get('age', 10);
        $city = Cache::get('city',function(){
           return 'beijing';
        });
        dump($age);
        dump($city);
        Cache::remember('article_1_title',1,function(){
            return ArticleModel::where('article_id',1)->value('title');
        });
        dump(cache()->has('name'));
        //先获取再删除
        dump(cache()->pull('name'));
        //删除
        cache()->forget('age');
        Cache::flush();
    }
}
