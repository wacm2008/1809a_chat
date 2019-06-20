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
Route::get('/phpinfo', function () {
    phpinfo();
});
//mongodb curd
Route::get('/mongoCreate','MongoDbController@mongoCreate');
Route::get('/mongoSearch','MongoDbController@mongoSearch');
Route::get('/mongoUpdate','MongoDbController@mongoUpdate');
Route::get('/mongoDelete','MongoDbController@mongoDelete');
Route::get('/mongoFindDelete','MongoDbController@mongoFindDelete');
Route::get('/mongoFindUpdate','MongoDbController@mongoFindUpdate');

Route::get('/test/ws','TestController@index');
//慢查询
Route::get('/test/slowlog','TestController@slowlog');
//分表 水平分割
Route::get('/test/cutlist','TestController@cutlist');
//分区
Route::get('/test/range','TestController@range');