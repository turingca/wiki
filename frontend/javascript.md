概述
-------
本文修摘自《javascript权威指南》
本文涵盖：语言特性、内置api、工作在浏览器中、浏览器api（客户端api）。
javascript是一门弱类型、非传统面向对象的编程语言。
javascript和java是完全不同的两种编程语言，之于雷锋与雷峰塔。
ECMAScript是javascript的语言标准版本，现在最新版本为ES6。

以下先对javascript语言做一个快速概览
```javascript
//这是注释
var x; //声明变量
x=0    //通过等号赋值给变量
//javascript支持多种数据类型
x=1;               //数字
x=0.01;            //整数和实数共用一种数据类型
x="hello world";   //双引号内的文本构成的字符串
x='javascript';    //单引号内的文本构成的字符串
x=true;            //布尔值
x=false;           //布尔值
x=null;            //null是一个特殊的值，意思是”空“
x=undefined        //undefined和null非常类似
//javascript中的最重要的类型就是对象
//对象是名/值对的集合，或字符串到值映射的集合
var book = {            //对象是由花括号括起来的
    topic: "javascript",  //属性topic的值是javascript
    fat: true             //属性fat的值是true
}                       //右花括号标记了对象的结束
//通过“.”和“[]”来访问对象属性
book.topic                 //=> "javascript"
book.["fat"]               //=> true 另外一种获取属性的方式
book.author = "Flanagan";  //通过赋值创建一个新属性
book.contents = {};        //{}是一个空对象，它没有属性
//javascript数组（以数字为索引的列表）
var primes = [2, 3, 5, 7]; //拥有4个值的数组，由“[”和“]”划定边界
primes[0]                  //=> 2 数组中的第一个元素（索引为0）
primes.length              //=> 4 数组中元素个数
primes[primes.length -1]   //=> 7 数组的最后一个元素
primes[4] = 9;             //通过赋值来添加新元素
primes[4] = 11;            //或通过赋值来改变已有的元素
var empty = [];            //[]是空数组，它具有0个元素
empty.length               //=>0 空数组的长度为0
//数组和对象都可以包含另一个数组或对象
var points = [             //具有两个元素的数组
    {x: 0, y: 0},          //每个元素都是一个对象
    {x: 1, y: 1}
];
var data = {               //一个包含两个属性的对象
    trial1: [[1,2],[3,4]], //每一个属性都是数组
    trial2: [[2,3],[4,5]]  //数组的元素也是数组
};
//运算符作用于操作数，生成一个新的值
//最常见的是算术运算符
3 + 2                      //=> 5 加法                     
3 - 2                      //=> 1 减法
3 * 2                      //=> 6 乘法
3 / 2                      //=> 1.5 除法
points[1].x - points[0].x  //=> 1 更复杂的操作数也能照常工作
"3" + "2"                  //=> "32" 符号+可以完成加法运算也可以作字符串连接
//javascript定义了一些算术运算符的简写形式
var count = 0;             //定义一个变量
count++;                   //自增1
count--;                   //自减1
count += 2;                //自增2 和“count = count + 2;”写法一样
count *= 3;                //自乘3 和“count = count * 3;”写法一样
count                      //=> 6 变量名本身也是一个表达式
//相等关系运算符用来判断两值是否相等
//不等、大于、小于运算符的运算结果是true或false
var x = 2, y = 3;          //这里的=等号是赋值的意思，不是比较相等
x == y                     //=> false 相等
x != y                     //=> true 不等
x < y                      //=> true 小于
x <= y                     //=> true 小于等于
x > y                      //=> false 大于
x >= y                     //=> false 大于等于
"two" == "three"           //=> false 两个字符串不相等
"two" > "three"            //=> true “tw”在字母表中的索引大于“th”
false == (x > y)           //=> true false和false相等
//逻辑运算符是对布尔值的合并或求反
(x == 2) && (y ==3 )       //=> true 两个比较都是true，&&表示“与”
(x > 3) || (y < 3)         //=> false 两个比较都不是true，||表示“或”
!(x == y)                  //=> true !求反
//函数是带有名称和参数的javascript代码段，可以一次定义多次调用
function plus1(x) {        //定义了名为plus1的一个函数，带有参数x
    return x + 1;          //返回一个比传入的参数大的值
}                          //函数的代码块是由花括号包裹起来的部分
plus1(y)                   //=>4 y为3，调用函数的结果为 3 + 1
var square = function(x) { //函数是一种值，可以赋值给变量
    return x * x;          //计算函数的值
};                         //分号标识了赋值语句的结束
square(plus1(y))           //=> 16 在一个表达式中调用两个函数
//当将函数和对象合写在一起时，函数就变成了“方法”（method）
//当函数赋值给对象的属性，我们称为“方法”，所有的javascript对象都含有方法
var a = [];                           //创建一个空数组
a.push(1, 2, 3);                      //push()方法向数组中添加元素
a.reverse();                          //另一个方法：将数组元素的次序反转
//我们也可以定义自己的方法，“this”关键字是对定义方法的对象的引用，这里的例子是上文中提到的包含两个点位置信息的数组
points.dist = function() {            //定义一个方法用来计算两点之间的距离
    var p1 = this[0];                 //通过this获得对当前数组的引用
    var p2 = this[1];                 //并获得调用的数组前两个元素
    var a = p2.x - p1.x;              //x坐标轴上的距离
    var b = p2.y - p1.y;              //y坐标轴上的距离
    return Math.sqrt(a * a + b * b);  //勾股定理，用Math.sqrt()来计算平方根
}
points.dist();                        //=> 1.414 求得两个点之间的距离
//控制语句
function abs(x) {                     //求绝对值的函数
    if (x > =0) {                     //if语句
        return x;                     //如果比较结果为true则执行这里的代码
    }                                 //子句的结束
    else {                            //当if条件不满足时执行else子句
        return - x;                   //返回负x
    }                                 //如果分支中只有一条语句，花括号是可以省略的
}                                     //注意if/else中嵌套的return语句
function factorial(n) {               //计算阶乘的函数
    var product = 1;                  //给product赋值为1
    while (n > 1) {                   //当()内的表达式为true时循环执行{}内的代码
        product *= n;                 //product = product *n的简写形式
        n--;                          //n = n -1的简写形式
    }                                 //循环结束
    return product;                   //返回product
}
factorial(4)                          //=> 24 1*4*3*2
function factorial2(n) {              //实现循环的另一种写法
    var i, product = 1;               //给product赋值为1
    for (i = 2; i<=n; i++)            //将i从2自增至n
        product *= i;                 //循环体，当循环体中只有一句代码，可以省略{}
    return product;                   //返回计算好的阶乘
}
factorial2(5)                         //=> 120 1*2*3*4*5
//类，在javascript中定义一个类来表示2D平面几何中的点，这个类实例化的对象拥有一个名为r()的方法，用来计算该点到原点的距离
//定义一个构造函数以初始化一个新的point对象
function Point(x,y) {                 //按照惯例，构造函数均以大写字母开始
    this.x = x;                       //关键字this指代初始化的实例
    this.y = y;                       //将函数参数存储为对象的属性
}                                     //不需要return
//使用new关键字和构造函数来创建一个实例
var p =new Point(1, 1);               //平面几何中的点(1,1)
//通过给构造函数的prototype对象赋值
//来给Point对象定义方法
Point.prototype.r = function() {
    return Math.sqrt(                 //返回 x*x + y*y的平方根
    this.x * this.x +                 //this指代调用这个方法的对象
    this.y * this.y);
}
//Point的实例对象p（以及所有的Point实例对象）继承了方法r()
p.r()                                 //=> 1.414...
```


