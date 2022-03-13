
<img width="1000" src="https://appkr.github.io/l5book-snippets/draft/images/1-2.png">


### Laravel 프로젝트 실행 

```
php artisan serve
```

<br />
 
### 라우팅 
HTTP 요청의 메서드와 URL을 보고 적절한 처리 로직으로 연결시키는 행위     

<br />

### 컨트롤러  
HTTP 요청 로직

<br />  

### routes/web.php

```
Route::get('/', 'WelcomeController@index');
```

* 아티즌 명령줄 인터페이스로 컨트롤러 생성   
`php aratisan make:controller WelcomeController`   

<br />

### app/Http/Controllers/WelcomeController.php

```
class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
```

<br />

### RESTful 컨트롤러 생성 
RESTful 리소스 컨트롤러는 REST 원칙에 따라 URL을 컨트롤러 메서드에 자동으로 연결     
`--resource` 옵션을 주면 된다.   

```
php artisan make:controller ArticlesController --resource 
```

<br />  

### RESTful 라우트 정의 

```
Route::resource('articles', 'ArticlesController');
```

resource는 거의 사용하지 않음.

<br />

### 사용자 인증 
라라벨은 web 미들웨어 그룹에 속한 모든 라우트에서 세션을 유지한다.    
 
* 로그인한 경우    
`session()->all()`을 출력하면 `login_web_RANDOM_문자열`에 사용자의 id 번호가 저장되어 있음   


* 쿠키 세션 키     
    - 기본 값: 'laravel_session'      
    - 설정: `config/session.php`  

<br />

### 사용자 인증 미들웨어   
`/protected` route에서 인증 여부를 처리하고 미인증한 경우에 대한 처리는 'auth' 미들웨어를 사용할 수 있다.    

```
Route::get('/protected', ['middleware' => 'auth', function () {
```

auth 미들웨어는 `app/Kernel.php`에 정의

<br />

### 엘로퀀트(Eloquent) ORM   
엘로퀀트는 데이터베이스의 레코드를 객체로 표현하는 객체 관계 모델(ORM) 구현체이고   
PHP의 클래스 문법으로 데이터베이스와 상호작용할 수 있다.   

<br />

### REPL  
PEPL은 콘솔 환경에서 명령을 내려 실행 결과를 확인하는 도구이다.   
라라벨이 제공하는 REPL(의 이름은 팅커)은 다음과 같이 실행한다.  

```
php artisan tinker 
```

<br />

### 자동 생성된 Route 목록 확인

```
php artisan route:list     
```

<br />


### 라라벨 구동  
(1) `config/app.php` 로드   
(2) `app.php`의 `providers` 섹션에 `RouterServiceProvider` 가 등록되어 있다.     
(3) `RouterServiceProvider`는 `web.php`를 읽어 전체 라우트 생성  
컨트롤러 경로는 `RouteServiceProvider`의 `$namespace`에 정의   

<br />

### N+1 문제  
`User (1) ⎯ (*) Article`    

```
$article->user->name
```

위와 같이 접근하면 각 Article의 user를 조회하기 위한 쿼리가 발생한다.     
즉 N+1 문제가 발생한다.    


엘로퀀트는 디폴트로 Lazy Loading이다.       


* 해결책 1) `with()` 구문 사용    

```
$articles = Article::with('user')->get();
```

`with()` 구문을 사용하는 경우, `IN` 연산자로 한번에 쿼리가 실행된다.

```
select * from 'users' where 'users'.'id' in (?)
```


* 해결책 2) load 구문 사용   

```
$articles->load('user');
```

전체 로직에서 user를 사용하지 않고 Response에서만 전달하는 경우 `load()` 구문을 사용하면 된다.   

