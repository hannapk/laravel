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
 * '?'는 거의 사용하지 않는다.
 * 파라미터가 없으면 bar를 기본값으로 사용
 * 파라미터에 따라 다른 로직을 원할 때 패턴 지정 (where)
 */
//Route::get('/{foo?}', function ($foo = 'bar') {
//    return "{$foo}";
//})->where('foo', '[0-9a-zA-Z]{2,5}');


// 라우트 이름을 test로 설정
//Route::get('/test', [
//    'as' => 'test',
//    function () {
//        return 'test';
//    }
//]);

//Route::get('/test2', function () {
//    info('Redirecting from test2 to test...' . '\n');
//    return redirect(route('test'));
//});

Route::get('/', 'WelcomeController@index');

// resource는 거의 사용하지 않음
Route::resource('articles', 'ArticlesController');

/****************************************
 * 사용자 인증 관련 Routes
 ****************************************/
Route::get('/protected', function () {
    $output = new \Symfony\Component\Console\Output\ConsoleOutput();
    $output->writeln(json_encode(session()->all(), JSON_PRETTY_PRINT));
    if (!auth()->check()) {
        return "Who are you?";
    }

    return "Welcome " . auth()->user()->name;
});

// 로그인 페이지
Route::get('/auth/login', function () {
    $credentials = [
        'email' => 'aaron@kmong.com',
        'password' => 'password'
    ];

    if (!auth()->attempt($credentials)) {
        return 'Email & password does not match';
    }

    return redirect('protected');
});

// 로그아웃
Route::get('/auth/logout/', function () {
    auth()->logout();
    return 'See you';
});

/****************************************
 * Database listener
 ****************************************/
DB::listen(function ($query) {
    dump($query->sql);
});