todo



词法结构
----------
编程语言的词法结构是一套基础性规则，用来描述如何使用这门语言来编写程序。
字符集：
javascript程序是用Unicode字符集编写的。Unicode是ASCII和Latin-1的超集，并支持地球上几乎所有在用的语言。
区分大小写：
javascript是区分大小写的语言。与html中标签和属性同名的javascript必须小写，例如在html中可以写成onClick，但在javascript中必须写成小写onclick。
空格、换行符和格式控制符：
javascript会忽略程序中标识[token](https://en.wikipedia.org/wiki/Token)之间的空格


类型、值和变量
--------------

表达式和运算符
--------------

语句
----

对象
----

数组
----

函数
----

类和模块
--------

正则表达式的模式匹配
--------------------

javascript的子集和扩展
----------------------

服务器端javascript
--------------------

web浏览器中的javascript
-----------------------

window对象
----------

脚本化文档
----------

脚本化css
---------

事件处理
--------

脚本化http
----------

jquery类库
----------

客户端存储
----------

多媒体和图形编程
----------------

HTML5 API
------------

javascript核心参考
------------------
参考文档：包括javascript语言核心定义的类、方法和属性。
|Arguments|EvalError|Number|String|
|Array|Function|Object|SyntaxError|
|Boolean|Global|RangeError|TypeError|
|Date|JSON|ReferenceError|URIError|
|Error|Math|RegExp||

客户端javascript核心参考
-----------------------
javascript语言核心怎对文本、数组、日期和正则表达式的操作定义了很少的api，但是这些api不包括输入输出功能。输入和输出功能（类似网络、存储和图形相关的复杂特性）是由javascript所属的宿主环境提供的，这里所说的宿主环境通常是web浏览器，还有其他。




