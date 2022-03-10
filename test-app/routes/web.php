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

/*
 * URL 파라미터를 선택적으로 받을 때 파라미터 뒤에 '?'를 붙인다.
 * 파라미터가 없으면 bar를 기본값으로 사용
 * 파라미터에 따라 다른 로직을 원할 때 패턴 지정 (where)
 */
Route::get('/{foo?}', function ($foo='bar') {
    return "{$foo}";
}) -> where('foo', '[0-9a-zA-Z]{2,5}');


// 라우트 이름을 test로 설정
Route::get('/test', [
    'as' => 'test',
    function() {
        return 'test';
    }
]);

Route::get('/test2', function () {
    info('Redirecting from test2 to test...'.'\n');
    return redirect(route('test'));
});
