# Laravel 框架学习
> 编辑：lieyan123091  
> 邮箱：1766266374@qq.com  
> 版本：v1.0    
> 日期：2020.4.28  
## composer命令
>1.composer create-project  
>2.composer require  
>3.composer self-update   
>4.composer update   
>5.composer dump-autoload  
>6.composer install  
## Laravel安装
> Laravel composer安装:  
>> composer create-project --prefer-dist laravel/laravel=6.0.* blog
>>> --perfer-dist:代表压缩方式下载  
>>> 6.0.*:代表6.0最新版本  
> Laravel 安装完后，生成APP_KEY，写入.env文件  
>> php artisan key:generate   
## Laravel IDE-helper插件
> 1. composer require barryvdh/laravel-ide-helper  
> 2. config/app.php中providers数组添加:  
> Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,  
> 3. php artisan  ide-helper:generate
## Laravel 目录结构
1. **app:框架核心目录（包含Cotroller及Model）**
2. bootstrap:框架启动文件目录
3. **config:配置文件目录**
4. database:数据迁移文件目录
5. **resources:模板文件目录（包含View）**
6. **routes:路由文件目录**
7. storage:缓存、日志文件目录
8. vendor:第三方库及laravel源码目录
9. public:虚拟主机及入口文件目录
## Laravel 启动
> - artisan方式启动:  
> php artisan serve --port=8080  
> - 虚拟主机方式启动:  
> 配置apache/nginx虚拟主机
### Logo    
![laravel logo](https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3162950656,1773643914&fm=26&gp=0.jpg)  

## Laravel中的Csrf
>默认routes目录下的web.php非GET路由都开启了Csrf请求验证  
>App\Http\Middleware\VerifyCsrfToken中可添加免Csrf认证的路由  
>Laravel6版本之后生成csrf表单域方式:@csrf  
>生成csrf表单域方式:{{csrf\_field()}}  
>生成csrf值方式:{{csrf\_token()}}
## 路由
### 四种基础路由
>GET、POST、PUT、DELETE  

### 路由构建
>1.通过闭包构建  
```
Route::get('foo', function () {
    return 'Hello World';
});
```
>2.通过文件构建  
```
Route::get('/login','LoginController@index');
```

### 其它路由
>1.match:响应多个请求方式  
```
Route::match(['get','post'],'book',function(){
   dump($_SERVER);
});
```
>2.any：响应所有请求方式  
```
Route::any('books',function (){
    return 'Books';
});
```

### 路由参数
>1.必选参数  
```
Route::get('video/{id}',function($id){
    return 'Get:' . $id;
});
```
>2.可选参数  
```
Route::get('videos/{id?}',function($id=0){
    return 'Get:' . $id;
});
```
>3.正则约束 
```
Route::get('v/{id}',function($id){
    return 'Get:' . $id;
})->where(['id'=>'\d+']);
```

### 路由别名
```
Route::any('car',function (){
    return route('car');
})->name('car');
```

### 路由分组之路由前缀
```
Route::group(['prefix'=>'sys'],function(){
   Route::get('login',function(){
      return 'login';
   });
});
```

### 查看定义的路由
>php artisan route:list

### 资源路由

> 简化路由定义：自动定义index、store、create、show、update、destroy、edit路由，省略一个一个定义。

```
Route::resource('index','IndexController',['as'=>'admin']);
```

```
php artisan make:controller Admin/IndexController -r -m Models/Index
```

## 控制器

### 创建控制器

#### artisan命令行创建

>php artisan make:controller LoginController  
>php artisan make:controller -r IndexController 【带有基础代码】

#### 创建带有二级目录的控制器

>php artisan make:controller Book/BookInfoController
## 请求
### Input类
>1.get()  
>2.all()  
>3.only():白名单  
>4.except():黑名单  
>5.has()  
```
$username = Input::get('username','zhangsan');  
$password = Input::get('password','123123');
dump($username,$password);
```
`dump(Input::all());`  
`dump(Input::only('username','age'));`  
`dump(Input::except('username'));`  
`dump(Input::has('username'));`

### Request类
**原理：依赖注入方式传入Request类型参数**
>1.get()  
>2.all()  
>3.only():白名单  
>4.except():黑名单  
>5.has()  
>6.isMethod()
```
 $username = $request->get('username','zhangsan');
 $password = $request->get('password','123123');
 dump($username,$password);
```
`dump($request->all());`  
`dump($request->only('username','age'));`  
`dump($request->except('username'));`  
`dump($request->has('username'));`  
`dump($request->isMethod('get'));`  

