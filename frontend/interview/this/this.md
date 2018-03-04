this可以帮我们简化很多代码，省去很多麻烦，特别是当我们不知道一个对象叫什么，或者这个对象没有名字但又想要调用它的时候，就会使用到this对象。

this作用

当函数作为对象的方法调用时，this指向该对象。
当函数作为淡出函数调用时，this指向全局对象（严格模式时，为undefined）。
构造函数中的this指向新创建的对象。
嵌套函数中的this不会继承上层函数的this，如果需要，可以用一个变量保存上层函数的this。
ES6箭头函数内的this值继承自外围作用域。


this公理

this关键字永远都指向函数(方法)的所有者。

函数被赋值于变量时的this问题
作为对象方法的调用时的this问题
作为构造函数调用时的this问题
解决，闭包中的this指向问题
当this遇到一些特殊函数时的问题


```
alert(this === window); // true
```

```
var test = function(){
  alert(this === window);
 }
test(); // true
```

```
var test = function(){
  alert(this === window);
 }
new test(); // false
```

```
var test ={
  'a':1,
  'b':function(){
   alert(this === test)
  }
 }
test.b(); // true
```

```
var test ={
  'a':1,
  'b':function(){
   alert(this === test)
  }
 }
var test1 = test;
test1.b(); // true
```

```
var test ={
  'a':1,
  'b':{
   'b1':function(){
    alert(this === test);
   }
  }
 }
test.b.b1(); // false
```

```
var test ={
  'a':1,
  'b':{
   'b1':function(){
    alert(this === test.b);
   }
  }
 }
test.b.b1(); //true
```

```
var test = function(){
  var innerTest = function(){
   alert(this === test); // this为window
  }
  innerTest();
 }
test(); // false
```


```
var test = function() {
  alert(this === window);
}
var test1 = {}
test.apply(test1); // false
```

```
var test = function(){}
var my = function(){
  this.a = function(){
    alert(this === mytest2);
  }
}
var mytest = new my();
test.prototype = mytest;
var mytest2 = new test();
mytest2.a(); //true
```

```
<script>
  var mytest = function(context){
   alert(context.getAttribute('id')); // test
   alert(this === window); // true
  }
</script>
<div id="test" onclick="mytest(this)">aaaa</div>
```


## related

http://bonsaiden.github.io/JavaScript-Garden/zh/#function.this

http://www.jb51.net/article/77519.htm

https://www.zhihu.com/question/19636194