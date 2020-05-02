# Laravel 框架学习
> 编辑：lieyan123091  
> 邮箱：1766266374@qq.com  
> 版本：v1.0    
> 日期：2020.4.28  
## Laravel安装
> Laravel composer安装:  
>> composer create-project --prefer-dist laravel/laravel=6.0.* blog
>>> --perfer-dist:代表压缩方式下载  
>>> 6.0.*:代表6.0最新版本
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
