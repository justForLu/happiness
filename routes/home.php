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
    Route::get('/get-banner','BannerController@getBanner');
    Route::get('/get-remember','RememberController@getRemember');
    Route::post('/add-remember','RememberController@addRemember');
    Route::post('/edit-remember','RememberController@editRemember');
    Route::get('/remember-detail/{id}','RememberController@detail');
    Route::get('/del-remember','RememberController@delRemember');
    Route::get('/get-event', 'EventController@index');
    Route::post('/add-event','EventController@addEvent');
    Route::post('/edit-event','EventController@editEvent');
    Route::get('/event-detail/{id}','EventController@detail');
    Route::any('/del-event','EventController@delEvent');
    Route::get('/get-notebook', 'NotebookController@index');
    Route::post('/add-notebook','NotebookController@addNotebook');
    Route::post('/edit-notebook','NotebookController@editNotebook');
    Route::get('/notebook-detail/{id}','NotebookController@detail');
    Route::any('/del-notebook','NotebookController@delNotebook');
    Route::get('/get-happy', 'HappyController@index');
    Route::post('/add-happy','HappyController@addHappy');
    Route::post('/edit-happy','HappyController@editHappy');
    Route::get('/happy-detail/{id}','HappyController@detail');
    Route::any('/del-happy','HappyController@delHappy');
    Route::any('/upload-img', 'FileController@uploadImg');
    Route::post('/login', 'UserController@login');
    Route::any('/user', 'UserController@user');
    Route::get('/user-count','UserController@userCount');
});


