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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('news/create', 'Admin\NewsController@add');     //画面表示のための指定。
    Route::post('news/create', 'Admin\NewsController@create'); //フォーム送信した際のpost先（news/create)とメソッド(create)の指定。
});

//php09課題3
Route::get('XXX', 'AAAController@bbb');

//php09課題4 　php13課題3・6
Route::group(['prefix'=>'admin'], function(){
    Route::get('profile/create', 'Admin\Profilecontroller@add') -> middleware('auth');
    Route::get('profile/edit', 'Admin\Profilecontroller@edit') -> middleware('auth');
    Route::post('profile/create', 'Admin\Profilecontroller@create'); 
    Route::post('profile/edit', 'Admin\Profilecontroller@update');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
