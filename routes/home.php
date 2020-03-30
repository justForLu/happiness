<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Home'], function (){
    Route::get('/index.html', 'IndexController@index');
    Route::get('/product.html', 'HappyController@index');
    Route::get('/product/{id}.html', 'HappyController@detail');
    Route::get('/news.html', 'NotebookController@index');
    Route::get('/news/{id}.html', 'NotebookController@detail');
    Route::get('/example.html', 'EventController@index');
    Route::get('/about.html', 'AboutController@index');
    Route::post('/feedback', 'AboutController@feedback');
});