### 助手函数  
>request()返回Request类对象  
`dump(request()->get('username'));`  

## 响应  

### Cookie  
>Laravel中cookie值都是经过加密的  
>response响应体中要有数据  

#### 设置cookie  
`return response('Cookie设置成功')->cookie('name','Good',1);`  

#### 获取cookie  
`return request()->cookie('name');`  

### 重定向  
`return redirect()->route('login');`  

```
return redirect()->route('login')->with('msg','登录失败');
```

```
return redirect()->back()->withErrors('msg','登录失败');
```

### 返回json  
`return response()->json(['name'=>'zhangsan','age'=>22],201);`  

## 视图  

### 展示视图  
>目录分层分隔符为.  
`return view('login.index');`  

### 分配数据到视图  
>1.关联数组     
`return view('login.index',['data'=>$data]);`  
>2.compact函数：创建一个包含变量名和值得数组     
`return view('login.index',compact('data'));`  
>3.with传递   
`return view('login.index')->with('data',$data);` 

### 三元运算符及未转义输出
`<h3>{{$age ?? '没有年龄'}}</h3>`  
`<h3>{!! $title !!}</h3>`  

### 原始形态输出
>vue代码混编输出：  
`<h4>@{{title}}</h4>`

### 使用函数
`<h3>{{date("Y-m-d")}}</h3>`

### if判断
```
    @if($age<10)
        <h1>小于10</h1>
    @elseif($age>=10 && $age<20)
        <h1>大于10小于20</h1>
    @else
        <h1>大于20</h1>
    @endif
```

### foreach循环
```
 @foreach($user as $v)  
        <h1>{{$v['name']}}</h1>
 @endforeach
```
```
 @forelse($book as $v)  
        <h1>{{$v['name']}}</h1>  
 @empty
        <h1>没有数据</h1>  
 @endforelse
```

### 模板包含
>包含符：@inlude

### 模板继承
>继承符：@extends  
>占位符：@yield  
>实现符：@section 

```
     @include('public.header')
     @yield('content')
     @include('public.footer')
```

```
@extends('public.main')
@section('title','登录页面')
@section('content')
    <h1>这是登录表单</h1>
@endsection
```

## 表单验证

### 控制器验证
```
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
```
### 独立验证
```
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
```

### 验证器验证
>1.执行命令生成验证器：php artisan make:request Register  


```
public function register3_post(RegisterRequest $request){
     $validated = $request->validated();
     dd($validated);
}
```
### 中文提示切换
>1.下载laravel-lang语言包并拷贝  
>2.修改配置：'locale' => 'zh-CN',
### 错误提示
```
 @if($errors->any())
        <div class="alert alert-success" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
 @endif
```

## 数据库
### 查看数据库连接
`dd(DB::connection());`
### 安装laravel-debugbar
>1.composer require barryvdh/laravel-debugbar --dev  
>2.providers数组中添加：Barryvdh\Debugbar\ServiceProvider::class  
***说明：--dev参数代表在开发环境中用到的包***
### 执行原生SQL
```
$users = DB::select("SELECT * FROM `sp_user`");
$user = DB::selectOne("SELECT * FROM `sp_user` WHERE `user_id`=:id",["id"=>1]);
$result = DB::insert("INSERT INTO `sp_type` (`type_name`) VALUES (:type_name)",['type_name'=>'冰箱']);
$result = DB::update('UPDATE sp_type SET type_name=:type_name WHERE `type_id`=:id', ['type_name'=>'洗衣机','id' => 5]);
$result = DB::delete('DELETE FROM `sp_type` WHERE `type_id`=:id', ['id' => 5]);
```
### 构建器（QueryBuilder）

```
 $res = DB::table('user')->get();
 $res = DB::table('user')->get(['username','user_email']);
 $res = DB::table('user')->get(['username','user_email'])->toArray();
```

```
 $res = DB::table('user')->where('user_id', '>=',3)->get(['username']);
 $res = DB::table('user')->where('user_id', '>=',3)->orWhere('user_sex','男')->get(['username']);
```

```
 $con = $request->get('con');
 $res = DB::table('user')->when($con,function($query) use($con){
            return $query->where('username','like',"%$con%");
        })->get();
```

```
$res = DB::table('user')->first();
$res = DB::table('user')->value('username');
$res = DB::table('user')->pluck('username', 'user_id');
$res = DB::table('user')->count();
```

```
$res = DB::table('user')->orderBy('user_id', 'desc')->get();
```

```
$res = DB::table('type')->offset(1)->limit(2)->get();
```

