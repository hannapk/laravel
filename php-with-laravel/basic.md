
<img width="600" src="https://appkr.github.io/l5book-snippets/draft/images/1-2.png">


### 라우팅 
HTTP 요청의 메서드와 URL을 보고 적절한 처리 로직으로 연결시키는 행위     

### 컨트롤러  
HTTP 요청 로직

### routes/web.php

```
Route::get('/', 'WelcomeController@index');
```

* 아티즌 명령줄 인터페이스로 컨트롤러 생성   
`php aratisan make:controller WelcomeController`   


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

### RESTful 컨트롤러 생성 
RESTful 리소스 컨트롤러는 REST 원칙에 따라 URL을 컨트롤러 메서드에 자동으로 연결     
`--resource` 옵션을 주면 된다.   

```
php artisan make:controller ArticlesController --resource 
```

### RESTful 라우트 정의 

```
Route::resource('articles', 'ArticlesController');
```

resource는 거의 사용하지 않음.


