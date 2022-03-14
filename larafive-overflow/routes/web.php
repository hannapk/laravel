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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

/* 사용자 가입 과련 ***************************/
Route::get('/auth/register', [
    'as' => 'users.create',
    'uses' => 'UsersController@create'
]);

Route::post('/auth/register', [
    'as' => 'users.store',
    'uses' => 'UsersController@store'
]);

Route::get('/auth/confirm/{code}', [
    'as' => 'users.confirm',
    'uses' => 'UsersController@confirm'
]);

/* 세션 과련 ***************************/
Route::get('/auth/login', [
   'as' => 'sessions.create',
   'uses' => 'SessionsController@create'
]);

Route::post('/auth/login', [
    'as' => 'sessions.store',
    'uses' => 'SessionsController@store'
]);

Route::get('/auth/logout', [
    'as' => 'sessions.destroy',
    'uses' => 'SessionsController@destroy'
]);

/* 패스워드 초기화 과련 ***************************/
Route::get('/auth/remind', [
   'as' => 'remind.create',
   'uses' => 'PasswordsController@getRemind'
]);

Route::post('/auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind'
]);

Route::get('/auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset'
]);

Route::post('/auth/reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset'
]);

Route::resource('articles', 'ArticlesController');
