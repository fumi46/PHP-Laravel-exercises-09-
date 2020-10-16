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
    Route::get('news/create', 'Admin\NewsController@add');     
    Route::post('news/create', 'Admin\NewsController@create'); 
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');
});

//php09課題3
Route::get('XXX', 'AAAController@bbb');

//php09課題4 　php13課題3・6
Route::group(['prefix'=>'admin','middleware' => 'auth' ], function(){
    Route::get('profile/create', 'Admin\Profilecontroller@add') ;
    Route::post('profile/create', 'Admin\Profilecontroller@create'); 
    Route::get('profile/edit', 'Admin\Profilecontroller@edit');
    Route::post('profile/edit', 'Admin\Profilecontroller@update');
    Route::get('profile', 'Admin\Profilecontroller@index');
    Route::get('profile/delete', 'Admin\Profilecontroller@delete');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'NewsController@index'); //トップページ（URLの後に何もつけない）にアクセスが来たら、NewsControllerのindexアクションへ移行。

Route::get('/profile', 'ProfileController@index');  //PHP19課題2