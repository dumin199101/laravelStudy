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

Route::get('/', function () {
    return view('welcome');
});

//路由
Route::get('req',function (){
    return 'Get Request';
});

Route::post('req',function(){
    return 'Post Request';
});

Route::put('req',function(){
   return 'PUT Request';
});

Route::delete('req',function(){
   return 'DELETE Request';
});

Route::get('/login','LoginController@index')->name('login');
Route::get('/login2','LoginController@index2');
Route::get('/login3','LoginController@index3');
Route::get('/login4','LoginController@index4');
Route::get('/login5','LoginController@index5');
Route::get('/login6','LoginController@index6');
Route::get('/login7','LoginController@index7');
Route::get('/getCookie','LoginController@getCookie');
Route::get('/register', 'LoginController@register');
Route::post('/register','LoginController@register');
Route::get('/register2','LoginController@register2')->name('register2');
Route::post('/register2','LoginController@register2');
Route::get('/register3','LoginController@register3');
Route::post('/register3','LoginController@register3_post');
Route::get('db','LoginController@db');
Route::get('db2','LoginController@db2');
Route::get('db3','LoginController@db3');
Route::get('db4','LoginController@db4')->name('db4');
Route::get('page','LoginController@page')->name('page');
Route::get('sess','LoginController@sess')->name('sess');
Route::get('mid','LoginController@mid')->name('mid')->middleware('checkuser');
Route::get('redis','LoginController@redis')->name('redis');


Route::match(['get','post'],'book',function(){
   dump($_SERVER);
});

//匹配所有请求
Route::any('books',function (){
    return 'Books';
});

//路由参数
Route::get('video/{id}',function($id){
    return 'Get:' . $id;
});
//可选参数
Route::get('videos/{id?}',function($id=0){
    return 'Get:' . $id;
});
//正则约束
Route::get('v/{id}',function($id){
    return 'Get:' . $id;
})->where(['id'=>'\d+']);

//路由别名
Route::any('car',function (){
    return route('car');
})->name('car');

//路由分组之路由前缀
Route::group(['prefix'=>'sys'],function(){
   Route::get('login',function(){
      return 'login';
   });
});