```
$res = DB::table('type')->insert([
            ['type_name'=>'手机'],
            ['type_name'=>'电风扇'],
        ]);
$res =  DB::table('type')->insertGetId(['type_name'=>'打印机']);
```

`$res = DB::table('type')->where('type_id',8)->update(['delete_time'=>'12321454']);`

` $res = DB::table('type')->where('type_id',8)->delete();`

## 数据迁移

### 生成迁移文件
>php artisan make:migration create_article --table=articles

### 编写迁移文件
```
 $table->increments('article_id')->comment('自增ID');
 $table->string('title')->default('')->comment('标题');
 $table->text('desc')->commment('内容');
 $table->timestamps();
```

### 执行迁移文件
>php artisan migrate

### 回滚迁移文件
>php artisan migrate:rollback

### 回滚所有迁移文件
>php artisan migrate:reset

### 回滚并迁移
>php artisan migrate:refresh

## 数据填充

### 生成Seeder文件
>php artisan make:seeder ArticleSeeder

### 编写Seeder文件
```
 public function run()
    {
        $data = [];
        for ($i=1;$i<10;$i++) {
            $data[] = [
                'title'=>'title_' . $i,
                'desc'=>'desc_' . $i
            ];
        }
        DB::table('articles')->insert($data);
    }
```

### 运行Seeder文件
>1.php artisan db:seed --class=ArticleSeeder  
>2.DatabaseSeeder中指定要生成的seed  
>> ` $this->call(ArticleSeeder::class);`
>>
>> > php artisan db:seed 

### 回滚并迁移同时运行种子文件
>php artisan migrate:refresh --seed  

## 模型

### 创建模型
> php artisan make:model Models/ArticleModel

### 模型限制
>1.设置表名：$table  
>2.设置主键：$primaryKey  
>3.是否启用自动写入创建修改时间：$timestamps  
>4.白名单：$fillable  
>5.黑名单：$guarded  

### ORM操作

***phpstorm代码模型提示***  
>php artisan ide-helper:models

#### 添加
>1.create方式（推荐）  
>
>> 返回值为Model模型对象，必须设置黑名单$guarded，或者白名单$fillable  

```
$article = new ArticleModel();
$data = [
            'title'=>'中国足球',
            'desc'=>'北京'
        ];
$res = $article->create($data);
```
>2.save方式
>
>>返回值为布尔值,以对象的形式设置属性

```
$article = new ArticleModel();
$article->title = '文章1';
$article->desc = 'Hello World';
$res = $article->save();
```

>3.insert方式
>
>>返回值为布尔值，但是不会自动写入创建修改时间

```
$article = new ArticleModel();
data = [
            'title'=>'中国疫情',
            'desc'=>'武汉'
        ];
$res = $article->insert($data);
```

#### 查询
>查询多条：all方法不能加where条件，get方法可以加where条件

```
$res = ArticleModel::where('article_id',1)->first();
$res = ArticleModel::find(1);
$res = ArticleModel::where('article_id','>',6)->get();
$res = ArticleModel::all();
$res = ArticleModel::where('article_id',12)->value('title');
$res = ArticleModel::where('article_id','>',7)->pluck('title');
$res = ArticleModel::count();
$res = ArticleModel::where('article_id','>',8)->limit(2)->get();
```

#### 修改
>1.update方式
>
>>返回值为受影响行数

`$data = ['title'=>'Hello'];$res = ArticleModel::where('article_id',2)->update($data);`

>2.save方式
>
>>返回值为布尔值，以对象的方式设置属性

```
$article = ArticleModel::find(1);
$article->title = '1234';
$res = $article->save();
```

#### 删除
>1.destroy方式
>
>>返回受影响的行数

`$res = ArticleModel::destroy(4);`

>2.delete方式
>
>>返回布尔值

` $article = ArticleModel::find(3);$res = $article->delete();`

#### 软删除
>1.迁移文件中添加deleted_at字段    
>
>>`$table->softDeletes();` 

>2.在模型中添加  
>>`use SoftDeletes;`  
>>`protected $dates = ['deleted_at'];`

>3.destroy方法软删除
>
>>`$res = ArticleModel::destroy(4);`

>4.查询软删除
>
>>`$res = ArticleModel::onlyTrashed()->get();`

>5.查询除软删除
>
>>`$res = ArticleModel::all('title');`

>6.查询包含软删除
>
>>`$res = ArticleModel::withTrashed()->get();`

>7.恢复软删除
>
>>`$res = ArticleModel::onlyTrashed()->restore();`

>8.永久删除
>
>>`$res = ArticleModel::where('article_id',6)->forceDelete();`

