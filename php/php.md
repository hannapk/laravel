참고: <http://www.tcpschool.com/php/intro>  
<br />  
 
# PHP(PHP: Hypertext Preprocessor)  
C언어를 기반으로 만들어진 서버 측에서 실행되는 서버 사이드 스크립트 언어  

PHP로 작성된 코드를 HTML 코드 안에 추가하면 웹 서버는 해당 코드를 해석하여 자동으로 HTML 문서를 생성한다.     

<br />

# PHP 문법 
### 변수 

```
$변수이름 = 초기값;

$var = 10;   
$var = 3.14; 
$var = "PHP"; 
```

변수를 선언할 때 따로 타입을 명시하지 않는다.     
해당 변수에 대입하는 값에 따라 자동으로 결정된다.   

```
$var = 10;

echo "$var";   // 10
echo "{$var}"; // 10

echo "변수 \$var에 저장된 값은 $var입니다.";   // 변수 $var에 저장된 값은 .
echo "변수 \$var에 저장된 값은 {$var}입니다."; // 변수 $var에 저장된 값은 10입니다.
```

<br />  

### 변수 종류 
* 지역 변수      
함수 내부에서 선언, 함수에서만 접근 가능   


* 전역 변수       
함수 밖에서 선언, 함수 밖에서만 접근 가능    
전역 변수를 함수 내부에서 접근하려면 `global` 키워드 사용     

```
global $var;
```


* 정적 변수      
함수 내부에서 `static` 키워드로 선언한 변수         
함수 호출이 종료되어도 메모리상 사라지지 않지만 지역 변수처럼 해당 함수 내에서만 접근 가능    
```
static $count = 0;
```

<br />  

### 상수    

```
define(상수이름, 상숫값, 대소문자구분여부)
```


<br />  

### 배열 

* 생성  

```
$배열이름 = array();
```


* 요소 참조 

```
$배열이름[인덱스]
```


```
$arr = array(
    1 => "첫 번째 값",   // PHP의 배열에서 키값의 1과 "1"은 같은 값을 나타냄.
    "1" => "두 번째 값", // 같은 키값을 사용하여 두 번 선언했기 때문에 나중에 선언된 "두 번째 값"만 남게됨.
    10 => "세 번째 값",
    -10 => "네 번째 값"
);
var_dump($arr);
echo $arr[1];
echo $arr["1"];
echo $arr[10];
echo $arr[-10];
```

* for문 이용한 배열 접근 

```
$arr = array("a", "b", "c");
for($i = 0; $i < count($arr); ++$i) {
    echo $arr[$i]."<br>";
}
```

<br />  


### 객체  

```
class Lecture {
    function Lecture(){
        $this->lec_01 = "PHP";
        $this->lec_02 = "MySQL";
    }
}

$var = new Lecture; // 객체 생성 
echo $var->lec_01; // 객체의 속성에 접근 
```

<br />

### 함수 

* 선언   

```
function sum($x, $y) // 함수의 이름은 sum()이며, 변수 x, y를 매개변수로 가지는 함수를 정의함.
{
    return $x + $y;  // 매개변수 x, y를 더한 값을 반환함.
}
echo sum(1, 2);      // sum() 함수에 숫자 1와 2을 인수로 전달하여 호출함.
```

PHP 7부터 반환값 지정 가능   
ex) `function sum($x, $y) : float // 반환값의 타입을 float 타입으로 설정`  


* 호출 

```
$sum = sum(1, 2); // 함수 sum()을 호출하면서, 인수로 1과 2를 전달
```


<br />    


### 클래스   

* 선언   

```
class 클래스이름
{
    function __construct(매개변수1, 매개변수2, ...)
    {
        생성자가 호출될 때 실행될 코드;
    }

    function __desturct()
    {
        소멸자가 호출될 때 실행될 코드;
    }
}
```


* 멤버 접근 

```
$객체이름->프로퍼티이름;
$객체이름->메소드이름;
```


객체 내부에서 해당 인스턴스의 프로퍼티에 접근하고 싶을 때는 특별한 변수인 $this를 사용할 수 있다.  

```
$this->프로퍼티이름;
```