## Faker模拟数据

### faker基本使用

```php
$faker = Faker\Factory::create();
$data = [];
for ($i=1;$i<10;$i++) {
    $data[] = [
        'title'=>$faker->name,
        'desc'=>$faker->sentence
    ];
}
```

### faker数据工厂模拟数据

> 1.生成模型工厂

`php artisan make:factory ArticleFactory --model=Models/ArticleModel`

> 2.编写模型工厂  

```php
$factory->define(App\Models\ArticleModel::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'desc' => $faker->sentence
    ];
});
```

> 3.调用模型工厂

```php
factory(\App\Models\ArticleModel::class, 20)->create();
```

## 模型事件

**Eloquent 模型触发几个事件，允许你挂接到模型生命周期的如下节点： retrieved、creating、created、updating、updated、saving、saved、deleting、deleted、restoring 和 restored。事件允许你每当特定模型保存或更新数据库时执行代码。每个事件通过其构造器接受模型实例。**

> 1.生成观察者

`php artisan make:observer ArticleObserver --model=Models/ArticleModel`

> 2.编写观察者

```php
class ArticleObserver
{
    public function creating(ArticleModel $article)
    {
        $article->ip = request()->ip();
    }

}
```

> 3.模型中调用观察者

```php
protected static function boot()
{
    ArticleModel::observe(ArticleObserver::class);
    parent::boot();
}
```

## 分页

> 控制器

```php
public function page()
{
    $data = ArticleModel::paginate(env('PAGE_SIZE'));
    return view('login.page',compact('data'));
}
```

> 视图

```html
<div class="row">
    {{$data->links()}}
</div>
```

> 搜索

```php
$title = $request->get('title');
$data = ArticleModel::when($title,function(Builder $query) use($title){
   $query->where('title','like',"%{$title}%");
})->paginate(env('PAGE_SIZE'));
return view('login.page',compact('data'));
```

```html
<div class="row">
    {{$data->appends(request()->except('page'))->links()}}
</div>
```

## Session

Session 的配置文件存储在 `config/session.php` 文件中，默认情况下，Laravel 为绝大多数应用程序配置的 Session 驱动为 `file` 。 file驱动将 Session 存储在 `storage/framework/sessions` 中。

> 操作

```php
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
```

## 中间件

中间件是请求与响应之间的中间人，是一种过滤机制。

> 创建中间件  

```php artisan make:middleware CheckUser```


> 定义中间件

```php
public function handle($request, Closure $next,$params)
    {
        dump($request->route()->getName());
        dump("用户中间件",$params);
        return $next($request);
    }
```

> 注册中间件

中间件分为全局中间件跟路由中间件，在Laravel中app\Http\Kernel.php中进行定义。

```php
protected $routeMiddleware = [
    'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'checkuser' => \App\Http\Middleware\CheckUser::class
];
```

```php
Route::get('mid','LoginController@mid')->name('mid')->middleware('checkuser:middle');
```

## 缓存

> 安装redis扩展 

`composer require predis/predis`

```
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
```

## 用户认证  
>> 模型：Illuminate\Foundation\Auth\User as Authenticatable  
>> 控制器：Illuminate\Support\Facades\Auth::class  
>> 配置：config/auth.php  

> 手动验证用户

```
public function authenticate(Request $request)
{
       $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
            // 通过认证..
            dump(Auth::user(),Auth::id())
       }
}
```

> 检查用户是否登录

```
if (Auth::check()) {
    // 用户已经登录了...
}
```

> 退出登录

```
Auth::logout();
```

## 关联模型

### 一对一  

```
$goods = Goods::where('goods_id',1)->first();
dump($goods->info->desc);
$goods2= Goods::with('info')->where('goods_id',2)->first();
dump($goods2->info->desc);
```

### 一对多
```
$goods2= Goods::with('pics')->where('goods_id',2)->first();
dump($goods2->pics);
$goods3= Goods::with(['pics'=>function($query){
    return $query->where('pics_id','>=',8);
}])->where('goods_id',2)->first();
dump($goods3->pics);
```

### 多对多

```
return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
```

> 获取中间表字段

```
$user = App\User::find(1);
foreach ($user->roles as $role) {
    echo $role->pivot->created_at;
}
```

## laravel自定义函数

> 1、新建文件，文件名任意：

```
app/Helpers/function.php
```

> 2、在composer.json 中 autoload 增加：

```
“autoload”：{
       ...
        "files":[
            "app/Helpers/function.php"
        ]        
}
```

> 3、打开cmd  切换到项目目录   执行命令：

```
composer dump
```

