前言
-------

本文修摘自《javascript权威指南》第6版


第1章 javascript概述
--------------------

JavaScript是面向Web的编程语言。绝大多数现代网站都使用了JavaScript，并且所有的现代Web浏览器——基于桌面系统、游戏机、平板电脑和智能手机的浏览器——均包含了JavaScript解释器。这使得JavaScript能够称得上史上使用最广泛的编程语言。JavaScript也是前端开发工程师必须掌握的三种技能之一：描述网页内容的HTML、描述网页样式的CSS以及描述网页行为的JavaScript。本书能够帮助你掌握JavaScript这门语言。

如果你有其他语言的编程经历，这会有助你了解JavaScript是一门高端的、动态的、弱类型的编程语言，非常适合面向对象和函数式的编程风格。JavaScript的语法源自Java，它的一等函数（first-class function）来自于Scheme，它的基于原型（prototype-based）的继承来自于Self。

但使用本书学习不必去了解那些（Java/Scheme/Self）语言或熟悉那些术语。

JavaScript这个名字经常被误解。除了语法看起来和Java类似之外，JavaScript和Java是完全不同的两种编程语言。JavaScript早已超出了其脚本语言（scripting-language）本身的范畴，而成为一种集健壮性、高效性和通用性为一身的编程语言。最新语言版本为严谨的大型软件开发定义了诸多新的特性。

ECMAScript是JavaScript的语言标准版本，现在最新版本为ES6。

**1.1JavaScript语言核心**

本节是JavaScript语言的一个快速概览，也是本书第一部分的快速概览。在本章之后，我们将着重关注JavaScript的基础知识，第2章讲解JavaScript注释、分号和Unicode字符集；第3章会更加有意思，主要讲解JavaScript变量和赋值。这里有一些示例代码来说明这两章的的重点内容：

```javascript
//这是注释
var x; //声明变量
x=0;    //通过等号赋值给变量
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
book["fat"]               //=> true 另外一种获取属性的方式
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
var p = new Point(1, 1);               //平面几何中的点(1,1)
//通过给构造函数的prototype对象赋值
//来给Point对象定义方法
Point.prototype.r = function() {
    return Math.sqrt(               //返回 x*x + y*y的平方根
        this.x * this.x +           //this指代调用这个方法的对象
        this.y * this.y
    );
}
//Point的实例对象p（以及所有的Point实例对象）继承了方法r()
p.r()                                 //=> 1.414...
```

第9章是第一部分的精华所在，后续的章节做了一些零星的延伸，将我们对JavaScript语言核心的探索带向尾声。第10章主要讲解了正则表达式的语法，并演示了如何使用这些“正则表达式”进行文本的模式匹配。第11章介绍JavaScript语言核心的子集和超集。最后，在进入客户端JavaScript的内容之前，第12章介绍两种在web浏览器之外的两种JavaScript运行环境。

**1.2客户端JavaScript**

JavaScript语言核心部分的内容中的知识点交叉引用比较多，且知识点的层次感并不分明。而在客户端JavaScript部分的内容编排方式有了较大改变。依照本书给定的知识点顺序进行学习，完全可以学会如何在Web浏览器中使用JavaScript。但如果你想通过阅读本书来学习客户端JavaScript的话，不能只将眼光落在第二部分，所以本书会对于客户端编程技术做一个快速概览，随后会给出一个深度的示例。

第13章是第二部分的第一章，该章介绍如何让JavaScript在Web浏览器中运行起来。从该章学到的最重要的内容是，JavaScript代码可以通过script标签来嵌入到HTML文件中：

```
<html>
<head>
引入一个javascript库
<script src="library.js"></script>
</head>
<body>
<p>this is a paragraph of HTML</p>
<script>
在这里编写嵌入到HTML文件中的javascript代码
</script>
<p>here is more HTML.</p>
</body>
</html>
```

第14章讲解Web浏览器脚本技术，并涵盖客户端JavaScript中的一些重要全局函数。

例如：
```javascript
function moveon() {
    //通过弹出一个对话框来询问用户问题
    var answer = confirm("准备好了吗?");
    //单击“确定”按钮，浏览器会加载一个新页面
    if(answer) window.location = "http://taobao.com";
}
//在1分钟（6万毫秒）后执行定义的这个函数
setTimeout(moveon,6000);
```

我们注意到，本节展示的客户端示例代码要比前面的示例代码要长很多。这里的示例代码并不是用在Firebug（或者其他调试工具）控制台窗口中直接输入的，而是作为一个单独的HTML文件，并在Web浏览器中直接打开运行的。比如，上述代码段就是一个HTML文件的完整内容。

第15章的内容更加务实——通过脚本来操纵HTML文档内容。它将展示如何选取特定的HTML元素、如何给HTML元素设置属性、如何修改元素内容，以及如何给文档添加新节点。这里的示例函数展示了如何查找和修改基本文档的内容：

```javascript
//在document中的一个指定的区域输出调试消息
//如果document不存在这样一个区域，则创建一个
function debug(msg) {
    //通过查看HTML元素id属性来查找文档的调试部分
    var log = document.getElementById("debuglog");
    //如果这个元素不存在，则创建一个
    if(!log) {
        log = document.createElement("div"); //创建一个新的div元素
        log.id = "debuglog"; //给这个元素的HTML id赋值
        log.innerHTML = "<h1>DebugLog</h1>"; //定义初始内容
        document.body.appendChild(log); //将其添加到文档的末尾
    }
    //将消息包装到<pre>中，并添加至log中
    var pre = document.createElement("pre"); // 创建pre标签
    var text = document.createTextNode(msg); // 将msg包装在一个文本节点中
    pre.appendChild(text); // 将文本添加至pre
    log.appendChild(pre);  // 将pre添加至log
}
```


第2章 词法结构
--------------
编程语言的词法结构是一套基础性规则，用来描述如何使用这门语言来编写程序。作为语法基础，它规定了诸如变量名是什么样的、怎么写注释，以及程序语句之间如何分隔等规则。本章用很短的篇幅来介绍JavaScript的词法结构。

**2.1字符集**

JavaScript程序是用Unicode字符集编写的。Unicode是ASCII和Latin-1的超集，并支持地球上几乎所有在用的语言。ECMAScript3要求JavaScript的实现必须支持Unicode2.1及后续版本，ECMAScript5则要求支持Unicode3及后续版本。可以参考3.2节的“边栏”来了解更多关于Unicode和JavaScript的信息。

**2.1.1区分大小写**

JavaScript是区分大小写的语言。也就是说，关键字、变量、函数名和所有的标识符（identifier）都必须采取一致的大小写形式。比如，关键字“while”必须写成“while”，而不能写成“While”或者“WHILE”。同样，“online”、“Online”、“OnLine”和“ONLINE”是4个不同的变量名。

但需要注意的是，HTML并不区分大小写（尽管XHTML区分大小写）。由于它和客户端JavaScript联系紧密，因此这点区分很容易混淆。许多客户端JavaScript对象和属性与它们所表示的HTML标签和属性同名。在HTML中，这些标签和属性名可以使用大写也可以是小写，而在JavaScript中则必须是小写。例如，在HTML中设置事件处理程序时，onclick属性可以写成onClick，但在javascript中必须写成小写onclick。

**2.1.2空格、换行符和格式控制符**

JavaScript会忽略程序中标识（token）之间的空格。多数情况下，JavaScript同样会忽略换行符（2.5节提到一种意外情形）。由于可以在代码中随意使用空格和换行，因此可以采用整齐、一致的缩进来形成统一的编码风格，从而提高代码的可读性。

除了可以识别普通的空格符（\u0020），JavaScript还可以识别如下这些表示空格的字符：水平制表符（\u0009）、垂直制表符（\u0008）、换页符（\u000C）、不中断空白（\u00A0）、字节序标记（\uFEFF），以及在Unicode中所有Zs类别的字符。JavaScript将如下字符识别为行结束符：换行符（\u000A），回车符（\u000D），行分隔符（\u2028），段分隔符（\u2029）。回车符加换行符在一起被解析为一个单行结束符。

Unicode格式控制字符（Cf类），比如“从右至左书写标记”（\u200F）和“从左至右书写标记”（\u200E），控制着文本的视觉显示，这对于一些非英语文本的正确显示来说是至关重要的，这些字符可以用在JavaScript的注释、字符串直接量和正则表达式直接量中，但不能用在标识符（比如，变量名）中。但有个例外，零宽连接符（\u200D）和零宽非连接符（\uFEFF）是可以出现在标识符中的，但不能作为标识符的首字符。上文也提到了，字节序标记格式控制符（\uFEFF）被当成了空格来对待。

**2.1.3Unicode 转义序列**

在有些计算机硬件和软件里，无法显示或输入Unicode字符全集。为了支持那些使用老旧技术的程序员、JavaScript定义了一种特殊序列，使用6个ASCII字符来代表任意16位Unicode内码。这些Unicode转义序列均以\u前缀，其后跟随4个十六进制数（使用数字以及大写或小写字母A~F表示）。这种Unicode转义写法可以用在JavaScript字符串直接量、正则表达式直接量和标识符中（关键字除外）。例如，字符é的Unicode转义写法为\u00E9，如下两个JavaScript字符串是完全一样的：

```javascript
"café" === "caf\u00e9" //=>true
```

Unicode转义写法也可以出现在注释中，但由于JavaScript会将注释忽略，它们只是被当成上下文中的ASCII字符处理，而且并不会被解析为其对应的Unicode字符。

**2.1.4标准化**

Unicode允许使用多种方法对同一个字符进行编码。比如，字符“é”可以使用Unicode字符\u00E9表示，也可以使用普通的ASCII字符e跟随一个语调符\u0301。在文本编辑器中，这两种编码的显示结果一模一样，但它们的二进制编码表示是不一样的，在计算机里也不相等。Unicode标准为所有字符定义了一个首选的编码格式，并给出了一个标准化的处理方式将文本转换为一种适合比较的标准格式，Javascript会认为它正在解析的程序代码已经是这种标准格式，不会再对其标识符、字符串或正则表达式作标准化处理。

**2.2注释**

javascript支持两种格式的注释。在行尾“//”之后的文本都会被javascript当做注释忽略掉。此外，“/*”和“*/”之间的文本也会当做注释，这种注释可以跨行书写，但不能有嵌套的注释。下面都是合法的Javascript注释：
```javascript
//这里是单行注释
/*这里是一段注释*/ //这里是另一段注释
/*
*这又是一段注释
*这里的注释可以连写多行
*/
```

**2.3直接量**

所谓直接量（literal），就是程序中直接使用的数据值。下面列出的都是直接量：
```javascript
12 //数字
1.2//小数
"hello world"//字符串文本
'Hi'//另一个字符串
true//布尔值
false//另一个布尔值
/javascript/gi //正则表达式直接量（用做模式匹配）
null //空
```
第三章会详细讲解数字和字符串直接量。正则表达式直接量会在第10章讲解。更多复杂的表达方式（参见4.2节）可以写成数组或对象直接量，例如：
```javascript
{x:1,y:2}//对象
[1,2,3,4,5]//数组
```

**2.4标识符和保留字**

标识符就是一个名字。在JavaScript中，标识符用来对变量和函数进行命名，或者用做JavaScript代码中某些循环语句中的跳转位置的标记。在JavaScript标识符必须以字母、下划线（_）或美元符（$）开始。后续的字符可以是字母、数字、下划线或美元符（数字是不允许作为首字符出现的，以便JavaScript可以轻易区分开标识符和数字）。下面是合法的标识符：

```
i
my_variable_name
v13
_dummy
$str
```

由于可移植性和易于书写的考虑，通常我们只使用ASCII字母和数字来书写标识符。然而需要注意的是，JavaScript允许标识符中出现Unicode字符全集中的字母和数字。（从技术上讲，ECMAScript标准也允许在标识符的首字符后面出现Unicode字符集中的Mn类、Mc类和Pc类）。由此，程序员也可以使用非英语语言或数学符号来书写标识符：

```javascript
var sí = true;
var π = 3.14;
```

和其他任何编程语言一样，JavaScript保留了一些标识符为自己所用。这些“保留字”不能用做普通的标识符，下面会讲到。

*保留字：*

javascript把一些标识符拿出来用做自己的关键字。因此，就不能再在程序中把这些关键字用做标识符了：

```javascript
break delete function return typeof case do if switch var catch else in this void continue false instanceof throw while debugger finally new true with default for null try
```

JavaScript同样保留了一些关键字，这些关键字在当前的语言版本中并没有使用，但在未来版本中可能会用到。ECMAScript5保留了这些关键字：

```javascript
class const enum export extends import super
```

此外，下面这些关键字在普通的javascript代码中是合法的，但是在严格模式下是保留字：
```javascript
implements let private public yield
interface package protected static
```

严格模式同样对下面的标识符的使用做了严格限制，它们并不完全是保留字，但不能用做变量名、函数名或参数名：

```javascript
arguments eval
```

ECMAScript3将Java的所有关键字都列为自己的保留字，尽管这些保留字在ECMAScript5中放宽了限制，但如果你希望代码能在基于ECMAScript3实现的解释器上运行的话，应当避免使用这些关键字作为标识符：

abstract double goto native static boolean enum implements package super byte export import private synchronized char extends int protected throws class final interface public transient const float long short volatile

JavaScript预定义了很多全局变量和函数，应当避免把它们的名字用做变量名和函数名：

arguments encodeURI Infinity Number RegExp Array encodeURIComponent isFinite Object String Boolean Error isNaN parseFloat SyntaxError
Date eval JSON parseInt TypeError decodeURI EvalError Math RangeError undefined decodeURIComponent Function NaN ReferenceError URIError

JavaScript的具体实现可能定义独有的全局变量和函数，每一种特定的JavaScript运行环境（客户端、服务器端等）都有自己的一个全局属性列表，这一点是需要牢记的。参照第四部分的Window对象来了解客户端JavaScript中定义的全局变量和函数列表。

**2.5可选的分号**

和其他编程语言一样，JavaScript使用分号（;）将语句（参见第5章）分隔开。这对增强代码的可读性和整洁性是非常重要的：缺少分隔符，一条语句的结束就成了下一条语句的开始，反之亦然。在JavaScript中，如果语句各自独占一行，通常可以省略语句之间的分号（程序结尾或右花括号“}”之前的分号也可以省略）。许多JavaScript程序员（包括本书中的示例代码）使用分号来明确标记语句的结束，即使在并不完全需要分号的时候也是如此。另一种风格就是，在任何可以省略分号的地方都将其省略，只有在不得不用的时候才使用分号。不管采用哪种编程风格，关于JavaScript中可选分号的问题有几个细节需要注意。

考虑如下代码，因为两条语句用两行书写，第一个分号是可以省略掉的：
```javascript
a = 3;
b = 4;
```
如果按照如下格式书写，第一个分号则不能省略：
```javascript
a = 3; b = 4;
```
需要注意的是，JavaScript并不是在所有行处都填补分号：只有在缺少了分号就无法正确解析代码的时候，JavaScript才会填补分号。换句话讲（类似下面代码中的两处异常），如果当前语句和随后的非空格字符不能当成一个整体来解析的话，JavaScript就在当前语句行结束处填补分号。看一下如下代码：
```javascript
var a
a
=
3
console.log(a)
```
javascript将其解析为：
```javascript
var a; a = 3; console.log(a);
```
JavaScript给第一行换行处添加了分号，因为如果没有分号，JavaScript就无法解析代码 var a a。

第二个a可以单独当做一条语句“a;”，但JavaScript并没有给第二行结尾填补分号，因为它可以和第三行内容一起解析成“a=3;”。

这些语句的分隔规则会导致一些意想不到的情形，这段代码写成了两行，看起来是两条独立的语句：
```javascript
var y = x + f
(a+b).toString()
```
但第二行的圆括号却和第一行的f组成了一个函数调用，JavaScript会把这段代码看作做：
```javascript
var y = x + f(a+b).toString();
```
而这段代码的本意并不是这样。为了能让上述代码解析为两条不同的语句，必须手动填写行尾的显式分号。

通常来讲，如果一条语句以“(”、“[”、“/”、“+”或“-”开始，那么它极有可能和前一条语句合在一起解析。以“/”、“+”和“-”开始的语句并不常见，而以“(”和“[”开始的语句则非常常见，至少在一些JavaScript编码风格中是很普遍的。有些程序员喜欢保守地在语句前加一个分号，这样哪怕之前的语句被修改了，分号被误删了，但前语句还是会正确地被解析：
```javascript
var x = 0 //这里省略了分号
;[x,x+1,x+2].forEach(console.log); //前面的分号保证了正确地语句解析
```
如果当前语句和下一行语句无法合并解析，JavaScript则在第一行后填补分号，这是通用规则，但有两个例外。第一个例外是在涉及return、break和continue语句的场景中。如果这三个关键字后紧跟着换行，javascript则会在换行处填补分号。例如，这段代码：
```javascript
return
true;
```
javascript会被解析成：
```javascript
return; true;
```
而代码的本意是这样：
```javascript
return true;
```
也就是说，在return、break和continue和随后的表达式之间不能有换行。如果添加了换行，程序则只有在极特殊的情况的下才会报错，而且程序的调试非常不方便。

第二个例外是在涉及“++”和“--”运算符（见4.8节）的时候。这些运算符可以作为表达式的前缀，也可以当做表达式的后缀。如果将其用做后缀表达式，它和表达式应当在同一行。否则，行尾将填补分号，同时“++”或“--”将会作为下一行代码的前缀操作符并与之一起解析，例如，这段代码：
```javascript
x
++
y
```
这段代码将被解析为“x;++y”，而不是“x++;y”。

第3章 类型、值和变量
--------------------

计算机程序的运行需要对值（value）（比如数字3.14或文本“hello world”）进行操作。

在编程语言中，能够表示并操作的值的类型称做数据类型（type），编程语言最基本的特性就是能够支持多种数据类型。当程序需要将值保存起来以备将来使用时，便将其赋值给（将值“保存”到）一个变量（variable）。变量是一个值的符号名称，可以通过名称来获得对值得引用。变量的工作机制是编程语言的另一个基本特性。本章将详细讲解JavaScript中的类型、值和变量。这里的引言只做概述，你可以通过参照1.1节来帮助理解本章内容。后续章节会更深入地讲解。

JavaScript的数据类型分为两类：原始类型（primitive type）和对象类型（object type）。

JavaScript中的原始类型包括数字、字符串和布尔值，本章会有单独的章节专门讲述JavaScript中的数字（见3.1节）和字符串（见3.2节），布尔值将会在3.3节讲解。

JavaScript中有两个特殊的原始值，null（空）和undefined（未定义），它们不是数字、字符串和布尔值。它们通常分别代表了各自特殊类型的唯一的成员。3.4节将会详细讲解null和undefined。

JavaScript中除了数字、字符串、布尔值、null和undefined之外的就是对象了。对象（object）是属性（property）的集合，每个属性都由“名/值对”（值可以是原始值，比如数字、字符串，也可以是对象）构成。

其中一个比较特殊的对象——全局对象（global object）会在3.5节介绍，第6章会有更完整详细的描述。

普通的JavaScript对象是“命名值”的无序集合。JavaScript同样定义了一种特殊对象——数组（array），表示带编号的值的有序集合。JavaScript为数组定义了专用的语法，使数组拥有一些和普通对象不同的特有行为特性。第7章将专门讲述数组。

JavaScript还定义了另一种特殊对象——函数。函数是具有与它相关联的可执行代码的对象，通过调用函数来运行可执行代码，并返回运算结果。和数组一样，函数的行为特征和其他对象都不一样。JavaScript为使用函数定义了专用语法。对于JavaScript函数来讲，最重要的是，它们都是真值，并且JavaScript可以将它们当做普通对象来对待。第8章会专门讲述函数。

如果函数用来初始化（使用new运算符）一个新建的对象，我们称之为构造函数（constructor）。每个构造函数定义了一类（class）对象——由构造函数初始化的对象组成的集合。类可以看做是对象类型的子类型。除了数组（Array）类和函数（Function）类之外，JavaScript语言核心定义了其他三种有用的类。日期（Date）类定义了代表日期的对象。正则（RegExp）类定义了表示正则表达式（一种强大的模式匹配工具，在第10章会讲到）的对象。错误（Error）类定义了那些表示JavaScript程序中运行时错误和语法错误的对象。可以通过定义自己的构造函数来定义需要的类。这会在第9章讲述。

JavaScript解释器有自己的内存管理机制，可以自动对内存进行垃圾回收（garbage collection）。

这意味着程序可以按需创建对象，程序员则不必担心这些对象的销毁和内存回收。当不再有任何引用指向一个对象，解释器就会知道这个对象没用了，然后自动回收它所占用的内存资源。

JavaScript是一种面向对象的语言。不严格地讲，这意味着我们不用全局的定义函数去操作不同类型的值，数据类型本身可以定义方法（method）来使用值。例如，要对数组a中的元素进行排序，不必要将a传入sort()函数，而是调用a的一个方法sort():

    a.sort();// sort(a)的面向对象的版本
    
第9章将会讲述方法的定义。从技术上讲，只有JavaScript对象才能拥有方法。然而，数字、字符串和布尔值也可以拥有自己的方法（3.6节解释其工作机制）。在JavaScript中，只有null和undefined是无法拥有方法的值。

JavaScript的类型可以分为原始类型和对象类型，也可分为可以拥有方法的类型和不能拥有方法的类型，同样可分为可变（mutable）类型和不可变（imuutable）类型。可变类型的值是可修改的。对象和数组属于可变类型：JavaScript程序可以更改对象属性值和数组元素的值。数字、布尔值、null和undefined属于不可变类型——比如，修改一个数值的内容本身就说不通。字符串可以看成由字符组成的数组，你可能会认为它是可变的。然而在JavaScript中，字符串是不可变的：可以访问字符串任意位置的文本，但JavaScript并未提供修改已知字符串的文本内容的方法。3.7节会详细讲解可变类型和不可变类型的不同支持。

JavaScript可以自由地进行数据类型转换。比如，如果在程序期望使用字符串的地方使用了数字，JavaScript会自动将数字转换为字符串。如果在期望使用布尔值的地方使用了非布尔值，JavaScript也会进行相应的转换。类型转换规则将在3.8节讲述。JavaScript中灵活的类型转换规则对“判断相等”（equality）的定义亦有影响。等号运算符“==”所进行的类型转换细节将在3.8.1节详细讲述。

JavaScript变量是无类型的（untyped），变量可以被赋予任何类型的值，同样一个变量也可以重新赋予不同类型的值。使用var关键字来声明（declare）变量。JavaScript采用词法作用域（lexical scoping）。

不在任何函数内声明的变量称做全局变量（global variable），它在JavaScript程序中的任何地方都是可见的。

在函数内声明的变量具有函数作用域（function scope），并且只在函数内可见。变量声明和作用域将会在3.9节和3.10节详细讲解。

**3.1数字**

和其他编程语言不同，JavaScript不区分整数值和浮点数值。JavaScript中的所有数字均用浮点数值表示。JavaScript采用IEEE 754标准定义的64位浮点格式表示数字，这意味着它能表示的最大值是（正负1.7976931348623157乘以10的308次方），最小值是（正负5乘以10负324次方）。

按照JavaScript中的数字格式，能够表示的整数范围是从-9007199254740992~9007199254740992（即-2的53次方~2的53次方），包含边界值。如果使用了超过此范围的整数，则无法保证低位数字的精度。然而需要注意的是，JavaScript中实际的操作（比如数组索引，以及第4章讲到的位操作符）则是基于32位整数。

当一个数字直接出现在JavaScript程序中，我们称之为数字直接量（numeric literal）。

JavaScript支持多种格式的数字直接量，在接下来的小节中会有讨论。注意，在任何数字直接量前添加负号（-）可以得到它们的负值。但负号是一元求反运算符（参见第4章），并不是数字直接量语法的组成部分。

**3.1.1整型直接量**

在JavaScript程序中，用一个数字序列表示一个十进制整数。例如：
```javascript
0
3 
10000000
```
除了十进制的整型直接量，JavaScript同样能识别十六进制（以16为基数）值。所谓十六进制的直接量是指以“0x”或“0X”为前缀，其后跟随十六进制数串的直接量。十六进制值是0~9之间的数字和a（A）~f（F）之间的字母构成，a-f的字母对应的表示数字10~15。下面是十六进制整型直接量的例子：
```javascript
0xff //15*16 + 15 = 255（十进制）
0xCAFE911
```
尽管ECMAScript标准不支持八进制直接量，但JavaScript的某些实现可以允许采用八进制（基数为8）形式表示整数。八进制直接量以数字0开始，其后跟随一个由0~7（包括0和7）之间的数字组成的序列，例如：

    0377 //3*64 + 7*8 + 7 = 255（十进制）
    
由于某些JavaScript的实现支持八进制直接量，而有些不支持，因此最好不要使用以0为前缀的整型直接量，毕竟我们也无法得知当前JavaScript的实现是否支持八进制的解析。在ECMAScript6（见5.7.3节）的严格模式下，八进制直接量是明令禁止的。

**3.1.2浮点型直接量**

浮点型直接量可以含有小数点，它们采用的是传统的实数写法。一个实数由整数部分、小数点和小数部分组成。

此外，还可以使用指数记数法表示浮点型直接量，即在实数后跟字母e或E，后面再跟正负号，其后再加一个整型的指数。这种记数方法表示的数值，是由前面的实数乘以10的指数次幂。

可以使用更简洁的语法表示：

    [digits][.digits][(E|e)[(+|-)]digits]

例如：
```javascript
3.14
2345.789
.333333333333333333
6.02e23 //6.02乘以10的23次方
1.4738223E-32 //1.4738223乘以10的负32次方
```

**3.1.3 JavaScript中的算术运算**

JavaScript程序是使用语言本身提供的算术运算符来进行数字运算的。这些运算符包括加法运算符（+）、减法运算符（-）、乘法运算符（*）、除法运算符（/）和求余（求整除后的的余数）运算符（%）。第4章将详细介绍这些以及更多的运算符。

除了基本的运算符外，JavaScript还支持更加复杂的算术运算，这些复杂的运算通过作为Math对象的属性定义的函数和常量来实现：
```javascript
Math.pow(2,53)//=> 9007199254740992 2的53次幂
Math.round(.6)//=> 1.0 四舍五入
Math.ceil(.6)//=> 1.0 向上取整
Math.floor(.6)//=> 0.0 向下取整
Math.abs(-5)//=> 5 取绝对值
Math.max(x,y,z)//=> 返回最大值
Math.min(x,y,z)//=> 返回最小值
Math.random()//=> 生成一个大于等于0小于1.0的伪随机数
Math.PI //=> π 圆周率
Math.E //=> e 自然对数的底数
Math.sqrt(3) //=> 3的平方根
Math.pow(3，1/3) //=> 3的立方根
Math.sin(0) //=> 三角函数 还有Math.cos，Math.atan等
Math.log(10) //=> 10的自然对数
Math.log(100)/Math.LN10 //=> 以10为底100的对数
Math.log(512)/Math.LN2 //=> 以2为底512的对数
Math.exp(3) //e的三次幂
```
参阅第三部分中关于Math对象的介绍，那里列出了JavaScript所支持的所有数学函数。

JavaScript中的算术运算在溢出（overflow）、下溢（underflow）或被清零整除时不会报错。当数字运算结果超过了JavaScript所能表示的数字上限（溢出），结果为一个特殊的无穷大（infinity）值，在JavaScript中以infinity表示。同样地，当负数的值超过了JavaScript所能表示的负数范围，结果为负无穷大，在JavaScript中以-infinity表示。无穷大值的行为特性和我们所期望的是一致的：基于它们的加、减、乘和除运算结果还是无穷大值（当然还保留它们的正负号）。

下溢（underflow）是当运算符结果无限接近于零并比JavaScript能表示的最小值还小的时候发生的一种情形。这种情况下，JavaScript将会返回0。当一个负数发生小溢时，JavaScript返回一个特殊的值“负零”。这个值（负零）几乎和正常的零完全一样，JavaScript程序员很少用到负零。

被零整除在JavaScript并不报错，它只是简单的返回无穷大（infinity）或负无穷大（-infinity）。但有一个例外，零除以零是没有意义的，这种整除运算结果也是一个非数字（not-a-number）值，用NaN表示。无穷大除以无穷大、给任意负数作开方运算或者算术运算符与不是数字或无法转换为数字的操作数一起使用时都将返回NaN。

JavaScript预定义了全局变量infinity和NaN，用来表示正无穷大和非数字值。在ECMAScript3中，这两个值是可读/写的，并可修改。ECMAScript5修正了这个错误，将它们定义为只读的。在ECMAScript3中Number对象定义的属性值也是只读的。这里有：
```javascript

Infinity //将一个可读/写的变量初始化为infinity
Number.POSITIVE_INFINITY //同样的值，只读
1/0 //这也是同样的值
Number.MAX_VALUE + 1 //就算结果还是Infinity
Number.NEGATIVE_INFINITY //该表达式表示了负无穷大
-Infinity
-1/0
-Number.MAX_VALUE - 1;
NaN //将一个可读/写的变量初始化为NaN
Number.NaN//同样的值，但是只读
0/0 计算结果是NaN
Number.MIN_VALUE/2 //发生下溢，计算结果为0
-Number.MIN_VALUE/2 //负零
-1/Infinity //同样是负零
-0
```
JavaScript中的非数字值有一点特殊：它和任何值都不相等，包括自身。也就是说，没办法通过x==NaN来判断变量x是否是NaN。相反，应当使用x!=x来判断，当且仅当x为NaN的时候，表达式的结果才为true。函数isNaN()的作用与此类似，如果参数是NaN或者是一个非数字值（比如字符串和对象），则返回true。JavaScript中有一个类似的函数isFinite()，在参数不是NaN、Infinity或-Infinity的时候返回true。

负零值同样有些特殊，它和正零值是相等的（甚至使用JavaScript的严格相等测试来判断）。这意味着这两个值几乎一模一样，除了作为除数之外：
```javascript
var zero = 0;//正常的零值
var negz = -0;//负零值
zero === negz;//=>true 正零值和负零值相等
1/zero === 1/negz;//=>false 正无穷大和负无穷大不等
```

**3.14二进制浮点数和四舍五入错误**

实数有无数个，但JavaScript通过浮点数的形式只能表示其中有限的个数（确切地说是18437736874454810627个）。也就是说，当在JavaScript中使用实数的时候，常常只是真实值的一个近似表示。

JavaScript采用了IEEE-754浮点数表示法（几乎所有现代编程语言所采用），这是一种二进制表示法，可以精确地表示分数，比如1/2、1/8和1/1024。遗憾的是，我们常用的分数（特别是在金融计算方面）都是十进制分数1/10、1/100等。二进制浮点数表示法并不能精确表示类似0.1这样简单的数字。

JavaScript中的数字具有足够的精度，并可以极其近似于0.1。但事实是，数字不能精确表述的确带来了一些问题。看下面这段代码：
```javascript
var x = .3 -.2;//30美分减去20美分
var y = .2 -.1;//20美分减去10美分
x == y //=>false 两值不相等
x == .1 //=>false .3 - .2 不等于.1
y == .1 //=>true .2 - .1 等于.1
```
由于舍入误差，0.3和0.2之间的近似差值实际上并不等于0.2和0.1之间近似的差值（在JavaScript的真实运行环境中，0.3-0.2=0.099 999 999 999 999 98。）。这个问题并不只在JavaScript中才会出现，理解这一点非常重要：在任何使用二进制浮点数的编程语言中都会出现这个问题。同样需要注意的是，上述代码中x和y的值非常接近彼此和最终的正确值。这种计算结果可以胜任大多数的计算任务：这个问题也只有在比较两个值是否相等的时候才出现。

JavaScript的未来版本或许会支持十进制数字类型以避免这些舍入问题。在这之前你可能更愿意使用大整数进行重要的金融计算。例如：要使用整数“分”而不要使用小数“元”进行基于货币单位的运算。

**3.1.5日期和时间**

JavaScript语言核心包括Date()构造函数，用来创建表示日期和时间的对象。这些日期对象的方法为日期计算提供了简单的API。日期对象不像数字那样是基本数据类型。本节给出了使用日期对象的一个简单教程。在第三部分可以查阅更多细节：
```javascript
var then = new Date(2011, 0, 1);//2011年1月1日
var later = new Date(2011, 0, 1, 17, 10, 30);//同一天，当地时间5:10:30pm
var now = new Date();//当前日期和时间
var elapsed = now - then;//日期减法 计算时间间隔的毫秒数
later.getFullYear() //=>2011
later.getMonth() //=>0 从0开始计数的月份
later.getDate() //=>1 从1开始计数的天数
later.getDay() //=>5  得到星期几，0代表星期日，5代表星期五
later.getHours() //=>当地时间17：5pm
later.getUTCHours() //使用UTC表示小时的时间，基于时区
```

**3.2文本**

字符串（string）是一组由16位值组成的不可变的有序序列，每个字符通常来自于Unicode字符集。JavaScript通过字符串类型来表示文本。字符串的长度（length）是其所含16位值的个数。JavaScript字符串（和其数组）的索引从零开始：第一个字符的位置是0，第二个字符的位置是1，以此类推。空字符串（empty string）长度为0，JavaScript中并没有表示单个字符的“字符型”。要表示一个16位值，只需将其赋值给字符串变量即可，这个字符串长度为1。

字符集，内码和JavaScript字符串：JavaScript采用UTF-16编码的Unicode字符集，JavaScript字符串是由一组无符号的16位值组成的序列。

最常用的Unicode字符（这些字符属于“基于多语种平面”）都是通过16位的内码表示，并代表字符串中的单个字符，那些不能表示为16位的Unicode字符则遵循UTF-16编码规则——用两个16位值组成的一个序列（亦称做“代理项对”）表示。

这意味着一个长度为2的JavaScript字符串（两个16位值）有可能表示一个Unicode字符：
```javascript
var p = "π";//π由16位内码表示0x03c0
var e = "e";//e由17位内码表示0x1d452
p.length //=>1 p包含一个16位值
e.length //=>2 e通过UTF-16编码后包含两个16位值："\ud835\udc52"
```
JavaScript定义的各式字符串操作方法均作用于16位值，而非字符，且不会对代理项对做单独处理，同样JavaScript不会对字符串做标准化的加工，甚至不能保证字符串是合法的UTF-16格式。


**3.2.1字符串直接量**

在JavaScript程序中的字符串直接量，是由单引号或双引号括起来的字符序列。由单引号定界的字符串中可以包含双引号，由双引号定界的字符串中也可以包含单引号。这里有几个字符串直接量的例子：
```javascript
""//空字符串，它包含0个字符
'testing'
"3.14"
'name="myform"'
"wouldn't you prefer O'Reilly's book?"
"this string\nhas two lines"
"π is the ratio of a circle's circumference to its diameter"
```
在ECMAScript3中，字符串直接量必须写在一行中，而在ECMAScript5中，字符串直接量可以拆分成数行，每行必须以反斜线（\）结束，反斜线和行结束符都不算是字符串直接量的内容。如果希望在字符串直接量中另起一行，可以使用转义字符\n（后续会有介绍）：
```javascript

"two\nlines"//这里定义了一个显示为两行的字符串
 //下面用三行代码定义了显示为单行的字符串，只在ECMAScript5中可用
"one\      
long\
line"
```
需要注意的是，当使用单引号来定界字符串时，需要格外小心英文中的缩写和所有格写法，比如can't和O'Reilly's。因为撇号和单引号是同一个字符，所以必须使用反斜杠（\）来转义（转义符将在下一章讲解）所有的撇号。

在客户端JavaScript程序设计中，JavaScript代码会夹杂HTML代码的字符串，HTML代码也会夹杂JavaScript代码。和JavaScript一样，HTML也使用单引号或者双引号来定界字符串，因此，当JavaScript代码和HTML代码混杂在一起的时候，最好在JavaScript和HTML代码中各自使用独立的引号风格。例如，在JavaScript表达式中使用单引号表示字符串“Thank you”，而在HTML事件处理程序属性中则使用双引号表示字符串：

    <button onclick="alert('Thank you')">Click Me</button>

**3.2.2转义字符**

在JavaScript字符串中，反斜杠(\)有着特殊的用途，反斜杠符号后面加一个字符，就不再表示它们的字面含义了，比如，\n就是一个转义字符（escape sequence），它表示的是一个换行符。escape sequence译为“转义序列”，有时也译成“转义字符”和“逃逸符”，本节中统一译为“转义字符”。

另一个例子是上节中提到的转义字符\'，表示单引号（或撇号）。当需要在一个单引号定界的字符串内使用撇号的时候，它就显得非常有用。现在你就会明白我们为什么把它们叫做转义字符了，因为反斜线可以使我们避免使用常规方式解释单引号，当单引号不是用来标记字符串结尾时，它只是一个撇号：
```javascript
'You\'re right, it can\'t be a quote'
```
表格3-1列出了JavaScript中的转义字符以及它们所代表的含义。其中有两个是通用的，通过十六进制数表示Latin-1或Unicode中的任意字码。例如，
\xA9表示版权符号，版权符号的Latin-1编码是十六进制数A9。同样，\u表示由4个十六进制数指定的任意Unicode字符，比如，\u03c0表示字符π。

表3-1 javascript转义字符

|转义字符|含义|
| -------- | ---- |
|\o|NUL字符（\u0000）|
|\b|退格符（\u0008）|
|\t|水平制表符（\u0009）|
|\n|换行符（\u000A）|
|\v|垂直制表符（\u000B）|
|\f|换页符（\u000C）|
|\r|回车符（\u000D）|
|\"|双引号（\u0022）|
|\'|撇号或单引号（\u0027）|
|\\|反斜线（\u005C）|
|\xXX|由两位十六进制数XX指定的Latin-1字符|
|\uXXXX|由4位十六进制数XXXX指定的Unicode字符|

如果”\“字符位于没有在表3-1中列出的字符前，则忽略”\“（当然，JavaScript语言将来的版本可能定义新的转义符）。比如”\#“和”#“等价。最后，上文提到过，在ECMAScript5中，允许在一个多行字符串直接量里的每行结束处使用反斜线。

**3.2.3字符串的使用**

JavaScript的内置功能之一就是字符串连接。如果将加号（+）运算符用于数字，表示两数相加。但将它作用于字符串，则表示字符串连接，将第二个字符串拼接在第一个之后，例如：
```javascript
msg = "Hello, " + "world";//生成字符串"Hello, world"
greeting = "Welcome to my blog," + " " + name;
```
要确定一个字符串长度——其所包含的16位值得个数——可以使用字符串的length属性。比如，要得到字符串s的长度：

    s.length
    
除了length属性，字符串还提供许多可以调用的方法（可以在第三部分查到详细信息）：
```javascript
var s = "hello, world" //定义一个字符串
s.charAt(0)//=>"h" 第一个字符
s.charAt(s.length - 1)//=>"d" 最后一个字符
s.substring(1,4)//=>"ell" 第2~4个字符
s.slice(1,4)//=>"ell" 同上
s.slice(-3)//=>"rld" 最后三个字符
s.indexOf("l")//=>2 字符l首次出现的位置
s.lastIndexOf("l")//=>10 字符l最后一次出现的位置
s.indexOf("l",3)//=>3 在位置3及之后首次出现字符l的位置
s.split(", ")//["hello", "world"]分割成子串
s.replace("h","H")//"Hello, world" 全文字符替换
s.toUpperCase()//"HELLO, WORLD" 
```
记住，在JavaScript中字符串是固定不变的，类似replace()和toUpperCase()的方法都返回新字符串，原字符串本身并没有发生改变。
在ECMAScript5中，字符串可以当做只读数组，除了使用charAt()方法，也可以使用方括号来访问字符串中的单个字符（16位值）：
```javascript
s = "hello, world";
s[0]//=>"h"
s[s.length -1] //=>"d"
```
基于Mozilla的web浏览器（比如Firefox）很久之前就支持这种方式的字符串索引，多数现代浏览器（IE除外）也紧跟Mozilla脚步，在ECMAScript5成型之前就支持了这一特性。

**3.2.4模式匹配**

JavaScript定义了RegExp()构造函数，用来创建表示文本匹配模式的对象。这些模式称为”正则表达式“（regular expression），javascript采用Perl中的正则表达式语法。String和RegExp对象均定义了利用正则表达式进行模式匹配和查找与替换的函数。、

RegExp并不是javascript的基本类型。和Date一样，它只是一种具有实用API的特殊对象。正则表达式的语法很复杂，API也很丰富。在第10章有详尽的文档介绍。RegExp是一种强大和常用的文本处理工具，本节只是一个概述。

尽管RegExp并不是语言中的基本数据类型，但是它们依然具有直接量写法，可以直接在javascript程序中使用。在两条斜线之间的文本构成了一个正则表达式直接量。第二条斜线之后也可以跟随一个或多个字母，用来修饰匹配模式的含义，例如：
```javascript
/^HTML/  //匹配以HTML开始的字符串
/[1-9][0-9]*/ //匹配一个非零数字，后面是任意个数字
/\bjavascript\b/  //匹配单词”javascript“，忽略大小写
```
RegExp对象定义了很多有用的方法，字符串同样具有可以接收RegExp参数的方法，例如：
```javascript
var text = "testing: 1, 2, 3";//文本示例
var pattern = /\d+g/  //匹配所有包含一个或多个数字的实例
pattern.test(text) //=>true 匹配成功
text.search(pattern) //=>9 首次匹配成功的位置
text.match(pattern) //=>["1", "2", "3"] 所有匹配组成的数组
text.replace(pattern, "#");//=> "testing: #, #, #"
text.split(/\D+/);//["","1","2","3"] 用非数字字符截取字符串
```

**3.3布尔值**

布尔值指代真或假、开或关、是或否。这个类型只有两个值，保留字true和false。
javascript程序中的比较语句的结果通常都是布尔值，例如：

    a==4
    
这段代码用来检测变量a的值是否等于4。如果等于，比较结果的布尔值就是true；如果不等，比较结果则为false。
布尔值通常用于javascript中的控制结构中。例如，javascript中的if／else语句，如果布尔值为true执行第一段逻辑，如果为false执行另一段逻辑。通常将一个创建布尔值的比较直接与使用这个比较的语句结合在一起，结果如下所示：

    if (a==4)
    b = b + 1;
    else
    a = a + 1;
    
这段代码检测变量a是否等于4，如果等于，则b加1，否则，a加1。我们同样会在3.8节讨论到，任意javascript的值都可以转换为布尔值。下面这些值会被转换成false：

    undefined
    null
    0
    -0
    NaN
    ""//空字符串
    
所有其他值，包括所有对象（数组）都会转换成true。false和上面6个可以转换成false的值有时称做“假值”（falsy value），其他值称做“真值”（truthy value）。
javascript期望使用一个布尔值的时候，假值会被当成false，真值会被当成true。

来看一个例子，假设变量o是一个对象或是null，可以通过一条if语句来显式地检测o是否是非null值：

    if (o !== null)

不等操作符“!==”将o和null比较，并得出结果为true或false。可以先忽略这里的比较语句，null是一个假值，对象是一个真值：

    if (o)
    
对于第一种情况，只有o不是null时才会执行if后的代码，第二种情况的限制没那么严格，只有o不是false或任何假值（比如null或undefined）时它才会执行这个if。到底选用哪条语句取决于期望赋给o的值是什么。如果需要将null与o或""区分开来，则需要使用一个显式的比较。

布尔值包含toString()方法，因此可以使用这个方法将字符串转换为“true”或“false”，但它并不包含其他有用的方法。除了这个不重要的API，还有三个重要的布尔运算符。

“&&”运算符执行了逻辑与（AND）操作。当且仅当两个操作数都是真值时它才返回true；否则返回false。“||”运算符是布尔或（OR）操作，如果两个操作数其中一个为真值它就返回true，如果两个操作数都是假值则返回false，最后，一元操作符“!”执行了布尔非（NOT）操作，如果操作数是真值则返回false，如果是假值，则返回true。
比如：

    if((x==0&&y==0)||!(z==0)){
        //x和y都是零或z是非零
    }

关于操作数的完整细节可以参照4.10节。
    
**3.4null和undefined**

null是javascript语言的关键字，它表示一个特殊值，常用来描述"空值"。对null执行typeof预算，结果返回字符串"object"，也就是说，可以将null认为是一个特殊的对象值，含义是”非对象“。但实际上，通常认为null是它自由类型的唯一一个成员，它可以表示数字、字符串和对象是”无值“的。大多数编程语言和javascript一样含有null；你可能对null和nil很眼熟。

javascript还有第二个值来表示值的空缺。用未定义的值表示更深层次的"空值"。它是变量的一种取值，表明变量没有初始化，如果要查询对象属性或数组元素的值时返回undefined则说明这个属性或元素不存在。如果函数没有返回任何值，则返回undefined。引用没有提供实参的函数的形参的值也只会得到undefined。undefined是预定义的全局变量（它和null不一样，它不是关键字），它的值就是“未定义”。在ECMAScript3中，undefined是可读/写的变量，可以给它赋予任意值。这个错误在ECMAScript5中做了修正；undefined在该版本中是只读的。如果使用typeof运算符得到undefined的类型，则返回“undefined”，表明这个值是这个类型的唯一成员。

尽管null和undefined是不同的，但它们都表示“值的空缺”，两者往往可以互换。判断相等运算符“==”认为两者是相等的（要使用严格相等运算符“===”来区分它们）。在希望值是布尔类型的地方它们的值都是假值，和false类似。null和undefined都不包含任何属性和方法。实际上，使用“.”和“[]”来存取这两个值的成员和方法都会产生一个类型错误。

你或许认为undefined是表示系统级的、出乎意料的或类似错误的值的空缺，而null是表示程序级的、正常的或在意料之中的值的空缺。如果你想将它们赋值给变量或者属性，或将它们作为参数传入函数，最佳选择是使用null。

**3.5全局对象**

前几节我们讨论了javascript的原始类型和原始值。对象类型——对象、数组和函数——在本书中均会有独立章节来讲述。但有一类非常重要的对象，我们不得不现在就把它们讲清楚——全局对象。
全局对象（global object）在javascript中有着重要的用途：全局对象的属性是全局定义的符号，javascript程序可以直接使用。当javascript解释器启动时（或者任何web浏览器加载新页面的时候），它将创建一个新的全局对象，并给它一组定义的初始属性：

* 全局属性，比如undefined、Infinity和NaN
* 全局函数，比如isNaN()、parseInt()（见3.8.2节）和eval()（见4.12节）
* 构造函数，比如Date()、RegExp()、String()、Object()和Array()（见3.8.2节）
* 全局对象，比如Math和JSON（见6.9节）

全局对象的初始属性并不是保留字，但它们应该当做保留字来对待。2.4.1节列出了所有这些属性。本章对一部分全局属性也有描述。其他属性在其他章节也会讲述。可以在第三部分中通过名称查找到，或者通过别名“Global”来找到这些全局对象。对于客户端javascript来讲，window对象定义了一些额外的全局属性，可以在第四部分中查看它们。

在代码的最顶级——不在任何函数内的javascript代码——可以使用javascript关键字this来引用全局对象：

    var global = this;//定义一个引用全局对象的全局变量

在客户端javascript中，在其表示的浏览器窗口中的所有javascript代码中，window对象充当了全局对象。这个全局window对象有一个属性window引用其自身，它可以代替this来引用全局对象。window对象定义了核心全局属性，但它也针对web浏览器和客户端javascript定义了一少部分其他全局属性。
当初次创建的时候，全局对象定义了javascript中所有的预定义全局值。这个特殊对象同样包含了为程序定义的全局值。如果代码声明了一个全局变量，这个全局变量就是全局对象的一个属性，3.10.2节有关于此的详尽解释。

**3.6包装对象**

javascript对象是一种复合值：它是属性或已命名值的集合。通过“.”符号来引用属性值。当属性值是一个函数的时候，称其为方法。通过o.m()来调用对象o中的方法。

我们看到字符串也同样具有属性和方法：
```javascript
var s = "hello world!";//一个字符串
var word = s.substring(s.indexOf(" ")+1, s.length);//使用字符串的属性
```
字符串既然不是对象，为什么它会有属性呢？只要引用了字符串s的属性。javascript就会将字符串值通过调用new String(s)的方式转换成对象，这个对象继承了字符串的方法（见6.2.2节），并被用来处理属性的引用。一旦属性引用结束，这个新创建的对象就会销毁（其实在实现上并不一定创建或销毁这个临时对象，然而整个过程看起来是这样）。
同字符串一样，数字和布尔值也具有各自的方法：通过NUmber()和Boolean()构造函数创建一个临时对象，这些方法的调用均是来自于这个临时对象。null和undefined没有包装对象：访问它们的属性会造成一个类型错误。

看如下代码，思考它们的执行结果：
```javascript
var s = "test";//创建一个字符串
s.len = 4;//给它设置一个属性
var t = s.len;//查询这个属性
```
当运行这段代码时，t的值是undefined。第二行代码创建一个临时字符串对象，并给其len属性赋值4，随即销毁这个对象。第三行通过原始的（没有修改过）字符串值创建一个新字符串对象，尝试读取其len属性，这个属性自然是不存在的，表达式求值结果为undefined。这段代码说明了在读取字符串、数字和布尔值的属性值（或方法）的时候，表现的像对象一样。但如果你试图给其属性赋值，则会忽略这个操作：修改只是发生在临时对象身上，而这个临时对象并未继续保留下来。

存取字符串、数字或布尔值的属性时创建的临时对象称做包装对象，它只是偶尔用来区分字符串值和字符串对象、数字和数值对象以及布尔值和布尔对象。通常，包装对象只是被看做是一种实现细节，而不用特别关注。由于字符串、数字和布尔值的属性都是只读的，并且不能给它们定义新属性，因此你需要明白它们是有别于对象。
lei
需要注意的是，可通过String()、Number()或Boolean()构造函数来显式创建包装对象：
```javascript
var s = "test",n = 1,b = true;//一个字符串、数字和布尔值
var S = new String(s);//一个字符串对象
var N = new Number(n);//一个数值对象
var B = new Boolean(b);//一个布尔对象
```
javascript会在必要时将将包装对象转换为原始值，因此上段代码中的对象S、N和B常常但不总是表现的和s、n和b一样。“==”等于运算符将原始值和其包装对象视为相等，但“===”全等运算符将它们视为不等。通过typeof运算符可以看到原始值和其包装对象的不同。

**3.7不可变的原始值和可变的对象引用**

javascript中的原始值（undefined、null、布尔值、数字和字符串）与对象（包括数组和函数）有着根本的区别。原始值是不可更改的，任何方法都无法更改（或“突变”）一个原始值。对数字和布尔值来说显然如此——改变数字的值本身就说不通，而对字符串来说就不那么明显了，因为字符串看起来就像是由字符组成的数组，我们期望可以通过指定索引来修改字符串中的字符。实际上，javascript是禁止这样做的。字符串中所有的方法看上去返回了一个修改后的字符串，实际上返回的是一个新的字符串值。例如：
```javascript
var s = "hello";//定义一个由小写字母组成的文本
s.toUpperCase();//返回“HELLO”，但并没有改变s的值
s               //=> hello，原始字符串的值并未改变
```
原始值的比较是值的比较：只有在它们的值相等时它们才相等。这对数字、布尔值、null和undefined来说听起来有点难懂，并没有其他办法来比较它们。同样，对于字符串来说则并不明显：如果比较两个单独的字符串，当且仅当它们的长度相等且每个索引的字符都相等时，javascript才认为它们相等。

对象和原始值不同，首先，它们是可变的——它们的值是可修改的：
```javascript
var o = {x:1};//定义一个对象
o.x = 2;//通过修改对象属性值来更改对象
o.y = 3;//再次更改这个对象，给它增加一个新属性
var a = [1,2,3]//数组也是可修改的
a[0] = 0;//更改数组的一个元素
a[3] = 4;//给数组增加一个新元素
```
对象的比较并非值的比较，即使两个对象包含同样的属性及相同的值，它们也是不相等的。各个索引元素完全相等的两个数组也不相等。
```javascript
var o = {x:1},p = {x:1}//具有相同属性的两个对象
o===p//=>false 两个单独的对象永不相等
var a = [],b = [];//两个单独的空数组
a===b//=>false 两个单独的数组永不相等
```
我们通常将对象称为引用类型（reference type），以此来和javascript的基本类型区分开来。依照术语的叫法，对象值都是引用（reference）。对象的比较均是引用的比较，当且仅当它们引用同一个基对象时，它们才相等。
```javascript
var a = [];//定义一个引用空数组的变量s
var b = a;//变量b引用同一个数组
b[0] = 1;//通过变量b来修改引用的数组
a[0]//=>1 变量a也会修改
a===b//=>true a和b引用同一个数组，因此它们相等
```
就像你们看到的如上代码，将对象（或数组）赋值给一个变量，仅仅是赋值的引用值，对象本身并没有复制一次，如果你想得到一个对象或数组的副本，则必须显式复制对象的每个属性或数组的每个元素。下面这个例子则是通过循环来完成数组复制（见5.5.3节）。
```javascript
var a = ['a','b','c'];//待复制的数组
var b = [];//复制到的目标空数组
for(var i=0; i<a.length; i++){//遍历a[]中的每个元素
    b[i] = a[i];//将元素值复制到b中
}
```
同样的，如果我们想比较两个单独的对象或者数组，则必须比较它们的属性或元素。下面这段代码定义了一个比较两个数组的函数；
```javascript
function equalArrays(a,b){
    if(a.length != b.length) return false;//两个长度不同的数组不相等
    for(var i=0; i<a.length; i++){//循环遍历所有元素
        if (a[i] !== b[i]) return false;//如果有任意元素不等，则数组不相等
        return true;//否则它们相等
    }
}
```
**3.8类型转换**

javascript中的取值类型非常灵活，我们已经从布尔值看到了这一点：当javascript期望使用一个布尔值的时候，你可以提供任意类型值，javascript将根据需要自行转换类型。一些值（真值）转换为true，其他值（假值）转换为false。这在其他类型中同样适用：如果javascript期望使用一个字符串，它把给定的值将转换为字符串。如果javascript期望使用一个数字，它把给定的值将转换为数字（如果转换结果无意义的话将返回NaN），一些例子如下：
```javascript
10 + " objects"//=>"10 objects"，数字10转换成字符串
"7" * "4" //=> 28 两个字符串均转换为数字
var n = 1 - "x";//=>NaN 字符“x”无法转换为数字
n + " objects"//“NaN objects” NaN转换为字符串“NaN”
```
表3-2简要说明了在javascript中如何进行类型转换。

表3-2：javascript类型转换

|原始值|字符串|数字|布尔值|对象|
|:-----:|:--------:|:-------:|:-----:|:------:|
|undefined|"undefined"|NaN|false|throws TypeError|
|null|"null"|0|false|throws TypeError|
|true|"true"|1|true|new Boolean(true)|
|false|"false"|0|false|new Boolean(false)|
|""(空字符串)|"" |0|false|new String("")|
|"1.2"(非空，数字)|"1.2" |1.2|true|new String("1.2")|
|"one"(非空，非数字)|"one" |NaN|true|new String("one")|
|0|"0" |0|false|new Number(0)|
|-0|"0" |-0|false|new Number(-0)|
|NaN|"NaN"|NaN|false|new Number(NaN)|
|Infinity|"Infinity"|Infinity|true|new Number(Infinity)|
|-Infinity|"-Infinity"|Infinity|true|new Number(-Infinity)|
|1（无穷大，非零）|"1"|1|true|new Number(1)|
|{}（任意对象）|参考3.8.3节|参考3.8.3节|true|{}|
|[]（任意数组）|""|0|true|[]|
|[9]（1个数字元素）|"9"|9|true|[9]|
|['a']（其他数组）|使用join()方法|NaN|true|['a']|
|function(){}（任意函数）|参考3.8.3节|NaN|true|function(){}|

表3-2节中提到的原始值到原始值的转换相对简单，我们已经在3.3节讨论过转换为布尔值的情况了。
所有原始值转换为字符串的情形也已经明确定义。转换为数字的情形比较微妙。那些以数字表示的字符串可以直接转换为数字，也允许在开始和结尾处带有空格。但在开始和结尾处的任意非空格字符都不会被当成数字直接量的一部分，进而造成字符串转换为数字的结果为NaN。有一些数字转换看起来让人奇怪：true转换为1，false、空字符串和""转换为0。

原始值到对象的转换也非常简单，原始值通过调用String()、Number()或Boolean()构造函数，转换为它们各自的包装对象（见3.6节）。

null和undefined属于例外，当将它们用在期望是一个对象的地方都会造成一个类型错误（TypeError）异常，而不会执行正常的转换。

对象到原始值的转换多少有些复杂，3.8.3节将以此为专题专门讲述。

**3.8.1转换和相等性**

由于javascript可以做灵活的类型转换，因此其“==”相等运算符也随相等的含义灵活多变。例如，如下这些比较结果均是true：
```javascript
null == undefined//这两值被认为相等
"0" == 0//在比较之前字符串转换为数字
0 == false//在比较之前布尔值转换为数字
"0" == false//在比较之前字符串和布尔值都转换为数字
```
4.9.1节详细讲解了“==”等于运算符在判断两个值是否相等时做了哪些类型转换，并同样介绍了“===”恒等运算符在判断相等时未做任何类型转换。

需要特别注意的是，一个值转换为另一个值并不意味着两个值相等。比如，如果在期望使用布尔值的地方使用了undefined，它将会转换为false，但这并不表明undefined == false。javascript运算符和语句期望使用多样化的数据类型，并可以相互转换。if语句将undefined转换为false，但“==”运算符从不试图将其操作数转换为布尔值。

**3.8.2显式类型转换**

尽管javascript可以自动做许多类型转换，但有时仍需要做显式转换，或者为了代码变得清晰易读而做显式转换。

做显式类型转换最简单的方法就是使用Boolean()、Number()、String()或Object()函数。
我们在3.6节已经介绍过了。当不通过new运算符调用这些函数时，它们会作为类型转换函数并按照表3-2所描述的规则做类型转换：
```javascript
Number("3")//=>3
String(false)//=>"false"或使用false.toString()
Boolean([])//=>true
Object(3)//=> new Number(3)
```
需要注意的是，除了null或undefined之外的任何值都具有toString()方法，这个方法的执行结果通常和String()方法的返回结果一致。
同样需要注意的是，如果试图把null或undefined转换为对象，则会像表3-2所描述的那样抛出一个类型错误（TypeError）。
Object()函数在这种情况下不会抛出异常：它仅简单地返回一个新创建的空对象。

javascript中的某些运算符会做隐式的类型转换，有时用于类型转换。如果“+”运算符的一个操作数是字符串，它将会把另外一个操作数转换为字符串。一元“+”运算符将其操作数转换为数字。同样，一元“!”运算符将其操作数转换为布尔值并取反。在代码中会经常见到这种类型转换的惯用法：
```javascript
x + "" //等价于String(x)
+x //等价于Number(x) 也可以写成x-0
!!x //等价于Boolean(x)，注意是双叹号
```
在计算机程序中数字的解析和格式化是非常普通的工作，javascript中提供了专门的函数和方法用来做更加精确的数字到字符串（number-to-string）和字符串到数字（string-to-number）的转换。

Number类定义的toString()方法可以接收表示转换基数（radix）的可选参数，如果不指定此参数，转换规则将是基于十进制的。同样，亦可以将数字转换为其他进制数（范围在2~36之间），例如：
```javascript
var n = 17;
binary_string = n.toString(2);//转换为“10001”
octal_string = "0" + n.toString(8);//转换为“021”
hex_string = "0x" + n.toString(16);//转换为“0x11”
```
当处理财务或科学数据的时候，在做数字到字符串的转换过程中，你期望自己控制输出中小数点位置和有效数字位数，或者决定是否需要指数记数法。Number类为这种数字到字符串的类型转换场景定义了三个方法。toExponential()使用指数记数法将数字转换为指数形式的字符串，其中小数点前只有一位，小数点后的位数则由参数指定（也就是说有效数字位数比指定的位数要多一位），toPrecision()根据指定的有效数字位数将数字转换为字符串。如果有效数字的位数少于数字整数部分的位数，则转换成指数形式。我们注意到，所有三个方法都会适当地进行四舍五入或填充0。看一下下面几个例子：
```javascript
var n = 123456.789;
n.toFixed(0);//"123457"
n.toFixed(2);//"123456.79"
n.toFixed(5);//"123456.78900"
n.toExponential(1);//"1.2e+5"
n.toExponential(3);//"1.235e+5"
n.toPrecision(4);//"1.235e+5"
n.toPrecision(7);//"123456.8"
n.toPrecision(10);//"123456.7890"
```
如果通过Number()转换函数传入一个字符串，它会试图将其转换为一个整数或浮点数直接量，这个方法只能基于十进制数进行转换，并且不能出现非法的尾随字符。parseInt()函数和parseFloat()函数（它们是全局函数，不从属于任何类的方法）更加灵活。parseInt()只解析整数，而parseFloat()则可以解析整数和浮点数。如果字符串前缀是“0x”或者“0X”，parseInt()将其解释为十六进制数，parseInt()和parseFloat()都会跳过任意数量的前导空格，尽可能解析更多数值字符，并忽略后面的内容。如果第一个非空格字符是非法的数字直接量，将最终返回NaN：
```javascript
parseInt("3 blind mice")//=>3
parseFloat(" 3.14 meters");//=>3.14
parseInt("-12.34");//=>-12
parseInt("0xFF");//=>255
parseInt("0xff");//=>255
parseInt("-0xFF");//=>-255
parseFloat(".1");//=>0.1
parseInt("0.1");//=>0
parseInt(".1");//=>NaN 整数不能以“.”开始
parseInt("$72.47");//=>NaN 数字不能以“$”开始
```
parseInt()可以接收第二个可选参数，这个参数指定数字转换的基数，合法的取值范围是2~36，例如：
```javascript
parseInt("11",2);//=>3 (1*2+1)
parseInt("ff",16);//=>255 (15*16 + 15)
parseInt("zz",36);//=>1295 (35*36 + 35)
parseInt("077",8);//=>63 (7*8 + 7)
parseInt("077",10);//=>63 (7*10 + 7)
```

**3.8.3对象转换为原始值**
对象到布尔值的转换非常简单：所有的对象（包括数组和函数）都转换为true。对于包装对象亦是如此：new Boolean(false)是一个对象而不是原始值，它将转换为true。

对象到字符串（object-to-string）和对象到数字（object-to-number）的转换是通过调用待转换对象的一个方法来完成的。一个麻烦的事实是，javascript对象有两个不同的方法来执行转换，并且接下来要讨论的一些特殊场景更加复杂。值得注意的是，这里提到的字符串和数字的转换规则只适用于本地对象（native object）。宿主对象（例如，由web浏览器定义的对象）根据各自的算法可以转换成字符串和数字。

所有的对象继承了两个转换方法。第一个是toString(),它的作用是返回一个反映这个对象的字符串。默认的toString()方法并不会返回一个有趣的值（在例6-4中我们会发现它非常有用）：

    ({x:1, y:2}).toString() // => "[object object]"

很多类定义了更多特定版本的toString()方法。例如，数组类(Array class)的toString()方法将每个数组元素转换为一个字符串，并在元素之间添加逗号后合并成结果字符串。
函数类（functtion class）的toString()方法返回这个函数的实现定义的表示方式。实际上，这里的实现方式是通常是将用户定义的函数转换为javascript源代码字符串。日期类（Date class）定义的toString()方法返回了一个可读的（可被javascript解析的，这里的原文是javascript-parsable，意指可以通过javascript的方法过滤并再做封装）日期和时间字符串。
RegExp类（RegExp class）定义的toString()方法将RegExp对象转换为表示正则表达式直接量的字符串：
```javascript
[1,2,3].toString() //=>"1,2,3"
(function(x){f(x);}).toString()//=>"function(x){\n f(x); \n}"
/\d+/g.toString() // => "/\\d+/g"
new Date(2010,0,1).toString()//=> "Fri Jan 01 2010 00:00:00 GMT-0800(PST)"
```
另一个转换对象的函数是valueOf()。这个方法的任务并未详细定义：如果存在任意原始值，它就默认将对象转换为表示它的原始值。对象是复合值，而且大多数对象无法真正表示为一个原始值，因此默认的valueOf()方法简单地返回对象本身，而不是返回一个原始值。数组、函数和正则表达式简单地继承了这个默认方法，调用这些类型的实例的valueOf()方法只是简单返回对象本身。日期类定义的valueOf()方法会返回它的一个内部表示：1970年1月1日依来的毫秒数。
```javascript
var d = new Date(2010,0,1);//2010年1月1日（太平洋时间）
d.valueOf() //=> 1262332800000
```
通过使用我们刚刚讲解过的toString()和valueOf()方法，就可以做到对象到字符串和对象到数字的转换了。但需要注意的是，在某些特殊的场景中，javascript执行了完全不同的对象到原始值的转换。这些特殊场景在本节的最后会讲到。
javascript中对象到字符串的转换经过了如下这些步骤：

* 如果对象具有toString()方法，则调用这个方法。如果它返回一个原始值，javascript将这个值转换为字符串（如果本身不是字符串的话），并返回这个字符串结果。需要注意的是，原始值到字符串的转换在表3-2中已经有了详尽的说明。
* 如果对象没有toString()方法，或者这个方法并不返回一个原始值，那么javascript会调用valueOf()方法。如果存在这个方法，则javascript调用它。如果返回值是原始值，javascript将这个值转换为字符串（如果本身不是字符串的话），并返回这个字符串结果。
* 否则，javascript无法从toString()或valueOf()获得一个原始值，因此这时它将抛出一个类型错误异常。

在对象到数字的转换过程中，javascript做了同样的事情，只是它会首先尝试使用valueOf()方法：

* 如果对象具有valueOf()方法，后者返回一个原始值，则javascript将这个原始值转换为数字（如果需要的话）并返回这个数字。
* 否则，如果对象具有toString()方法，后者返回一个原始值，则javascript将其转换并返回。
* 否则，javascript抛出一个类型错误异常。

对象转换为数字的细节解释了为什么空数组会被转换为数字0以及为什么具有单个元素的数组同样会转换成一个数字。数组继承了默认的valueOf()方法，这个方法返回一个对象而不是一个原始值，因此，数组到数字的转换则调用toString()方法。空数组转换为空字符串，空字符串转换成为数字0。含有一个元素的数组转换为字符串的结果和这个元素转换字符串的结果一样。如果数组只包含一个数字元素，这个数字转换为字符串，再转换回数字。

javascript中的“+”运算符可以进行数学加法和字符串连接操作。如果它的其中一个操作数是对象，则javascript将使用特殊的方法将对象转换为原始值，而不是使用其他算术运算符的方法执行对象到数字的转换，“==”相等运算符与此类似。如果将对象和一个原始值比较，则转换将会遵照对象到原始值的转换方式进行。

“+”和“==”应用的对象到原始值的转换包含日期对象的一种特殊情形。日期类是javascript语言核心中唯一的预先定义类型，它定义了有意义的向字符串和数字类型的转换。对于所有非日期的对象来说，对象到原始值的转换基本上是对象到数字的转换（首先调用valueOF()），日期对象则使用对象到字符串的转换模式，然而，这里的转换和上文讲述的并不完全一致：通过valueOf或toString()返回的原始值将被直接使用，而不会被强制转换为数字或字符串。

和“==”一样，“<”运算符以及其他关系运算符也会做对象到原始值的转换，但要除去日期对象的特殊情形：任何对象都会首先尝试调用valueOf()，然后调用toString()。不管得到的原始值是否直接使用，它都不会进一步被转换为数字或字符串。

“+”、“==”、“!=”和关系运算符是唯一执行这种特殊的字符串到原始值的转换方式的运算符。其他运算符到特定类型的转换都很明确，而且对日期对象来讲也没有特殊情况。例如“-”减号运算符把它的两个操作数都转换为数字。下面的代码展示了日期对象和“+”、“-”、“==”以及“>”的运行结果：
```javascript
var now = new Date();//创建一个日期对象
typeof (now + 1)//=>"string"  "+"将日期转换为字符串
typeof (now - 1)//=> "number" "-"使用对象到数字的转换
now == now.toString() //=>true 隐式的和显式的字符串转换
now > (now - 1)//=>true ">"将日期转换为数字
```
**3.9变量声明**

在javascript程序中，使用一个变量之前应当先声明。变量是使用关键字var来声明的，如下所示：
```javascript
var i;
var sum;
```
也可以通过一个var关键字来声明多个变量：
```javascript
var i,sum;
```
而且还可以将变量的初始赋值和变量声明合写在一起：
```javascript
var message = "hello";
var i = 0, j = 0, k = 0;
```

我们未在var声明语句中给变量指定初始值，那么虽然声明了这个变量，但在给它存入一个值之前，它的初始值就是undefined。

我们注意到，在for和for/in循环（在第5章会讲到）中同样可以使用var语句，这样可以更简洁地声明在循环体语法内中使用的循环变量。例如：
```javascript
for(var i = 0; i < 10; i++) console.log(i);
for(var i = 0, j = 10; i<10; i++,j--) console.log(i*j);
for(var p in o) console.log(p);
```
如果你之前编写过诸如c或java的静态语言，你会注意到在javascript的变量声明中并没有指定变量的数据类型。javascript变量可以是任意数据类型。例如，在javascript中首先将数字赋值给一个变量，随后再将字符串赋值给这个变量，这是完全合法的：
```javascript
var i = 10;
i = "ten";
```
重复的声明和遗漏的声明：
使用var语句重复声明变量是合法且无害的。如果重复声明带有初始化器，那么这就和一条简单的赋值语句没什么两样。
如果你试图读取一个没有声明的变量的值，javascript会报错。在ECMAScript5严格模式（见5.7.3节）中，给一个没有声明的变量赋值也会报错。然而从历史上讲，在非严格模式下，如果给一个未声明的变量赋值，javascript实际上会给全局对象创建一个同名属性，并且它工作起来像（但并不完全一样，查看3.10.2节）一个正确声明的全局变量。这意味着你可以侥幸不声明全局变量。但这是一个不好的习惯并会造成很多bug，因此，你应当始终使用var来声明变量。

**3.10变量作用域**

一个变量的作用域（scope）是程序源代码中定义这个变量的区域。全局变量拥有全局作用域，在javascript代码中的任何地方都是有定义的。
然而在函数内声明的变量只在函数体内有定义。它们是局部变量，作用域是局部性的。函数参数也是局部变量，它们只在函数体内有定义。
在函数体内，局部变量的优先级高于同名的全局变量。如果在函数内声明的一个局部变量或者函数参数中带有的变量和全局变量重名，那么全局变量就被局部变量所遮盖。

```javascript
var scope = "global";   //声明一个全局变量
function checkscope() {
    var scope = "local";//声明一个同名的局部变量
    return scope;       //返回局部变量的值，而不是全局变量的值
}
checkscope();           //=>"local"
```
尽管在全局作用域编写代码时可以不写var语句，但声明局部变量时则必须使用var语句。思考一下如果不这样做会怎样：

```javascript
scope = "global";           //声明一个全局变量，甚至不用var来声明
function checkscope2() {    
    scope = "local";        //糟糕！我们刚刚修改了全局变量
    myscope = "local";      //这里显式地声明了一个新的全局变量
    return [scope,myscope]; //返回两个值
}
checkscope2();//=>["local","local"]，产生了副作用
scope//=>"local"，全局变量修改了
myscope//=>"local"，全局命名空间搞乱了
```
函数定义是可以嵌套的。由于每个函数都有它自己的作用域，因此会出现几个局部作用域嵌套的情况，例如：

```javascript
var scope = "global scope";//全局变量
    function checkscope() {
        var scope = "local scope";//局部变量
        function nested() {
            var scope = "nested scope";//nested(嵌套)，嵌套作用域内的局部变量
            return scope;//返回当前作用域内的值
        }
        return nested();
    }
checkscope(); //"nested scope"，嵌套作用域
```

**3.10.1函数作用域和声明前提**

在一些类似c语言的编程语言中，花括号内的每一段代码都具有各自的作用域，而且变量在声明它们的代码段之外是不可见的，我们称为块级作用域（block scope），而javascript中没有块级作用域。
javascript取而代之地使用了函数作用域（function scope），变量在声明它们的函数体以及这个函数体嵌套的任意函数体内都是有定义的。

在如下所示的代码中，在不同位置定义了变量i、j和k，它们都在同一个作用域内——这三个变量在函数体内均是有定义的。

```javascript
function test(o){
    var i = 0;                      //i在整个函数体内均是有定义的
    if(typeof o == "object") {
        var j = 0;                  //j在函数体内是有定义的，不仅仅是在这个代码段内
        for (var k=0; k < 10; k++){ //k在函数体内是有定义的，不仅仅是在循环里
            console.log(k);         //输出数字0～9
        }
        console.log(k);             //k已经定义了，输出10
    }           
    console.log(j);                 //j已经定义了，但可能没有初始化
}
```
javascript的函数作用域是指在函数内声明的所有变量在函数体内始终是可见的。有意思的是，这意味着变量在声明之前甚至已经可用。javascript的这个特性被非正式地称为声明前提（hoisting），即javascript函数里声明的所有变量（但不涉及赋值）都被提前至函数体的顶部，看一下如下代码：

```javascript
var scope = "global";
function f() {
    console.log(scope);//输出"undefined"，而不是"global"
    var scope = "local";//变量在这里赋初始值，但变量本身在函数体内任何地方均是有定义的
    console.log(scope);//输出"local"
}
```
你可能会误以为函数中的第一行会输出“global”，因为代码还没有执行到var语句声明局部变量的地方。其实不然，由于函数作用域的特性，局部变量在整个函数体始终是有定义的，也就是说，在函数体内局部变量遮盖了同名全局变量。尽管如此，只有在程序执行到var语句的时候，局部变量才会被真正赋值。因此，上述过程等价于：将函数内的变量声明“提前”至函数体顶部，同时变量初始化留在原来的位置：

```javascript
function f() {
    var scope;//在函数顶部声明了局部变量
    console.log(scope);//变量存在，但其值是"undefined"
    scope = "local";//这里将其初始化并赋值
    console.log(scope);//这里它具有了我们所期望的值
}
```
在具有块级作用域的编程语言中，在狭小的作用域里让变量声明和使用变量的代码尽可能靠近彼此，通常来讲，这是一个非常不错的编程习惯。由于javascript没有块级作用域，因此一些程序员特意将变量声明放在函数体顶部，而不是将声明靠近在使用变量之处。这种做法使得他们的源代码非常清晰地反映了真实的变量作用域。

“声明提前”这步操作是在javascript引擎的“预编译”时进行的，是在代码开始运行之前，更多细节请阅读相关ppt：www.slideshare.net/lijing00333/javascript-engine。

**3.10.2作为属性的变量**

当声明一个javascript全局变量时，实际上是定义了全局对象的一个属性（3.5节）。当使用var声明一个变量时，创建的这个属性是不可配置的（见6.7节），也就是说这个变量无法通过delete运算符删除。可能你已经注意到了，如果你没有使用严格模式并给一个未声明的变量赋值的话，javascript会自动创建一个全局变量。以这种方式创建的变量是全局对象的正常的可配值属性，并可以删除它们。

```javascript
var truevar = 1;//声明一个不可删除的全局变量
fakevar = 2;//创建全局对象的一个可删除的属性
this.fakevar2 = 3;//同上
delete truevar //=>false 变量并没有被删除
delete fakevar //=>true 变量被删除
delete this.fakevar2 //=>true 变量被删除
```

javascript全局变量是全局对象的属性，这是在ECMAScript规范中强制规定的。对于局部变量则没有如此规定，但我们可以想象得到，局部变量当做跟函数调用相关的某个对象的属性。ECMAScript3规范称该对象为“调用对象”（call object），ECMAScript5规范称“声明上下文对象”（declarative environment record）。javascript可以允许使用this关键字来引用全局对象，却没有方法可以引用局部变量中存放的对象。这种存放局部变量的对象的特有性质，是一种对我们不可见的内部实现。然而，这些局部变量对象存在的观念是非常重要的。我们会在下一节展开讲述。

**3.10.3作用域链**
javascript是基于词法作用域的语言：通过阅读包含变量定义在内的数行源码就能知道变量的作用域。全局变量在程序中始终都是有定义的。局部变量在声明它的函数体内以及其所嵌套的函数内始终是有定义的。

如果将一个局部变量看做是自定义实现的对象的属性的话，那么可以换个角度来解读变量作用域。每一段javascript代码（全局代码或函数）都有一个与之关联的作用域链（scope chain）。
这个作用域链是一个对象列表或者链表，这组对象定义了这段代码“作用域中”的变量。当javascript需要查找变量x的值的时候（这个过程称做“变量解析”（variable resolution）），它会从链中的第一个对象开始查找，如果这个对象有一个名为x的属性，则会直接使用这个属性的值，如果第一个对象中不存在名为x的属性，javascript会继续查找链上的下一个对象。如果第二个对象依然没有名为x的属性，则会继续查找下一个对象，以此类推。如果作用域链上没有任何一个对象含有属性x，那么就认为这段代码的作用域链上不存在x，并最终抛出一个引用错误（ReferenceError）异常。

在javascript的最顶层代码中（也就是不包含在任何函数定义内的代码），作用域链由一个全局对象组成。在不包含嵌套的函数体内，作用链上有两个对象，第一个是定义函数参数和局部变量的对象，第二个是全局对象。在一个嵌套的函数体内，作用域链上至少有三个对象。理解对象链的创建规则是非常重要的。当定义一个函数时，它实际上保存一个作用域链。当调用这个函数时，它创建一个新的对象来存储它的局部变量，并将这个对象添加至保存的那个作用域链上，同时创建一个新的更长的表示函数调用作用域的“链”。对于嵌套函数来讲，事情变得更加有趣，每次调用外部函数时，内部函数又会重新定义一遍。因为每次调用外部函数的时候，作用域链都是不同的。内部函数在每次定义的时候都有微妙的差别——在每次调用外部函数时，内部函数的代码都是相同的，而且关联这段代码的作用域链也不相同。

作用域链的概念对于理解with语句（见5.7.1节）是非常有帮助的，同样对理解闭包（见8.6节）的概念也至关重要。


表达式和运算符
--------------

表达式（expression）javascript中的一个短语，javascript解释器会将其计算（evaluate）出一个结果。程序中的常量是最简单的一类表达式。变量名也是一种简单的表达式，它的值就是赋值给变量的值。复杂表达式是由简单表达式组成的。比如，数组访问表达式是由一个表示数组的表达式、左方括号、一个整数表达式和右方括号构成。它们所组成的新的表达式的运算结果是该数组的特定位置的元素值。同样的，函数调用表达式由一个表示函数对象的表达式和0个或多个参数表达式构成。

将简单表达式组合成复杂表达式最常用的方法就是使用运算符（operator）。运算符按照特定的运算规则对操作数（通常是两个）进行运算，并计算出新值。乘法运算符“*”是比较简单的例子。表达式x＊y是对两个变量表达式x和进行运算并得出结果。有时我们更愿意说运算符返回一个值而不是“计算”出一个值。

本章将讲解所有的javascript运算符，同时也讲解不涉及运算符的表达式（比如访问数组元素和函数调用）。如果你熟悉C语法风格的其他编程语言，你会发现大多数javascript表达式和运算符都似曾相识。

**4.1原始表达式**

最简单的表达式是“原始表达式”（primary expression）。
原始表达式是表达式的最小单位——它们不再包含其他表达式。javascript中的原始表达式包含常量或直接量、关键字和变量。
直接量是直接在程序中出现的常数值。它们看起来像：

    1.23       //数字直接量
    "hello"    //字符串直接量
    /pattern/  //正则表达式直接量

javascript数字直接量的语法在3.1节已经做了讲解。字符串直接量在3.2节做了讲解。正则表达式直接量语法在3.2.4节做了简单介绍，在第10章将做专门讲解。
javascript中的一些保留字构成了原始表达式：

    true//返回一个布尔值，真
    false//返回一个布尔值，假
    null//返回一个值，空
    this//返回“当前”对象

我们在3.3节和3.4节中学习了true、false和null。和其他关键字不同，this并不是一个常量，它在程序的不同地方返回的值也不相同。this关键字经常在面向对象编程中出现。在一个方法体内，this返回调用这个方法的对象。参照4.5节、第8章（8.2.2节）和第9章来获取关于this的详细信息。

最后，第三种原始表达式是变量：

    i//返回变量i的值
    sum//返回sum的值
    undefined//undefined是全局变量，和null不同，它不是一个关键字
    
当javascript代码中出现标志符，javascript会将其当做变量而去查找它的值。如果变量名不存在，表达式运算结果为undefined。然而，在ECMAScript5的严格模式中，对不存在的变量进行求值会抛出一个引用错误异常。    

**4.2对象和数组的初始化表达式**
**4.3函数定义表达式**
**4.4属性访问表达式**
**4.5调用表达式**
**4.6对象创建表达式**
对象创建表达式（object creation expression）创建一个对象并调用一个函数（这个函数称为构造函数）初始化新对象的属性。对象创建表达式和函数调用表达式非常类似，只是对象创建表达式之前多了一个关键字new：
```javascript
new Object()
new Point(2,3)
```
如果一个对象创建表达式不需要传入任何参数给构造函数的话，那么这对空圆括号是可以省略掉的：
```javascript
new Object
new Date
```
当计算一个对象创建表达式的值时，和对象初始化表达式通过{}创建对象的做法一样，javascript首先创建一个新的空对象，然后，javascript通过传入指定的参数并将这个新对象当做this的值来调用一个指定的函数。这个函数可以使用this来初始化这个新创建对象的属性。那些被当做构造函数的函数不会返回一个值，并且这个新创建并被初始化后的对象就是整个对象创建表达式的值。如果一个构造函数确实返回了一个对象值，那么这个对象就作为整个对象创建表达式的值，而新创建的对象就废弃了。

**4.7运算符概述**
**4.8算术表达式**
**4.9关系表达式**

本节介绍javascript的关系运算符。关系运算符用于测试两个值之间的关系（比如“相等”，“小于”，或“是……的属性”），根据关系是否存在返回true或false。关系表达式总是返回一个布尔值，通常if、while或者for语句（参照第5章）中使用关系表达式，用以控制程序的执行流程。接下来的几节将会讲述相等和不等运算符、比较运算符和javascript中其他两个关系运算符in和instanceof。

**4.9.1相等和不等运算符**

“==”和“===”运算符用于比较两个值是否相等，当然它们对相等的定义不尽相同。两个运算符允许任意类型的操作数，如果操作数相等则放回true，否则返回false。“===”也称为严格相等运算符（strict equality）（有时也称做恒等运算符（identity operator）），它用来检测两个操作数是否严格相等。“==”运算符称做相等运算符（equality operator），它用来检测两个操作数是否相等，这里“相等”的定义非常宽松，可以允许进行类型转换。

javascript支持“=”、“==”和“===”运算符。你应当理解这些（赋值、相等、恒等）运算符之间的区别，并在编码过程中小心使用，尽管它们都可以称做“相等”，但为了减少概念混淆，应该把“=”称做“得到或赋值”，把“==”称做“相等”，把“===”称做严格相等。

“!=”和“!==”运算符的检测规则是“==”和“===”运算符的求反。如果两个值通过“==”的比较结果为true，那么通过“!=”的比较结果则为false。如果两值通过“===”的比较结果为true，那么通过“!==”的比较结果则为false。4.10节会提到，“!”运算符是布尔非运算符。我们只要记住“!=”称做“不相等”、“!===”称做“不严格相等”就可以了。

**4.9.2比较运算符**
**4.9.3in运算符**

in运算符希望它的左操作数是一个字符串或可以转换为字符串，希望它的右操作数是一个对象。如果右侧的对象拥有一个名为左操作数值的属性名，那么表达式返回true，例如：
```javascript
var point = {x:1,y:1};//定义一个对象
"x" in point;//=>true 对象有一个名为“x”的属性
"z" in point;//=>false 对象中不存在名为“z”的属性
"toString" in point;//=>true 对像继承了toString()方法

var data = [7,8,9];//拥有三个元素的数组
"0" in data;//=>true 数组包含元素“0”
1 in data;//=>true 数字转换为字符串
3 in data;//=>false 没有索引为3的元素
```

**4.9.4instanceof运算符**

instanceof运算符希望左操作数是一个对象，右操作数标识对象的类。如果左侧对象是右侧的类的实例，则表达式返回true；否则返回false。第9章将会讲到，javascript中对象的类是通过初始化它们的构造函数来定义的。这样的话，instanceof的右操作数应当是一个函数。比如：
```javascript
var d = new Date();//通过Date()构造函数来创建一个新对象
d instanceof Date();//计算结果为true，d是由Date()创建的
d instanceof Object();//计算结果为true，所有对象都是Object的实例
d instanceof Number();//计算结果为false，d不是一个Number对象
var a = [1,2,3];//通过数组直接量的方法创建一个数组
a instanceof Array;//计算结果为true，a是一个数组
a instanceof Object;//计算结果为true，所有的数组都是对象
a instanceof RegExp;//计算结果为false，数组不是正则表达式
```
需要注意的是，所有的对象都是Object的实例。当通过instanceof判断一个对象是否是一个类的实例的时候，这个判断也会包含对“父类”(superclass)的检测。如果instanceof的左操作数不是对象的话，instanceof返回false。如果右操作数不是函数，则抛出一个类型错误异常。

为了理解instanceof运算符是如何工作的，必须首先理解“原型链”（prototype chain）。
原型链作为javascript的继承机制，将在6.2.2节详细描述。为了计算表达式o instanceof f，javascript首先计算f.prototype，然后在原型链中查找o，如果找到，那么o是f（或者f的父类）的一个实例，表达式返回true。如果f.prototype不在o的原型链中的话，那么o就不是f的实例，instanceof返回false。
对象o中存在一个隐藏的成员，这个成员指向其父类的原型，如果父类的原型是另外一个类的实例的话，则这个原型对象中也存在一个隐藏成员指向另一个类的原型，这种链条将许多对象或类串接起来，既是原型链。原文所讲f.prototype不在o的原型链中也就是说f和o没有派生关系，更多细节请参照6.2.2节。


**4.10逻辑表达式**

逻辑运算符“&&”、“||”和“!”是对操作数进行布尔算术运算，经常和关系运算符一起配合使用，逻辑运算符将多个关系表达式组合起来组成一个更复杂的表达式。这些运算符在下面几节中会一一讲述，为了更好地理解它们，应当首先回顾一下3.3节提到的“真值”和“假值”的概念。

**4.11赋值表达式**
**4.12表达式计算**

和其他很多解释性语言一样，javascript同样可以解释运行由javascript源代码组成的字符串，并产生一个值。javascript通过全局函数eval()来完成这个工作：

    eval("3+2")//=>5

动态判断源代码中的字符串是一种强大的语言特性，几乎没有必要在实际中应用。如果你使用来eval(),你应当仔细考虑是否真的需要使用它。
**4.13其他运算符**
javascript支持很多其他各种各样的运算符，后续几节详细讨论它们。
**4.13.1条件运算符(?:)**
**4.13.2typeof运算符**
**4.13.3delete运算符**

delete是一元操作符，它用来删除对象属性或者数组元素，就像赋值、递增、递减运算符一样，delete也具有副作用的，它是用来做删除操作的，不是用来返回一个值的，例如：
```javascript
var o = {x:1,y:2};//定义一个对象
delete o.x;//删除一个属性
"x" in o;  //=>false 这个属性在对象中不再存在
var a = [1,2,3];//定义一个数组
delete a[2];//删除最后一个数组元素
2 in a;//=>false 元素2在数组中已经不存在了
a.length;//=>3 注意，数组长度并没有改变，尽管上一行代码删除了这个元素，但删除操作留下了一个“洞”，实际上并没有修改数组的长度，因此a数组的长度仍然是3
```
需要注意的是，删除属性或者删除数组元素不仅仅是设置了一个undefined的值。当删除一个属性时，这个属性将不再存在。读取一个不存在的属性将返回undefined，但是可以通过in运算符（见4.9.3节）来检测这个属性是否在对象中存在。

delete希望他的操作数是一个左值，如果它不是左值，那么delete将不进行任何操作同时返回true。否则，delete将试图删除这个指定的左值。如果删除成功，delete将返回true。然而并不是所有的属性都可删除，一些内置核心和客户端属性是不能删除的，用户通过var语句声明的变量不能删除。同样，通过function语句定义的函数和函数参数也不能删除。
在ECMAScript5严格模式中，如果delete的操作数是非法的，比如变量、函数或函数参数，delete操作将抛出一个语法错误（SyntaxError）异常，只有操作数是一个属性访问表达式（见4.4节）时候它才会正常工作。在严格模式下，delete删除不可配置的属性（参照6.7节）时会抛出一个类型错误异常。在非严格模式中，这些delete操作都不会报错，只是简单地返回false，以表明操作数不能执行删除操作。
这里有一些关于delete运算符的例子：
```javascript
var o = {x:1,y:2};  //定义一个变量，初始化为对象
delete o.x;         //删除一个对象属性，返回true
typeof o.x;         //属性不存在，返回“undefined”
delete o.x;         //删除不存在的属性，返回true
delete o;           //不能删除通过var声明的变量，返回false
                    //在严格模式下，将抛出一个异常
delete 1;           //参数不是一个左值，返回true
this.x = 1;         //给全局对象定义一个属性，这里没有使用var
delete x;           //试图删除它，在非严格模式下返回true
                    //在严格模式下会抛出异常，这时使用“delete this.x”来代替
x;                  //运行时错误，没有定义x
```
6.3节还会有关于delete操作符的讨论。

**4.13.4void运算符**
**4.13.5逗号运算符(,)**


语句
----

第4章提到，表达式在javascript中是短语，那么语句（statement）就是javascript整句或命令。正如英文是用句号作结尾来分隔语句，javascript语句是以分号结束（见2.5节）。表达式计算出一个值，但语句用来执行以使某件事发生。

“使某事发生”的一个方法是计算带有副作用的表达式。诸如赋值和函数调用这些有副作用的表达式，是可以作为单独的语句的，这种把表达式当做语句的用法也称做表达式语句（expression statement）。类似的语句还有声明语句（declaration statement），声明语句用来声明新变量或定义新函数。

javascript程序无非就是一系列可执行语句的集合。默认情况下，javascript解释器依照语句的编写顺序依次执行。另一种“使某件事发生”的方法是改变语句的默认执行顺序。javascript中有很多语句和控制结构（control structure）来改变语句的默认执行顺序：

* 条件（conditional）语句，javascript解释器可以根据一个表达式的值来判断是执行还是跳过这些语句，如if语句和switch语句。
* 循环（loop）语句，可以重复执行语句，如while和for语句。
* 跳转（jump）语句，可以让解释器跳转至程序的其他部分继续执行，如break、return和throw语句。

接下来几节将介绍javascript中各式各样的语句及其语法。本章最后的表5-1对这些语句作了总结。一个javascript程序无非是一个以分号分隔的语句集合，所以一旦掌握了javascript语句，就可以开始编写javascript程序了。

**5.1表达式语句**

**5.2复合语句和空语句**

**5.3声明语句**

**5.4条件语句**

**5.5循环**

为了理解条件语句，可以将在javascript中的代码想象成一条条的分支路径。循环语句（looping statement）就是程序路径的一个回路。可以让一部分代码重复执行。javascript中有4种循环语句：while、do/while、for和for/in。下面几节将会依次讲解它们。其中最常用的循环就是对数组元素的遍历，7.6节详细讨论这种循环和使用数组类定义的特殊循环方法。
**5.5.1while**

**5.5.2do/while**

**5.5.3for**

**5.5.4for/in**

for/in语句也使用for关键字，但它是和常规的for循环完全不同的一类循环。for/in循环语句的语法如下：

    for(variable in object) statement

variable通常是一个变量名，也可以是一个可以产生左值的表达式或者一个通过var语句声明的变量，总之必须是一个适用于赋值表达式左侧的值。Object是一个表达式，这个表达式的计算结果是一个对象。同样，statement是一个语句或语句块，它构成了循环的主体。
使用for循环来遍历数组元素是非常简单的：
```javascript
for (var i = 0; i < a.length; i++)//i代表来数组元素的索引
    console.log(a[i]);//输出数组中的每个元素
```
而for/in循环则是用来更方便地遍历对象属性成员：
```javascript
for (var p in o)//将属性的名字赋值给变量p
console.log(o[p]);//输出每一个属性的值
```

**5.6跳转**

**5.7其他语句类型**

**5.8javascript语句小结**

第6章 对象
----------

对象是JavaScript的基本数据类型。对象是一种复合值：它将很多值（原始值或者其他对象）聚合在一起，可通过名字访问这些值，对象也可看做是属性的无序集合，每个属性都是一个名／值对。属性名是字符串，因此我们可以把对象看成是从字符串到值的映射。这种基本数据结构还有很多种叫法，有些我们已然非常熟悉，比如“散列”（hash）、“散列表”（hashtable）、“字典”（dictionary）、“关联数组”（associative-array）。然而对象不仅仅是字符串到值的映射，除了可以保持自有的属性，JavaScript对象还可以从一个称为原型的对象继承属性。对象的方法通常是继承的属性。这种“原型式继承”（prototypal inheritance）是JavaScript的核心特征。

JavaScript对象是动态的——可以新增属性也可以删除属性——但它们常用来模拟静态对象以及静态类型语言中的“结构体”（struct）。有时它们也用做字符串的集合（忽略名值对中的值）。

除了字符串、数字、true、false、null和undefined之外，JavaScript中的值都是对象。尽管字符串、数字和布尔值不是对象，但它们的行为和不可变对象（参照3.6节）非常类似。

3.7节已经讲到，对象是可变的，我们通过引用而非值来操作对象。如果变量x是指向一个对象的引用，那么执行代码var y = x;变量y也是指向同一个对象的引用，而非这个对象的副本。通过变量y修改这个对象亦会对变量x造成影响。

对象最常见的用法是创建（create）、设置（set）、查找（query）、删除（delete）、检测（test）和枚举（enumerate）它的属性。我们会在开始的几节讲述这些基础操作。后续的几节讲述高级主题，其中相当一部分内容来自于ECMAScript5.

属性包括名字和值。属性名可以是包含字符串在内的任意字符串，但对象中不能存在两个同名的属性。值可以是任意JavaScript值，或者（在ECMAScript5中）可以是一个getter或setter函数（或两者都有）。6.6节会有关于getter和setter函数的讲解。除了名字和值之外，每个属性还有一些与之相关的值，称为“属性特性”：

* 可写（writable attribute），表明是否可以设置该属性的值
* 可枚举（enumerable attribute），表明是否可以通过for／in循环返回该属性
* 可配置（configurable attribute），表明是否可以删除或修改该属性。

在ECMAScript5之前，通过代码给对象创建的所有属性都是可写的、可枚举的和可配置的。在ECMAScript5中则可以对这些特性加以配置。6.7节讲述如何操作。除了包含属性之外，每个对象还拥有三个相关的对象特性（object attribute）：

* 对象的原型（prototype）指向另外一个对象，本对象的属性继承自它的原型对象。
* 对象的类（class）是一个标识对象类型的字符串
* 对象的扩展标记（extensible flag）指明了（在ECMAScript5中）是否可以向该对象添加新属性。

6.1.3节和6.2.2节会有关于原型和属性继承的讲述，6.8节会进一步详细讲述这三个特性。
最后，我们用下面这些术语来对三类JavaScript对象和两类属性作区别：

* 内置对象（native object）是由ECMAScript规范定义的对象或类。例如，数组、函数、日期和正则表达式都是内置对象。
* 宿主对象（host object）是由JavaScript解释器所嵌入的宿主环境（比如web浏览器）定义的。客户端JavaScript中表示网页结构的HTMLElement对象均是宿主对象。既然宿主环境定义的方法可以当成普通的javascript函数对象，那么宿主对象也可以当成内置对象。
* 自定义对象（user-defined object）是由运行中的JavaScript代码创建的对象。
* 自有属性（own property）是直接在对象中定义的属性
* 继承属性（inherited property）是在对象的原型对象中定义的属性。

**6.1创建对象**

可以通过对象直接量、关键字new和(ECMAScript5中的)Object.create()函数来创建对象。接下来几节将对这些技术一一讲述。

**6.1.1对象直接量**

创建对象最简单的方式就是在JavaScript代码中使用对象直接量。对象直接量是由若干名/值对组成的映射表，名/值对中间用冒号分隔，名/值对之间用逗号分隔，整个映射表用花括号括起来。属性名可以是JavaScript标识符也可以是字符串直接量（包括空字符串）。属性的值可以是任意类型的JavaScript表达式，表达式的值（可以是原始值也可以是对象值）就是这个属性的值。下面有一些例子：

```javascript
var empty = {};                             //没有任何属性的对象
var point = { x:0, y:0 };                   //两个属性
var point2 = { x:point.x, y:point.y+1};     //更复杂的值
var book = {               
    "main title": "javascript",             //属性名字里有空格，必须用字符串表示
    'sub-title': "the definitive guide",    //属性名字里有连字符，必须用字符串表示
    "for": "all audiences",                 //for是保留字，因此必须用引号
    author: {                               //这个属性的值是一个对象
        firstname: "david",                 //注意，这里的属性名没有引号
        surname: "flanagan"
    }
};
```

在ECMAScript5（以及ECMAScript3的一些实现）中，保留字可以用做不带引号的属性名。然而对于ECMAScript3来说，使用保留字作为属性名必须使用引号引起来。在ECMAScript5中，对象直接量中的最后一个属性后的逗号将忽略，且在ECMAScript3的大部分实现中也可以忽略这个逗号，但在IE中则报错。

对象直接量是一个表达式，这个表达式的每次运算都创建并初始化一个新的对象。每次计算对象直接量的时候，也都会计算它的每个属性的值。也就是说，如果在一个重复调用的函数中的循环体内使用了对象直接量，它将创建很多新对象，并且每次创建的对象的属性值也有可能不同。

**6.1.2通过new创建对象**

new运算符创建并初始化一个新对象。关键字new后跟随一个函数调用。这里的函数称做构造函数（constructor），构造函数用以初始化一个新创建的对象。JavaScript语言核心中的原始类型都包含内置构造函数。例如：

```javascript
var o = new Object();//创建一个空对象，和{}一样
var a = new Array();//创建一个空数组，和[]一样
var d = new Date();//创建一个表示当前时间的Date对象
var r = new RegExp("js");//创建一个可以进行模式匹配的RegExp对象
```

除了这些内置构造函数，用自定义构造函数来初始化新对象也是非常常见的。第9章将详细讲述其中的细节。

**6.1.3原型**   

在讲述第三种对象创建技术之前，我们应当首先解释一下原型。每一个JavaScript对象（null除外）都和另一个对象相关联。“另一个”对象就是我们熟知的原型，每一个对象都从原型继承属性。

所有通过对象直接量创建的对象都具有同一个原型对象，并可以通过JavaScript代码Object.prototype获得对原型对象的引用。通过关键字new和构造函数调用创建的对象的原型就是构造函数的prototype属性的值。因此，同使用{}创建对象一样，通过new Object()创建的对象也继承自Object.prototype。同样，通过new Array()创建的对象的原型就是Array.prototype，通过new Date()创建的对象的原型就是Date.prototype。

没有原型的对象为数不多，Object.prototype就是其中之一。它不继承任何属性。其他原型对象都是普通对象，普通对象都具有原型。所有的内置构造函数（以及大部分自定义的构造函数）都具有一个继承自Object.prototype的原型。例如，Date.prototype的属性继承自Object.prototype，因此由new Date()创建的Date对象的属性同时继承自Date.prototype和Object.prototype。这一系列链接的原型对象就是所谓的“原型链”（prototype chain）。

6.2.2节讲述属性继承的工作机制。6.8.1节将会讲到如何获取对象的原型。第9章将会更详细地讨论原型和构造函数，包括如何通过编写构造函数定义对象的“类”，以及给构造函数的prototype属性赋值可以让其“实例”直接使用这个原型上的属性和方法。

**6.1.4Object.create()**

ECMAScript5定义了一个名为Object.create()的方法，它创建一个新对象，其中第一个参数是这个对象的原型。Object.create()提供第二个可选参数，用以对对象的属性进行进一步描述。6.7节会详细讲述第二个参数。

Object.create()是一个静态函数，而不是提供给某个对象调用的方法。使用它的方法很简单，只须传入所需的原型对象即可；

```javascript
var o1 = Object.create({x:1 ,y:2});      //o1继承了属性x和y
```

可以通过传入参数null来创建一个没有原型的新对象，但通过这种方式创建的对象不会继承任何东西，甚至不包括基础方法，比如toString(),也就是说，它将不能和“+”运算符一起正常工作:

```javascript
var o2 = Object.create(null);            //o2不继承任何属性和方法
```

如果想创建一个普通的空对象（比如通过{}或new Object()创建的对象），需要传入Object.prototype:
```javascript
var o3 = Object.create(Object.prototype);//o3和{}和new Object()一样
```

可以通过任意原型创建新对象（换句话说，可以使任意对象可继承），这是一个强大的特性。在ECMAScript3中可以用类似下例的代码来模拟原型继承：

例子：通过原型继承创建一个新对象
//inherit() 返回了一个继承自原型对象p的属性的新对象
//这里使用ECMAScript5中的Object.create()函数（如果存在的话）
//如果不存在Object.create()，则退化使用其他方法
例6-1
```javascript
function inherit(p) {
    if (p == null) throw TypeError();              //p是一个对象，但不能是null
    if (Object.create)                             //如果Object.create()存在
        return Object.create(p);                   //直接使用它
    var t = typeof p;                              //否则进行进一步检测
    if (t !== "object" && t !== "function") throw TypeError();
    function f() {};                               //定义一个空构造函数
    f.prototype = p;                               //将其原型属性设置为p
    return new f();                                //使用f()创建p的继承对象
}
```
在看完第9章关于构造函数的内容后，例6-1中的inherit()函数会更容易理解。现在只要知道它返回的新对象继承了参数对象的属性就可以了。注意，inherit()并不能完全代替Object.create()。它不能通过传入null原型来创建对象。而且不能接收可选的第二个参数。不过我们仍会在本章和第9章的示例代码中多次用到inherit()。

inherit()函数的其中一个用途就是防止库函数无意间（非恶意地）修改那些不受你控制的对象。不是将对象直接作为参数传入函数，而是将它的继承对象传入函数。当函数读取继承对象的属性时，实际上读取的是继承来的值。如果给继承对象的属性赋值，则这些属性只会影响这个继承对象自身，而不是原始对象。
```javascript
var o = { x: "don't change this value"};
library_function(inherit(o));   //防止对o的意外修改
```
了解其工作原理，需要首先了解JavaScript中属性的查询和设置机制。接下来会讲到。

**6.2属性的查询和设置**

4.4节已经提到，可以通过点（.）或方括号（[]）运算符来获取属性的值。运算符左侧应当是一个表达式，它返回一个对象。对于（.）来说，右侧必须是一个以属性名称命名的简单标识符。对于方括号来说（[]），方括号内必须是一个计算结果为字符串的表达式，这个字符串就是属性的名字：
```javascript
var author = book.author;      //得到book的“author”属性
var name = author.surname;     //得到获得author的“surname”属性
var title = book["main title"];//得到book的“main title”属性
```

和查询属性值的写法一样，通过点和方括号也可以创建属性或给属性赋值，但需要将它们放在赋值表达式的左侧：
```javascript
book.edition = 6;                  //给book创建一个名为"edition"的属性
book["main title"] = "ECMAScript"; //给"main title"属性赋值
```

在ECMAScript3中，点运算符后的标识符不能是保留字，比如，o.for或o.class是非法的，因为for是JavaScript的关键字，class是保留字。如果一个对象的属性名是保留字，则必须使用方括号的形式访问它们，比如o["for"]和o["class"]。ECMAScript5对此放宽了限制（包括ECMAScript3的某些实现），可以在点运算符后直接使用保留字。

当使用方括号时，我们说方括号内的表达式必须返回字符串。其实更严格地讲，表达式必须返回字符串或返回一个可以转换为字符串的值。在第7章里有一些例子中的方括号内使用了数字，这情况是非常常见的。

**6.2.1作为关联数组的对象**

上文提到，下面两个JavaScript表达式的值相同
```javascript
object.property
object["property"]
```

第一种语法使用点运算符和一个标识符，这和C和Java中访问一个结构体或对象的静态字段非常类似。第二种语法使用方括号和一个字符串，看起来像是数组，只是这个数组元素是通过字符串索引而不是数字索引。这种数组就是我们所说的关联数组（associative-array），也称做散列、映射或字典（dictionary）。JavaScript对象都是关联数组，本节将讨论它的重要性。

在C、C++和Java和一些强类型（strong-typed，强类型，为所有变量指定数据类型称为“强类型”。强／弱类型是指类型检查的严格程度。语言有无类型、弱类型和强类型三种。无类型的不检查，甚至不区分指令和数据。弱类型的检查很弱，仅能严格区分指令和数据。强类型的则严格的在编译期间进行检查）的语言中，对象只能拥有固定数目的属性，并且这些须提前定义好。由于JavaScript是弱类型语言，因此不必遵循这条规定，在任何对象中程序都可以创建任意数量的属性（这里的意思是可以动态地给对象添加属性。严格讲，JavaScript对象的属性个数是有上限的）。但当通过点运算符访问对象的属性时，属性名用一个标识符来表示。标识符必须直接出现在JavaScript程序中，它们不是数据类型，因此程序无法修改它们（“程序不能修改标志符”的意思是说，在程序运行时无法动态指定一个标志符，当然eval除外）。

反过来讲，当通过[]来访问对象的属性时，属性名通过字符串来表示。字符串是JavaScript的数据类型，在程序运行时可以修改和创建它们。因此，可以在JavaScript中使用下面这种代码：
```javascript
var addr = "";
for(i = 0; i<4; i++){
    addr += customer["address" + i]+'\n';
}
```
这段代码读取customer的adderss0、address1、address2和address3属性，并将它们连接起来。

这个例子主要说明了使用数组写法和用字符串表达式来访问对象属性的灵活性。这段代码也可以通过点运算符来重写，但是很多场景只能通过数组写法来完成。假设你正在写一个程序，这个程序利用网络资源计算当前用户股票市场投资的金额。程序允许用户输入每只股票的名称和购股份额。该程序使用名为portfolio的对象来存储这些信息。每只股票在这个对象中都有对应的属性，属性名称就是股票名称，属性值就是购股数量，例如，如果用户持有IBM的50股，那么portfolio.ibm属性的值就为50。

下面是程序的部分代码，这个函数用来给portfolio添加新的股票：
```javascript
function addstock(portfolio,stockname,shares){
    portfolio[stockname] = shares;
}
```

由于用户是在程序运行时输入股票名称，因此在之前无法得知这些股票的名称是什么。而由于在写程序的时候不知道属性名称，因此无法通过点运算符来访问对象portfolio的属性。但可以使用[]运算符，因为它使用字符串值（字符串值是动态的，可以在运行时更改）而不是标识符(标识符是静态的，必须写死在程序中)作为索引对属性进行访问。

第5章介绍了for/in循环（6.5节还会进一步介绍）。当使用for/in循环遍历关联数组时，就可以清晰地体会到for/in的强大之处。下面例子就是利用for/in计算portfolio的总计值：
```javascript
function getvalue(portfolio) {
    var total = 0.0;
    for(stock in portfolio) {           //遍历portfolio中的每只股票
        var shares = portfolio[stock];  //得到每只股票的份额
        var price = getquote(stock);    //查找股票价格
        total += shares * price;        //将结果累加至total中
    }
    return total;                       //返回total的值
}
```

**6.2.2继承**

JavaScript对象具有“自有属性”（own property），也有一些属性是从原型对象继承而来的。为了更好地理解这种继承，必须更深入地了解属性访问的细节。本节中的许多示例代码借用了例6-1中的inherit()函数，通过给它传入指定原型对象来创建实例。

假设要查询对象o的属性x，如果o中不存在x，那么将会继续在o的原型对象中查询属性x。如果原型对象中也没有x，但这个原型对象也有原型，那么继续在这个原型对象的原型上执行查询，直到找到x或者查找到一个原型是null的对象为止。可以看到，对象的原型属性构成了一个“链”，通过这个“链”可以实现属性的继承。
```javascript
var o = {};         //o 从Object.prototype 继承对象的方法
o.x = 1;            //给o定义一个属性
var p = inherit(o); //p继承o和Object.prototype
p.y = 2;            //给p定义一个属性y
var q = inherit(p); //q继承p、o和Object.prototype
q.z = 3;            //给q定义一个属性
var s = q.toString();//toString继承自Object.prototype
q.x + q.y            //=> 3 x和y分别继承自o和p
```

现在假设给对象o的属性x赋值，如果o中已经有属性x（这个属性不是继承来的），那么这个赋值操作只改变这个已有属性x的值。如果o中不存在属性x，那么赋值操作给o添加一个新属性x。如果之前o继承自属性x，那么这个继承的属性就被新创建的同名属性覆盖了。

属性赋值操作首先检查原型链，以此判定是否允许赋值操作。例如，如果o继承自一个只读属性x，那么赋值操作是不允许的（6.2.3节将对此进行详细讨论）。如果允许属性赋值操作，它也总是在原始对象上创建属性或对已有的属性赋值，而不会去修改原型链。在JavaScript中，只有在查询属性时才会体会到继承的存在，而设置属性则和继承无关，这是JavaScript的一个重要特性，该特性让程序员可以有选择地覆盖（override）继承的属性。
```javascript
var unitcircle = {r:1};     //一个用来继承的对象
var c = inherit(unitcircle);//c继承属性r
c.x = 1; c.y = 1;           //c定义两个属性
c.r = 2 ;                   //c覆盖继承来的属性
unitcircle.r;               //=> 1 原型对象没有修改
```

属性赋值要么失败，要么创建一个属性，要么在原始对象中设置属性，但有一个例外，如果o继承自属性x，而这个属性是一个具有setter方法的accessor属性（参照6.6节）。那么这时将调用setter方法而不是给o创建一个属性x。需要注意的是，setter方法是由对象o调用的，而不是定义这个属性的原型对象调用的。因此如果setter方法定义任意属性，这个操作只是针对o本身，并不会修改原型链。

**6.2.3属性访问错误**

属性访问并不总是返回或设置一个值。本节讲述查询或设置属性时的一些出错情况。

查询一个不存在的属性并不会报错，如果在对象o自身的属性或继承的属性中均未找到属性x，属性访问表达式o.x返回undefined。回想一下我们的book对象有属性“sub-title”，而没有属性“subtitle”：
```javascript
    book.subtitle;//=>undefined 属性不存在
```

但是，如果对象不存在，那么试图查询这个不存在的对象的属性就会报错。null和undefined值都没有属性，因此查询这些值的属性会报错，接上例：
```javascript
//抛出一个类型错误异常，undefined没有length属性
var len = book.subtitle.length;
```

除非确定book和book.subtitle都是（或在行为上）对象，否则不能这样写表达式book.subtitle.length，因为这样会报错，下面提供了两种避免出错的方法：
```javascript
//一种冗余但很易懂的方法
var len = undefined;
if (book) {
    if (book.subtitle) len = book.subtitle.length;
}
//一种更简练的常用方法，获取subtitle的length属性或undefined
var len = book&&book.subtitle&&book.subtitle.length;
```
为了理解这里的第二种方法为什么可以避免类型错误异常，可以参照4.10.1节中关于&&运算符的短路行为。

当然，给null和undefined设置属性也会报类型错误。给其他值设置属性也不总是成功，有一些属性是只读的，不能重新赋值，有一些对象不允许新增属性，但让人颇感意外的是，这些设置属性的失败操作不会报错：
```javascript
//内置构造函数的原型是只读的
Object.prototype = 0;//赋值失败，但没报错，Object.prototype没有修改
```
这是一个历史遗留问题，这个bug在ECMAScript5的严格模式中已经修复。在严格模式中，任何失败的属性设置操作都会抛出一个类型错误异常。
尽管属性赋值成功或失败的规律看起来很简单，但要描述清楚并不容易。在这些场景下给对象o设置属性p会失败：

* o中的属性p是只读的；不能给只读属性重新赋值（defineProperty()方法中有一个例外，可以对可配置的只读属性重新赋值）。
* o中的属性p是继承属性，且它是只读的，不能通过同名自有属性覆盖只读的继承属性。
* o中不存在自有属性p：o没有使用setter方法继承属性p，并且o的可扩展性（extensible-attribute）是false（参照6.8.3节）。如果o中不存在p，而且没有setter方法可供调用，则p一定会添加至o中。但如果o不是可扩展的，那么o中不能定义新属性。

**6.3删除属性**

delete运算符（见4.13.3节）可以删除对象的属性。它的操作数应当是一个属性访问表达式。让人意外的是，delete只是断开属性和宿主对象的联系，而不会去操作属性中的属性：
```
a={p:{x:1}};b=a.p;delete a.p;执行这段代码之后b.x的值依然是1。由于已经删除的属性的引用依然存在，因此在JavaScript的某些实现中，可能因为这种不严谨的代码而造成内存泄漏。所以在销毁对象的时候，要遍历属性中的属性，依次删除。
```
```
delete book.author;//book不再有属性author
delete book["main title"];//book也不再有属性“main title”
```

delete运算符只能删除自由属性，不能删除继承属性（要删除继承属性必须从定义这个属性的原型对象上删除它，而且这会影响到所有继承自这个原型的对象）。

当delete表达式删除成功或没有任何副作用（比如删除不存在的属性）时，它返回true。如果delete后不是一个属性访问表达式，delete同样返回true：
```javascript
o = {x:1};//o有一个属性x，并继承属性toString
delete o.x;//删除x，返回true
delete o.x;//什么都没做（x已经不存在了），返回true
delete o.toString;//什么也没做（toString是继承来的），返回true
delete 1;//无意义，返回true
```

delete不能删除那些可配置性为false的属性（尽管可以删除不可扩展对象的可配置属性）。某些内置对象的属性是不可配置的，比如通过变量声明和函数声明创建的全局对象的属性。在严格模式中，删除一个不可配置属性会报一个类型错误。在非严格模式中（以及ECMAScript3中），在这些情况下的delete操作会返回false：
```javascript
delete Object.prototype;//不能删除，属性是不可配置的
var x = 1;//声明一个全局变量
delete this.x//不能删除这个属性
function f() {}//声明一个全局函数
delete this.f;//也不能删除全局函数
```

当在非严格模式中删除全局对象的可配置属性时，可以省略对全局对象的引用，直接在delete操作符后跟随要删除的属性名即可。
```javascript
this.x = 1;//创建一个可配置的全局属性（没有用var）
delete x;//将它删除
```

然而在严格模式中，delete后跟随一个非法的操作数（比如x），则会报一个语法错误，因此必须显式指定对象及其属性：
```javascript
delete x;//在严格模式下报语法错误
delete this.x//正常工作
```

**6.4检测属性**

JavaScript对象可以看做属性的集合，我们经常会检测集合中成员的所属关系——判断某个属性是否存在于某个对象中。可以通过in运算符、hasOwnPreperty()和propertyIsEnumerable()方法来完成这个工作，甚至仅通过属性查询也可以做到这一点。

in运算符的左侧是属性名（字符串），右侧是对象。如果对象的自有属性或继承属性中包含这个属性则返回true：
```javascript
var o = {x:1};//
"x" in o;//true: "x"是o的属性
"y" in o;//false: "y"不是o的属性
"toString" in o;//true: o继承toString属性
```

对象的hasOwnProperty()方法用来检测给定的名字是否是对象的自有属性。对于继承属性它将返回false：
```javascript
var o = {x:1};
o.hasOwnProperty("x");//true: o有一个自有属性x
o.hasOwnProperty("y");//false: o中不存在属性y
o.hasOwnProperty("toString");//false: toString是继承属性
```
propertyIsEnumerable()是hasOwnProperty()的增强版，只有检测到是自有属性且这个属性的可枚举性（enumerable-attribute）为true时它才返回true。某些内置属性是不可枚举的。通常由JavaScript代码创建的属性都是可枚举的，除非在JavaScript5中使用一个特殊的方法来改变属性的可枚举性，随后会提到：
```javascript
var o = inherit({y:2});
o.x = 1;
o.propertyIsEnumerable("x");//true o有一个可枚举的自有属性x
o.propertyIsEnumerable("y");//false y是继承来的
Object.prototype.propertyIsEnumerable("toString");//false 不可枚举
```

除了使用in运算符之外，另一种更简便的方法是使用“!==”判断一个属性是否是undefined：
```javascript
var o {x:1}
o.x !== undefined;//true o中有属性x
o.y !== undefined;//false o中没有属性y
o.toString !== undefined;//true o继承了toString属性
```

然而有一种场景只能使用in运算符而不能使用上述属性访问的方式。in可以区分不存在的属性和存在但值为undefined的属性。例如下面的代码：
```javascript
var o ={x:undefined};//属性被显式赋值为undefined
o.x !== undefined;//false 属性存在，但值为undefined
o.y !== undefined;//false 属性不存在
"x" in o;//true 属性存在
"y" in o;//false 属性不存在
delete o.x;//删除了属性x
"x" in o;//false 属性不再存在
```

注意，上述代码中使用的是“!==”运算符，而不是“!=”。“!==”可以区分undefined和null。有时则不必作这些区分：
```javascript
//如果o中含有属性x，且x的值不是null或undefined，o.x乘以2
if(o.x != null) o.x*=2;
//如果o中含有属性x，且x的值不能转换为false，o.x乘以2
//如果x是undefined、null、false、""、0或NaN，则它保持不变
if(o.x) o.x*=2;
```

**6.5枚举属性**

除了检测对象的属性是否存在，我们还会经常遍历对象的属性。通常使用for/in循环遍历，ECMAScript5提供了两个更好用的替代方案。

5.5.4节讨论过for/in循环，for/in循环可以在循环体中遍历对象中所有可枚举的属性（包括自有属性和继承的属性），把属性名称赋值给循环变量。对象继承的内置方法不可枚举的，但在代码中给对象添加的属性都是可枚举的（除非用下文中提到的一个方法将它们转换为不可枚举的）。例如：
```javascript
var o = {x:1, y:2, z:3};//三个可枚举的自有属性
o.propertyIsEnumerable("toString")//=>false，不可枚举
for(p in o)//遍历属性
console.log(p)//输出x、y和z，不会输出toString
```

有很多实用工具库给Object.prototype添加了新的方法或属性，这些方法和属性可以被所有对象继承并使用。然而在ECMAScript5标准之前，这些新添加的方法是不能定义为不可枚举的，因此它们都可以在for/in循环中枚举出来。为了避免这种情况，需要过滤for/in循环返回的属性，下面两种方式是最常见的：
```javascript
for(p in o){
    if(!o.hasOwnProperty(p)) continue;//跳过继承的属性
}
for(p in o){
    if(typeof o[p] === "function") continue;//跳过方法
}
```

例6-2定义了一些有用的工具函数来操控对象的属性，这些函数用到了for/in循环。实际上extend()函数经常出现在JavaScript实用工具库中。
这里实现的extend()逻辑虽然正确，但并不能弥补IE中有一些众所周知的bug，在例8-3中会有更健壮的extend()实现。

例6-2：用来枚举属性的对象工具函数
```javascript
/*
 * Copy the enumerable properties of p to o, and return o.
 * If o and p have a property by the same name, o's property is overwritten.
 * This function does not handle getters and setters or copy attributes.
 *把p中的可枚举属性复制到o中，并返回o，如果o和p中含有同名属性，则覆盖o中的属性，这个函数并不处理getter和setter以及复制属性
 */
function extend(o, p) {
    for(prop in p) {                         // For all props in p，遍历p中的所有属性
        o[prop] = p[prop];                   // Add the property to o，将属性添加至o中
    }
    return o;
}

/*
 * Copy the enumerable properties of p to o, and return o.
 * If o and p have a property by the same name, o's property is left alone.
 * This function does not handle getters and setters or copy attributes.
 *将p中的可枚举属性复制至o中，并返回o，如果o和p中同名的属性，o中的属性将不受影响，这个函数将不处理getter和setter以及复制属性 
 */
function merge(o, p) {
    for(prop in p) {                           // For all props in p，遍历p中所有的属性
        if (o.hasOwnProperty[prop]) continue;  // Except those already in o，过滤掉已经在o中存在的属性
        o[prop] = p[prop];                     // Add the property to o，将属性添加至o中
    }
    return o;
}

/*
 * Remove properties from o if there is not a property with the same name in p.
 * Return o.
 *如果o中的属性在p中没有同名属性，则从o中删除这个属性，返回o
 */
function restrict(o, p) {
    for(prop in o) {                         // For all props in o，遍历o中所有的属性
        if (!(prop in p)) delete o[prop];    // Delete if not in p，如果在p中不存在，则删除之
    }
    return o;
}

/*
 * For each property of p, delete the property with the same name from o.
 * Return o.
 *如果o中的属性在p中存在同名属性，则从o中删除这个属性，返回o
 */
function subtract(o, p) {
    for(prop in p) {                         // For all props in p，遍历p中所有的属性
        delete o[prop];                      // Delete from o (deleting a
                                             // nonexistent prop is harmless)，从o中删除（删除一个不存在的属性不会报错）
    }
    return o;
}

/*
 * Return a new object that holds the properties of both o and p.
 * If o and p have properties by the same name, the values from o are used.
 *返回一个新对象，这个对象同时拥有o的属性和p的属性，如果o和p中有重名属性，使用p中的属性值
 */
function union(o,p) { return extend(extend({},o), p); }

/*
 * Return a new object that holds only the properties of o that also appear
 * in p. This is something like the intersection of o and p, but the values of
 * the properties in p are discarded
 *返回一个新对象，这个对象拥有同时在o和p中出现的属性，很像求o和p的交集，但p中属性的值被忽略
 */
function intersection(o,p) { return restrict(extend({}, o), p); }

/*
 * Return an array that holds the names of the enumerable own properties of o.
 *返回一个数组，这个数组包含的是o中可枚举的自有属性的名字
 */
function keys(o) {
    if (typeof o !== "object") throw TypeError();  // Object argument required，参数必须是对象
    var result = [];                 // The array we will return，将要返回的数组
    for(var prop in o) {             // For all enumerable properties，遍历所有可枚举的属性
        if (o.hasOwnProperty(prop))  // If it is an own property，判断是否是自有属性
            result.push(prop);       // add it to the array.将属性名添加至数组中
    }
    return result;                   // Return the array.返回这个数组
}
```
除了for/in循环之外，ECMAScript5定义了两个用以枚举属性名称的函数。第一个是Object.keys()，它返回一个数组，这个数组由对象中可枚举的自有属性的名称组成，它的工作原理和例6-2中的工具函数keys()类似。

ECMAScript5中第二个枚举的属性的函数是Object.getOwnPropertyNames(),它和Object.keys()类似，只是它返回对象的所有自有属性的名称，而不仅仅是可枚举的属性。在ECMAScript3中是无法实现的类似的函数的，因为ECMAScript3中没有提供任何方法来获取对象不可枚举的属性。

**6.6属性getter和setter**

我们知道，对象属性是由名字、值和一组特性（attribute）构成的。在ECMAScript5中（包括除IE之外的最新主流浏览器的ECMAScript3的实现），属性值可以用一个或两个方法替代，这两个方法就是getter和setter。有getter和setter定义的属性称做“存取器属性”（accessor-property），它不同于“数据属性”（data-property），数据属性只有一个简单的值。

当程序查询存取器属性的值时，JavaScript调用getter方法（无参数）。这个方法的返回值就是属性存取表达式的值。当程序设置一个存取器属性的值时，JavaScript调用setter方法，将赋值表达式右侧的值当做参数传入setter。从某种意义上讲，这个方法负责“设置”属性值。可以忽略setter方法的返回值。

和数据属性不同，存取器属性不具有可写性（writable-attribute）。如果属性同时具有getter和setter方法，那么它是一个读/写属性。如果它只有getter方法，那么它是一个只读属性。如果它只有setter方法，那么它是一个只写属性（数据属性中有一些例外），读取只写属性总是返回undefined。

定义存取器属性最简单的方法是使用对象直接量语法的一种扩展写法：
```javascript
var o = {
//普通的数据属性
data_prop: value,
//存取器属性都是成对定义的函数
get accessor_prop(){/*这里是函数体*/},
set accessor_prop(value){/*这里是函数体*/}
};
```

存取器属性定义为一个或两个和属性同名的函数，这个函数定义没有使用function关键字，而是使用get和（或）set。注意，这里没有使用冒号将属性名和函数体分隔开，但在函数体的结束和下一个方法或数据属性之间有逗号分隔。例如，思考下面这个表示2D笛卡尔点坐标的对象。它有两个普通的属性x和y分别表示对应点的x坐标和y坐标，它还有两个等价的存取器属性用来表示点的极坐标：
```javascript
var p = {
//x和y是普通的可读写的数据属性
x:1.0,
y:1.0,
//r是可读写的存取器属性，它有getter和setter
//函数体结束后不要忘记带上逗号
get r() {return Math.sqrt(this.x*this.x+this.y*this.y);},
set r(newvalue) {
    var oldvalue = Math.sqrt(this.x*this.x+this.y*this.y);
    var ratio = newvalue/oldvalue;
    this.x *= ratio;
    this.y *= ratio;
},
//theta是只读存取器属性，它只有getter方法
get theta() { return Math.atan2(this.y,this.x);}
};
```
注意在这段代码中getter和setter里this关键字的用法。JavaScript把这些函数当做对象的方法来调用，也就是说，在函数体内的this指向表示这个点的对象，因此，r属性的getter方法可以通过this.x和this.y引用x和y属性。8.2.2节会对方法和this关键字做更详尽的讲述。

和数据属性一样，存取器属性是可以继承的，因此可以将上述代码中的对象p当做另一个“点”的原型。可以给新对象定义它的x和y属性，但r和theta属性是继承来的：
```javascript
var q = inherit(p);//创建一个继承getter和setter的新对象
q.x = 1, q,y = 1;//给q添加两个属性
console.log(q.r);//可以使用继承的存取器属性
console.log(q.theta);
```

这段代码使用存取器属性定义api，api提供了表示同一组数据的两种方法（笛卡尔坐标系表示法和极坐标系表示法）。还有很多场景可以用到存取器属性，比如智能检测属性的写入值以及在每次属性读取时返回不同值：
```javascript
//这个对象产生严格自增的序列号
var serialnum = {
//这个数组属性包含下一个序列号
//$符号暗示这个属性是一个私有属性
$n: 0,
//返回当前值，然后自增
get next() { return this.$n++; },
//给n设置新的值，但只有当它比当前值大时才设置成功
set next(n) {
    if(n >= this.$n) this.$n = n;
    else throw "序列号的值不能比当前值小";
}
}
```

最后我们再来看一个例子，这个例子使用getter方法实现一种“神奇”的属性：
```javascript
//这个对象有一个可以返回随机数的存取器属性
//例如，表达式“random.octet”产生一个随机数
//每次产生的随机数都在0~255之间
var random = {
    get octet() {return Math.floor(Math.random()*256);},
    get uint16() {return Math.floor(Math.random()*65536);},
    get int16() {return Math.floor(Math.random()*65536)-32768;}
};
```
本节介绍了如何给对象直接量定义存取器属性。下一步会介绍如何给一个已经存在的对象添加一个存取器属性。

**6.7属性的特性**

除了名字和值之外，属性还包含一些标识它们可写、可枚举和可配置的特性。在ECMAScript3中无法设置这些特性，所有通过ECMAScript3的程序创建的属性都是可写的、可枚举的和可配置的，且无法对这些特性做修改。本节将讲述ECMAScript5中查询和设置这些属性特性的api，这些api对于库的开发者来说非常重要，因为：

* 可以通过这些api给原型对象添加方法，并将它们设置成不可枚举的，这让它们看起来更像内置方法。
* 可以通过这些api给对象定义不能修改或删除的属性，借此“锁定”这个对象。

在本节里，我们将存取器属性的getter和setter方法看成是属性的特性。按照这个逻辑，我们也可以把数据属性的值同样看做属性的特性。因此，可以认为一个属性包含一个名字和4个特性。数据属性的4个特性分别是它的值（value）、可写性（writable）、可枚举性（enumerable）和可配置性（configurable）。存取器属性不具有值（value）特性和可写性，它们的可写性是由setter方法存在与否决定的。因此存取器属性的4个特性是读取（get）、写入（set）、可枚举性和可配置性。   

为了实现属性特性的查询和设置操作，ECMAScript5中定义了一个名为“属性描述符”（property-descriptor）的对象，这个对象代表那4个特性。描述符对象的属性和它们所描述的属性特性是同名的。因此，数据属性的描述符对象的属性有value、writable、enumerable和configurable。存取器属性的描述符对象则用get属性和set属性代替value和writable。其中writable、enumerable和configurable都是布尔值，当然，get属性和set属性是函数值。

通过调用Object.getOwnPropertyDescriptor()可以获得某个对象特定属性的属性描述符：
```javascript
//返回{value:1,writable:true,enumerable:true;configurable:true}
Object.getOwnPropertyDescripor({x:1},"x");
//查询上下文中定义的random对象的octet属性
//返回{get:/*func*/, set:undefined,enumerable:true;configurable:true}
Object.getOwnPropertyDescriptor(random,"octet");
//对于继承属性和不存在的属性，返回undefined
Object.getOwnPropertyDescriptor({},"x"); //undefined，没有这个属性
Object.getOwnPropertyDescriptor({},"toString");//undefined，继承属性
```
从函数名字就可以看出，Object.getOwnPropertyDescriptor()只能得到自有属性的描述符。要想获得继承属性的特性，需要遍历原型链（参照6.8.1节的Object.getPrototypeOf()）。

要想设置属性的特性，或者想让新建属性具有某种特性，则需要调用Object.definePeoperty()，传入要修改的对象、要创建或修改的属性的名称以及属性描述符对象。
```javascript
var o = {};//创建一个空对象
//添加一个不可枚举的数据属性x，并赋值为1
Object.defineProperty(o,"x",{value:1,writable:true,enumerable:false,configurable:true});
//属性是存在的，但不可枚举
o.x;//=>1
Object.kes(o)//=>[]
//现在只对属性x做修改，让它变为只读
Object.defineProperty(o,"x",{writable:false});
//试图更改这个属性的值
o.x = 2;//操作失败，但不报错，而在严格模式中抛出类型错误异常
o.x //=> 1
//属性依然是可配置的，因此可以通过这种方式对它进行修改：
Object.defineProperty(o,"x",{value:2});
o.x //=>2
//现在将x从数据属性修改为存取器属性
Object.defineProperty(o,"x",{get:function(){return o;}});
o.x //=>0
```
传入Object.defineProperty()的属性描述符对象不必包含所有4个特性。对于新创建的属性来说，默认的特征值是false或undefined。对于修改的已有属性来说，默认的特性值没有做任何修改。注意，这个方法要么修改已有属性要么新建自有属性，但不能修改继承属性。

如果同时修改或创建多个属性，则需要使用Object.defineProperties()。第一个参数是要修改的对象，第二个参数是一个映射表，它包含要新建或修改的属性的名称，以及它们的属性描述符，例如：
```javascript
var p = Object.defineProperties({},{
    x:{value:1,writable:true,enumerable:true,configurable:true},
    y:{value:1,writable:true,enumerable:true,configurable:true},
    r:{
        get: function(){return Math.sqrt(this.x*this.x + this.y*this.y)},
        enumerable: true,
        configurable: true
    }
});
```
这段代码从一个空对象开始，然后给它添加两个数据属性和一个只读存取器属性。最终Object.defineProperties()返回修改后的对象（和Object.defineProperty()一样）。

对于那些不允许创建或修改的属性来说，如果用Object.defineProperty()和Object.defineProperties()对其操作（新建或修改）就会抛出类型错误异常，比如，给一个不可扩展的对象（参照6.8.3节）新增属性就会抛出类型错误异常。造成这些方法抛出类型错误异常的其他原因则和特性本身有关。可写性控制着对值特性的修改。可配置性控制着对其他特性（包括属性是否可以删除）的修改。然而规则远不止这么简单，例如，如果属性是可配置的话，则可以修改不可写属性的值。同样，如果属性是不可配置的，仍然可以将可写属性修改为不可写属性。下面是完整的规则，任何对Object.defineProperty()或Object.defineProperties()违反规则的使用都会抛出类型错误异常：

* 如果对象是不可扩展的，则可以编辑已有的自有属性，但不能给它添加新属性。
* 如果属性是不可配置的，则不能修改它的可配置性和可枚举性。
* 如果存取器属性是不可配置的，则不能修改其getter和setter方法，也不能将它转换为数据属性。
* 如果数据属性是不可配置的，则不能将它转换为存取器属性。
* 如果数据属性是不可配置的，则不能将它的可写性从false修改为true，但可以从true修改为false。
* 如果数据属性是不可配置且不可写的，则不能修改它的值。然而可配置但不可写属性的值是可以修改的（实际上是先将它标记为可写的，然后修改它的值，最后转换为不可写的）

例6-2实现了extend()函数，这个函数把一个对象的属性复制到另一个对象中。这个函数只是简单地复制属性名和值，没有复制属性的特性，而且也没有复制存取器属性的getter和setter方法，只是将它们简单地转换为静态的数据属性。例6-3给出了改进的extend()，它使用Object.getOwnPropertyDescriptor()和Object.defineProperty()对属性的所有特性进行复制。新的extend()作为不可枚举属性添加到Object.prototype中，因此它是Object上定义的新方法，而不是一个独立的函数。

```javascript
/*
 * Add a nonenumerable extend() method to Object.prototype.
 * This method extends the object on which it is called by copying properties
 * from the object passed as its argument.  All property attributes are
 * copied, not just the property value.  All own properties (even non-
 * enumerable ones) of the argument object are copied unless a property
 * with the same name already exists in the target object.
 *给Object.prototype添加一个不可枚举的extend()方法
 *这个方法继承自调用它的对象，将作为参数传入对象的属性一一复制
 *除了值之外，也复制属性的所有特性，除非在目标对象中存在同名的属性,
 *参数对象的所有自有对象（包括不可枚举的属性）也会一一复制
 */
Object.defineProperty(Object.prototype,
    "extend",                  // Define Object.prototype.extend，定义Object.prototype.extend
    {
        writable: true,
        enumerable: false,     // Make it nonenumerable，将其定义为不可枚举的
        configurable: true,
        value: function(o) {   // Its value is this function，值就是这个函数
            // Get all own props, even nonenumerable ones，得到所有的自有属性，包括不可枚举属性
            var names = Object.getOwnPropertyNames(o);
            // Loop through them，遍历它们
            for(var i = 0; i < names.length; i++) {
                // Skip props already in this object，如果属性已经存在，则跳过
                if (names[i] in this) continue;
                // Get property description from o，获得o中的属性的描述符
                var desc = Object.getOwnPropertyDescriptor(o,names[i]);
                // Use it to create property on this，用它给this创建一个属性
                Object.defineProperty(this, names[i], desc);
            }
        }
    });
```

getter和setter的老式API:可以通过6.6节描述的对象直接量语法给新对象定义存取器属性，但不能查询属性的getter和setter方法或给已有的对象添加新的存取器属性。在ECMAScript5中，可以通过Object.getOwnPropertyDescriptor()和Object.defineProperty()来完成这些工作。

在ECMAScript5标准被采纳之前，大多数JavaScript的实现（IE浏览器除外）已经可以支持对象直接量语法中的get和set写法。这些实现提供了非标准的老式api用来查询和设置getter和setter。这些api由4个方法组成，所有对象都拥有这些方法。__lookupGetter__()和__lookupSetter__()用以返回一个命名属性的getter和setter方法。__defineGetter__()和__defineSetter__()用以定义getter和setter，这两个函数的第一个参数是属性名字，第二个参数是getter和setter方法。这4个方法都是以两条下划线作前缀，两条下划线做后缀，以表明它们是非标准的方法。本书第三部分没有对非标准方法做介绍。

**6.8对象的三个属性**

每一个对象都有与之相关的原型（prototype）、类（class）和可扩展性（extensible-attribute）。下面几节将会展开描述这些属性有什么作用，以及如何查询和设置它们。

**6.8.1原型属性**

对象的原型属性是用来继承属性的（关于原型和原型继承的更多内容请参照6.1.3节和6.2.2节），这个属性如此重要，以至于我们经常把“o的原型属性”直接叫做“o的原型”。

原型属性是在实例对象创建之初就设置好的，回想一下6.1.3节提到的，通过对象直接量创建的对象使用Object.prototype作为它们的原型。通过new创建的对象使用构造函数的prototype属性作为它们的原型。通过Object.create()创建的对象使用第一个参数（也可以是null）作为它们的原型。

在ECMAScript5中，将对象作为参数传入Object.getPrototypeOf()可以查询它的原型。在ECMAScript3中，则没有与之等价的函数，但经常使用表达式o.constructor.prototype来检测一个对象的原型。通过new表达式创建的对象，通常继承一个constructor属性，这个属性指代创建这个对象的构造函数。更多细节将会放在9.2节进一步讨论，9.2节还解释了使用这种方法来检测对象原型的方式并不可靠的原因。注意，通过对象直接量或Object.create()创建的对象包含一个名为constructor的属性，这个属性指代Object()构造函数。因此，constructor.prototype才是对象直接量的真正的原型，但对于通过Object.create()创建的对象则往往不是这样。

要想检测一个对象是否是另一个对象的原型（或处于原型链中），请使用isPrototypeOf()方法。例如，可以通过p.isPrototypeOf(o)来检测p是否是o的原型：
```javascript
var p = {x:1}//定义一个原型对象
var o = Object.create(p);//使用这个原型创建一个对象
p.isPrototypeOf(o); //=>true　o继承自p
Object.prototype.isPrototypeOf(o) //=>true o继承自Object.prototype
Object.prototype.isPrototypeOf(p) //=>true p继承自Object.prototype
```

需要注意的是，isPrototypeOf()函数实现的功能和instcanceof运算符非常类似（参照4.9.4节）。

Mozilla实现的JavaScript（包括早些年的netscape）对外暴露了一个专门命名__proto__的属性，用以直接查询/设置对象的原型。但并不推荐使用__proto__，因为尽管Safari和Chrome的当前版本都支持它，但IE和Opera还未实现它（可能以后也不会实现）。实现了ECMAScript5的firefox版本依然支持__proto__，但对修改不可扩展的对象的原型做了限制。

**6.8.2类属性**

对象的类属性（class attribute）是一个字符串，用以表示对象的类型信息。ECMAScript3和ECMAScript5都未提供设置这个属性的方法，并只有一种间接的方法可以查询它。默认的toString()方法（继承自Object.prototype）返回了如下这种格式的字符串：
```
[object class]
```   
因此，要想获得对象的类，可以调用对象的toString()方法，然后提取已返回字符串的第8个到倒数第二个位置之间的字符。不过让人感觉棘手的是，很多对象继承的toString()方法重写了，为了能调用正确的toString()版本，必须间接地调用Function.call()方法（参照8.7.3节）。例6-4中的classof()函数可以返回传递给它的任意对象的类：
```javascript
function classof(o) {
    if (o === null) return "Null";
    if (o === undefined) return "Undefined";
    return Object.prototype.toString.call(o).slice(8,-1);
}
```

classof()函数可以传入任何类型的参数。数字、字符串和布尔值可以直接调用toString()方法，就和对象调用toString()方法一样，并且这个函数包含了对null和undefined的特殊处理（在ECMAScript5中不需要对这些特殊情况做处理）。通过内置构造函数（比如Array和Date）创建的对象包含“类属性”（class attribute），它与构造函数名称相匹配。宿主对象也包含有意义的“类属性”，但这和具体的JavaScript实现有关。通过对象直接量和Object.create创建的对象的类属性是“Object”，那些自定义构造函数创建的对象也是一样，类属性也是“Object”，因此对于自定义的类来说，没办法通过类属性来区分对象的类：
```javascript
classof(null)//=> "Null"
classof(1)//=> "Number"
classof("")//=> "String"
classof(false)//=> "Boolean"
classof({})//=> "Object"
classof([])//=> "Array"
classof(/./)//=> "Regexp"
classof(new Date())//=> "Date"
classof(window)//=> "Window"(这是客户端宿主对象)
function f() {};//定义一个自定义的构造函数
classof(new f());//=> "Object"
```

**6.8.3可扩展性**

对象的可扩展性用以表示是否可以给对象添加新属性。所有内置对象和自定义对象都是显式可扩展的，宿主对象的可扩展性是由JavaScript引擎定义的。在ECMAScript5中，所有的内置对象和自定义对象都是可扩展的，除非将它们转换为不可扩展的，同样，宿主对象的可扩展性也是由实现ECMAScript5的JavaScript引擎定义的。

ECMAScript5定义了用来查询和设置对象可扩展性的函数。通过将对象传入Object.esExtensible()，来判断该对象是否是可扩展的。如果想将对象转换为不可扩展的，需要调用Object.preventExtensions(),将待转换的对象作为参数传进去。注意，一旦将对象转换为不可扩展的，就无法再将其转换回可扩展的了。同样需要注意的是，preventExtensions()只影响到对象本身的可扩展性。如果给一个不可扩展的对象的原型添加属性，这个不可扩展的对象同样会继承这些新属性。

可扩展属性的目的是将对象“锁定”，以避免外界的干扰。对象的可扩展性通常和属性的可配值性与可写性配合使用，ECMAScript5定义的一些函数可以更方便地设置多种属性。

Object.seal()和Object.preventExtensions()类似，除了能够将对象设置为不可扩展的，还可以将对象的所有自有属性都设置为不可配置的。也就是说，不能给这个对象添加新属性，而且它已有的属性也不能删除或配置，不过它已有的可写属性依然可以设置。可于那些已经封闭（sealed）起来的对象是不能解封的。可以使用Object.isSealed()来检测对象是否封闭。

Object.freeze()将更严格地锁定对象——“冻结”（frozen）。除了将对象设置为不可扩展和将其属性设置为不可配置的之外，还可以将它自有的所有数据属性设置为只读（如果对象的存取器属性具有setter方法，存取器属性将不受影响，仍可以通过给属性赋值调用它们）。使用Object.isFrozen()来检测对象是否冻结。

Object.preventExtensions()、Object.seal()和Object.freeze()都返回传入的对象，也就是说，可以通过函数嵌套的方式调用它们：
```javascript
//创建一个封闭对象，包括一个冻结的原型和一个不可枚举的属性
var o = Object.seal(Object.create(Object.freeze({x:1}),{y:{value:2, writable:true}})):
```

**6.9序列化对象**

对象序列化（serialization）是指将对象的状态转换为字符串，也可将字符串还原为对象。ECMAScript5提供了内置函数JSON.stringify()和JSON.parse()用来序列化和还原JavaScript对象。这些方法都使用JSON作为数据交换格式，JSON的全称是“JavaScript-Object-Notation”——javascript对象表示法，它的语法和JavaScript对象与数组直接量的语法非常相近：
```javascript
o = {x:1, y:{z:[false,null,""]}};//定义一个测试对象
s = JSON.stringify(o);//s是 '{x:1, y:{z:[false,null,""]}}'
p = JSON.parse(s);//p是o的深拷贝
```

```
ECMAScript5中的这些函数的本地实现和http://json.org/json2.js中的公共域ECMAScript3版本的实现非常类似，或者说完全一样，因此可以通过引入json2.js模块在ECMAScript3的环境中使用ECMAScript5中的这些函数。
```   

json的语法是JavaScript语法的子集，它并不能表示JavaScript里的所有值。支持对象、数组、字符串、无穷大数字、true、false和null，并且它们可以序列化和还原。NaN、Infinity和-Infinity序列化的结果是null，日期对象序列化的结果是ISO格式的日期字符串（参照Date.toJSON()函数），但JSON.parse()依然保留它们的字符串形态，而不会将它们还原为原始日期对象。函数、RegExp、Error对象和undefined值不能序列化和还原。JSON.stringify()只能序列化对象可枚举的自有属性。对于一个不能序列化的属性来说，在序列化后的输出字符串中会将这个属性省略掉。JSON.stringify()和JSON.parse()都可以接收第二个可选参数，通过传入需要序列化或还原的属性列表来定制自定义的序列化或还原操作。第三部分有关于这些函数的详细文档。

**6.10对象方法**

上文已经讨论过，所有的JavaScript对象都从Object.prototype继承属性（除了那些不通过原型显式创建的对象）。这些继承属性主要是方法，因为JavaScript程序员普遍对继承方法更感兴趣。我们已经讨论过hasOwnProperty()、propertyIsEnumerable()和isPrototypeOF()这三个方法，以及在Object构造函数里定义的静态函数Object.create()和Object.getPrototypeOf()等。这节将对定义在Object.prototype里的对象方法展开讲解，这些方法非常好用而且使用广泛，但一些特定的类会重写这些方法。

**6.10.1 toString()方法**

toString()方法没有参数，它将返回一个表示调用这个方法的对象值的字符串。在需要将对象转换为字符串的时候，JavaScript都会调用这个方法。比如，当使用“+”运算符连接一个字符串和一个对象时或者在希望使用字符串的方法中使用了对象时都会调用toString()。

默认的toString()方法的返回值带有的信息量很少（尽管它在检测对象的类型时非常有用，参照6.8.2），例如，下面这行代码的计算结果为字符串“[object Object]”：
```javascript
var s = {x:1, y:1}.toString();
```

由于默认的toString()方法并不会输出很多有用的信息。因此很多类都带有自定义的toString()。例如，当数组转换为字符串的时候，结果是一个数组元素列表，只是每个元素都转换成了字符串，再比如，当函数转换为字符串的时候，得到函数的源代码。第三部分有关于toString()的详细文档说明，比如Array.toString()、Date.toString()以及Function.toString()。

9.3.6节介绍如何给自定义类重写toString()方法。

**6.10.2 toLocaleString()方法**

除了基本的toString()方法之外，对象都包含toLocaleString()方法，这个方法返回一个表示这个对象的本地化字符串。Object中默认的toLocaleString()方法并不做任何本地化自身的操作，它仅调用toString()方法并返回对应值。Date和Numer类对toLocaleString()做了定制，可以用它对数字、日期和时间做本地化的转换。Array类的toLocaleString()方法和toString()方法很像，唯一的不同是每个数组元素会调用toLocaleString()方法转换为字符串，而不是调用各自的toString()方法。

**6.10.3 toJSON()方法**

Object.prototype实际上没有定义toJSON()方法，但对于需要执行序列化的对象来说，JSON.stringify()方法会调用toJSON()方法。如果在待序列化的对象中存在这个方法，则调用它，返回值即是序列化的结果，而不是原始的对象。具体示例参加Date.toJSON()。

**6.10.4 valueOf()方法**

valueOf()方法和toString()方法非常类似，但往往当JavaScript需要将对象转换为某种原始值而非字符串的时候才会调用它，尤其是转换为数字的时候。如果在需要使用原始值的上下文中使用了对象，JavaScript就会自动调用这个方法。默认的valueOf()方法不足为奇，但有些内置类自定义了valueOf()方法（比如Date.valueOf()），9.6.3节讨论如何给自定义对象类型定义valueOf()方法。

第7章 数组
----------

数组是值的有序集合。每个值叫做一个元素，而每个元素在数组中有一个位置，以数字表示，称为索引。JavaScript数组是无类型的：数组元素可以是任意类型，并且同一个数组中的不同元素也可能有不同的类型。数组的元素甚至也可能是对象或其他数组，这允许创建复杂的数据结构，如对象的数组和数组的数组。JavaScript数组的索引是基于零的32位数值：第一个索引是0，最大可能的索引为4294967294（2的32次方减去2），数组最大能容纳4294967295个元素。JavaScript数组是动态的，根据需要它们会增长或缩减，并且在创建数组时无须声明一个固定的大小或者在数组大小变化时无须重新分配空间。JavaScript数组可能是稀疏的：数组元素的索引不一定是连续的，它们之间可以有空缺。每个JavaScript数组都有一个length属性。针对非稀疏数组，该属性就是数组元素的个数。针对稀疏数组，length比所有元素索引要大。

JavaScript数组是JavaScript对象的特殊形式，数组索引实际上和碰巧是整数的属性名差不多。我们将在本章的其他地方更多地讨论特殊化的数组。通常，数组的实现是经过优化的，用数字索引来访问数组元素一般来说比访问常规的对象属性要快很多。

数组继承自Array.prototype中的属性，它定义了一套丰富的数组操作方法，7.8节和7.9节涵盖这方面的内容。大多数这些方法是通用的，这意味着它们不仅对真正的数组有效，而且对“类数组对象”同样有效。7.11节讨论类数组对象。在ECMAScript5中，字符串的行为与字符数组类似，我们将在7.12节讨论。

**7.1创建数组**

使用数组直接量是创建数组最简单的方法，在方括号中将数组元素用逗号隔开即可。例如：
```javascript
var empty = [];//没有元素的数组
var primes = [2, 3, 5, 7, 11];//有5个数值的数组
var misc = [1.1, true, "a" ,]//3个不同类型的元素和结尾的逗号
```

数组直接量中的值不一定要是常量：它们可以是任意的表达式：
```javascript
var base = 1024;
var table = [base, base+1, base+2, base+3]; 
```

它可以包含对象直接量或其他数组直接量：
```javascript
var b = [[1,{x:1,y:2}],[2,{x:3,y:4}]];
```

如果省略数组直接量中的某个值，省略的元素将被赋予undefined值：
```javascript
var count = [1,,3];//数组有3个元素，中间的那个元素值为undefined
var undefs =  [,,];//数组有2个元素，都是undefined
```
数组直接量的语法允许有可选的结尾的逗号，故[,,]只有两个元素而非三个。

调用构造函数Array()是创建数组的另一种方法。可以用三种方式调用构造函数。

* 调用时没有参数：

```javascript
var a = new Array();
```

该方法创建一个没有任何元素的空数组，等同于数组直接量[]。

* 调用时有一个数值参数，它指定长度：

```javascript
var a = new Array(10);
```

该技术创建指定长度的数组。当预先知道所需要元素个数时，这种形式的Array()构造函数可以用来预分配一数组空间。注意，数组中没有存储值，甚至数组的索引属性“0”、“1”等还没未定义。

* 显式指定两个或多个数组元素或者数组的一个非数值元素：

```javascript
var a = new Array(5,4,3,2,1,"testing, testing");
```
以这种形式，构造函数的参数将会成为新数组的元素。使用数组字面量比这样使用Array()构造函数要简单多了。

**7.2数组元素的读和写**

使用[]操作符来访问数组中的一个元素。数组的引用位于方括号的左边。方括号中是一个返回非负整数值的任意表达式。使用该语法既可以读又可以写数组的一个元素。因此，如下代码都是合法的JavaScript语句：
```javascript
var a = ["world"];//从一个元素的数组开始
var value = a[0];//读第0个元素
a[1] = 3.14;//写第1个元素
i = 2;
a[i] = 3;//写第2个元素
a[i + 1] = "hello";//写第3个元素
a[a[i]] = a[0];//读第0个和第2个元素，写第3个元素
```

请记住，数组是对象的特殊形式。使用方括号访问数组元素就像使用方括号访问对象的属性一样。JavaScript将指定的数字索引值转换成字符串——索引值1变成“1”——然后将其作为属性名来使用。关于索引值从数字转换为字符串没什么特别之处：对常规对象也可以这么做：
```javascript
o = {};//创建一个普通的对象
o[1] = "one";//用一个整数来索引它
```

数组的特别之处在于，当使用小于2的32次方非负整数作为属性名时数组会自动维护其length属性值。如上，创建仅有一个元素的数组。然后在索引1、2和3处分别进行赋值。当我们这么做时数组的length属性值变为：
```javascript
a.length //=>4
```

清晰地区分数组的索引和对象的属性名是非常有用的。所有的索引都是属性名，但只有在0~2的32次方减2之间的整数属性名才是索引。所有数组都是对象，可以为其创建任意名字的属性。但如果使用的属性是数组的索引，数组的特殊行为就是将根据需要更新它们的length属性名。

注意，可以使用负数或非整数来索引数组。这种情况下，数值转换为字符串，字符串作为属性名来用。既然名字不是非负整数，它就只能当做常规的对象属性，而非数组的索引。同样，如果凑巧使用了是非负整数的字符串，它就当做数组索引，而非对象属性。当使用一个浮点数和一个整数相等时情况也是一样的：
```javascript
a[-1.23] = true;//这将创建一个名为“-1.23”的属性
a["1000"] = 0;//这是数组的第1001个元素
a[1.000] //和a[1]相等
```

事实上，数组索引仅仅是对象属性名的一种特殊类型，这意味着JavaScript数组没有“越界”错误的概念。当试图查询任何对象中不存在的属性时，不会报错，只会得到undefined值。类似于对象，对于数组同样存在这种情况。

既然数组是对象，那么它们可以从原型中继承元素。在ECMAScript5中，数组可以定义元素的getter和setter方法（见6.6节）。如果一个数组确实继承了元素或使用了元素的getter和setter方法，你应该期望它使用非优化的代码路径：访问这种数组的元素的时间会与常规对象属性的查找时间相近。

**7.3稀疏数组**

稀疏数组是包含从0开始的不连续索引的数组。通常，数组的length属性值代表数组中元素的个数。如果数组是稀疏的，length属性值大于元素的个数。可以用Array()构造函数或简单地指定数组的索引值大于当前的数组长度来创建稀疏数组：
```javascript
a = new Array(5);//数组没有元素，但是a.length是5
a = [];//创建一个空数组，length是0
a[1000] = 0;//赋值添加一个元素，但是设置length为1001；
```

后面会看到你也可以用delete操作符来生产稀疏数组。
足够稀疏的数组通常在实现上比稠密的数组更慢，内存利用率更高，在这样的数组中查找元素的时间与常规对象属性的查找时间一样长。

注意，当在数组直接量中省略值时不会创建稀疏数组。省略的元素在数组中是存在的，其值为undefined。这和数组元素根本不存在是有一些微妙的区别的。可以用in操作符检测两者之间的区别：
```javascript
var a1 = [,,,];//数组是[undefined,undefined,undefined]
var a2 = new Array(3);//该数组根本没有元素
0 in a1;//=>true a1在索引0处有一个元素
0 in a2;//=>false a2在索引0处没有元素
```

当使用for/in循环时，a1和a2之间的区别也很明显（7.6节）。
需要注意的是，当省略数组直接量中的值时（使用连续的逗号，比如[1,,3]）,这时多得到的数组也是稀疏数组，省略掉的值是不存在的：
```javascript
var a1 = [,];//此数组没有元素，长度是1
var a2 = [undefined];//此数组包含一个值为undefined的元素
0 in a1;//=> false a1在索引0处没有元素
0 in a2;//=> true a2在索引0处有一个值为undefined的元素
```
在一些旧版本的实现中（比如firefox3），在存在连续逗号的情况下，插入undefined值的操作则与此不同，在这些实现中，[1,,3]和[1,undefined,3]是一模一样的。

TODO：ECMAscript6有了变动

了解稀疏数组是了解JavaScript数组的真实本质的一部分。尽管如此，实际上你所碰到的绝大多数JavaScript数组不是稀疏数组。并且，如果你确定碰到了稀疏数组，你的代码很可能像对待非稀疏数组一样对待它们，只不过它们包含一些undefined的值。

**7.4数组长度**

每个数组有一个length属性，就是这个属性使其区别于常规的JavaScript对象。针对稠密（也就是非稀疏）数组，length属性值代表数组中元素的个数。其值比数组中最大的索引大1：
```javascript
[].length //=>0 数组没有元素
['a','b','c'].length //=>3 最大的索引为2，length为3
```

当数组是稀疏时，length属性值大于元素的个数。而且关于此我们可以说的一切也就是数组长度保证大于它每个元素的索引值。或者，换一种说法，在数组中（无论稀疏与否）肯定找不到一个元素的索引值大于或等于它的长度。为了维持此规则不变化，数组有两个特殊行为。第一个如同上面的描述：如果为一个数组元素赋值，它的索引i大于或等于现有数组的长度时，length属性的值将设置为i+1;

第二个特殊的行为就是设置length属性为一个小于当前长度的非负整数n时，当前数组中那些索引值大于或等于n的元素将从中删除：
```javascript
a = [1,2,3,4,5];//从第5个元素的数组开始
a.length = 3;//现在a为[1,2,3]
a.length = 0;//删除所有的元素。a为[]
a.length = 5;//长度为5，但是没有元素，就像new Array(5)
```

还可以将数组的length属性值设置为大于其当前的长度。实际上这不会向数组中添加新的元素，它只是在数组尾部创建一个空的区域。
在ECMAScript5中，可以用Object.defineProperty()让数组的length属性变成只读的（见6.7节）：
```javascript
a = [1,2,3];//从3个元素的数组开始
Object.defineProperty(a,"length",{writable:false});//让length属性只读
a.length = 0;//a不会改变
```

类似地，如果让一个数组元素不可配置，就不能删除它。如果不能删除它，length属性不能设置为小于不可配置元素的索引值。（见6.7节和6.8.3节的Object.seal()和Object.freeze()方法。）

**7.5数组元素的添加和删除**

我们已经见过添加数组元素最简单的方法：为新索引赋值。
```javascript
a = [];//开始是一个空数组
a[0] = "zero";//然后向其中添加元素
a[1] = "one";
```

也可以用push()方法在数组末尾增加一个或多个元素：
```javascript
a = [];//开始是一个空数组
a.push("zero");//在末尾添加一个元素 a = ["zero"]
a.push("one","two");//再添加两个元素 a = ["zero","one","two"]
```
在数组尾部压入一个元素与给数组a[a.length]赋值是一样的。可以使用unshift()方法（在7.8节有描述）在数组的首部插入一个元素，并且将其他元素依次移到更高的索引处。

可以像删除对象属性一样使用delete运算符来删除数组元素：
```javascript
a = [1,2,3];
delete a[1];//a在索引1的位置不再有元素
1 in a      //=> false 数组索引1并未在数组中定义
a.length    //=> 3 delete操作并不影响数组长度
```

删除数组元素与为其赋值undefined值是类似的（但有一些微妙的区别）。注意，对一个数组元素使用delete不会修改数组的length属性，也不会将元素从高索引处移下来填充已删除属性留下的空白。如果从数组中删除一个元素，它就变成稀疏数组。

上面我们看到，也可以简单地设置length属性为一个新的期望长度来删除数组尾部的元素。数组有pop()方法（它和push()一起使用），后者一次使减少长度1并返回被删除元素的值。还有一个shift()方法（它和unshift()一起使用），从数组头部删除一个元素。和delete不同的是shift()方法将所有元素下移到比当前索引低1的地方。7.8节和第三部分涵盖pop()和shift()的内容。

最后，splice()是一个通用的方法来插入、删除或替换数组元素。它会根据需要修改length属性并移动元素到更高或更低的索引处。详细见7.8节。

**7.6数组遍历**

使用for循环（见5.5.3节）是遍历数组元素最常见的方法：
```javascript
var keys = Object.keys(o);//获得o对象属性名组成的数组
var values = [];//数组中存储匹配属性的值
for (var i = 0; i< keys.length; i++){//对于数组中每个索引
    var key = keys[i];//获得索引处的键值    
    values[i] = o[key];//在values数组中保存属性值
}
```

在嵌套循环或其他性能非常重要的上下文中，可以看到这种基本的数组遍历需要优化，数组的长度应该只查询一次而非每次循环都要查询：
```javascript
for(var i =0, len = keys.length; i < len; i++){
    //循环体仍然不变
}
```

这些例子假设数组是稠密的，并且所有的元素都是合法数据。否则，使用数组元素之前应该先检测它们。如果想要排除null、undefined和不存在的元素，代码如下：
```javascript
for (var i = 0 ;i < a.length; i++){
    if(!a[i]) continue;//跳过null、undefined和不存在的元素
    //循环体
}
```

如果只想跳过undefined和不存在的元素，代码如下：
```javascript
for(var i = 0; i<a.length; i++){
    if(a[i] === undefined) continue;//跳过undefined和不存的元素
    //循环体
}
```

最后，如果只想跳过不存在的元素而仍然要处理存在的undefined元素，代码如下：
```javascript
for(var i = 0; i < a.length; i++){
    if(!(i in a)) continue;//跳过不存在的元素
    //循环体
}
```

还可以使用for/in循环（见5.5.4节）处理稀疏数组。循环每次将一个可枚举的属性名（包括数组索引）赋值给循环变量。不存在的索引将不会遍历到：
```javascript
for(var index in sparseArray){
    var value = sparseArray[index];
    //此处可以使用索引和值做一些事情
}
```

在6.5节已经注意到for/in循环能够枚举继承的属性名，如添加Array.prototype中的方法。由于这个原因，在数组上不应该使用for/in循环，除非使用额外的检测方法来过滤不想要的属性。如下检测代码取其一即可：
```javascript
for (var i in o){
    if(!a.hasOwnProperty(i)) continue;//跳过继承的属性
    //循环体
}
for (var i in a){
    //跳过不是非负整数的i
    if(String(Math.floor(Math.abs(Number(i)))) !== i) continue;
}
```

ECMAScript规范允许for/in循环以不同的顺序遍历对象的属性。通常数组元素的遍历实现是升序的，但不能保证一定是这样的。特别地，如果数组同时拥有对象属性和数组元素，返回的属性名很可能是按照创建的顺序而非数值的大小顺序。如何处理这个问题的实现各不相同，如果算法依赖于遍历的顺序，那么最好不要使用for/in而用常规的for循环。

ECMAScript5定义了一些遍历数组元素的新方法，按照索引的顺序挨个传递给定义的一个函数。这些方法中最常用的就是forEach()方法：
```javascript
var data = [1,2,3,4,5];//这是需要遍历的数组
var sumOfSquares = 0;//要得到数据的平方和
data.forEach(function(x){//把每个元素传递给此函数
    sumOfSquares += x*x;//平方相加
})；
sumOfSquares //=>55 1+4+9+16+25
```
forEach()和相关的遍历方法使得数组拥有简单而强大的函数式编程风格。它们涵盖在7.9节中，当涉及函数式编程时，还将在8.8节再次碰到它们。

**7.7多维数组**

JavaScript不支持真正的多维数组，但可以用数组的数组来近似。访问数组的数组中的元素，只要简单地使用两次[]操作符即可。

例如，假设变量matrix是一个数组的数组，它的基本元素是数值，那么matrix[x]的每个元素是包含一个数值数组，访问数组中特定数值的代码为matrix[x][y]。这里有一个具体的例子，它使用二维数组作为一个九九乘法表：
```javascript
//创建一个多维数组
var table = new Array(10);//表格有10行
for(var i = 0; i < table.length; i++)
table[i] = new Array(10);//每行有10列
//初始化数组
for(var row = 0; row < table.length; row++){
    for(col = 0; col < table[row].length; col++){
        table[row][col] = row*col;
    }
}
//使用多维数组来计算（查询）5*7
var product = table[5][7];//35
```

**7.8数组方法**

ECMAScript3在Array.prototype中定义了一些很有用的操作数组的函数，这意味着这些函数作为任何数组的方法都是可用的。下面几节介绍ECMAScript3中的这些方法。像通常一样，完整的细节参见第四部分关于数组内容。ECMAScript5中新增加了一些新的数组遍历方法：它们涵盖在7.9节中。

**7.8.1join()**

Array.join()方法将数组中所有元素都转化为字符串并连接在一起，返回最后生成的字符串。可以指定一个可选的字符串在生成的字符串中来分隔数组中的各个元素。如果不指定分隔符，默认使用逗号。如以下代码所示：
```javascript
var a = [1,2,3]//创建一个包含三个元素的数组
a.join();//=> "1,2,3"
a.join(" ")//=> "1 2 3"
a.join("");//=> "123"
var b = new Array(10);//长度为10的空数组
b.join('-');//=>'---------' 9个连字号组成的字符串
```
Array.join()方法是String.split()方法的逆向操作，后者是将字符串分割成若干块来创建一个数组。

**7.8.2reverse()**

Array.reverse()方法将数组中的元素颠倒顺序，返回逆序的数组。它采取了替换，换句话说，它不通过重新排列的元素创建新的数组，而是在原先的数组中重新排列它们。例如，下面的代码使用reverse()和join()方法生成字符串“3，2，1”：
```javascript
var a = [1,2,3];
a.reverse().join() //=> "3,2,1" 并且现在的a是[3,2,1]
```

**7.8.3sort()**

Array.sort()方法将数组中的元素排序并返回排序后的数组。当不带参数调用sort()时，数组元素以字母表顺序排序（如有必要将临时转化为字符串进行比较）：
```javascript
var a = new Array("banana","cherry","apple");
a.sort();
var s = a.join(", ");//s == "apple, banana, cherry"
```

如果数组包含undefined元素，它们会被排到数组的尾部。
为了按照其他方式而非字母表顺序进行数组排序，必须给sort()方法传递一个比较函数。该函数决定了它的两个参数在排好序的数组中的先后顺序。假设第一个参数应该在前，比较函数应该返回一个小于0的数值。反之，假设第一个参数应该在后，函数应该返回一个大于0的数值。并且，假设两个值相等（也就是说，它们的顺序无关紧要），函数应该返回0。因此，例如，用数值大小而非字母表顺序进行数组排序，代码如下：
```javascript
var a = [33, 4, 1111, 222];
a.sort();//字母表顺序：111，22，33，4
a.sort(function(a,b) {//数值排序 4，33，222，1111
    return a-b;//根据顺序，返回负数、0、正数
})
a.sort(function (a,b){return b-a});//数值大小相反的顺序
```
注意，这里使用匿名函数表达式非常方便。既然比较函数只使用一次，就没必要给它们命名了。

另外一个数组元素排序的例子，也许需要对一个字符串数组执行不区分大小写的字母表排序，比较函数首先将参数都转化为小写字符串（使用toLowerCase()方法），再开始比较：
```javascript
a = ['ant', 'Bug', 'cat', 'Dog'];
a.sort();//区分大小写的排序，['Bug','Dog','ant','cat']
a.sort(function(s,t){//不区分大小写的排序
    var a = s.toLowerCase();
    var b = t.toLowerCase();
    if(a < b) return -1;
    if(a > b) return 1;
    return 0;
});//=> ['ant','Bug','cat','Dog']
```

**7.8.4concat()**

Array.concat()方法创建并返回一个新数组，它的元素包括调用concat()的原始数组的元素和concat()的每个参数。如果这些参数中的任何一个自身是数组，则连接的是数组的元素，而非数组本身。但要注意，concat()不会递归扁平化数组的数组。concat()也不会修改调用的数组。下面有一些示例：
```javascript
var a = [1,2,3];
a.contact(4,5);//返回[1,2,3,4,5]
a.contact([4,5]);//返回[1,2,3,4,5]
a.contact([4,5],[6,7]);//返回[1,2,3,4,5,6,7]
a.contact(4,[5,[6,7]]);//返回[1,2,3,4,5,[6,7]]
```

**7.8.5 slice()**

Array.slice()方法返回指定数组的一个片段或子数组。它的两个参数分别指定了片段的开始和结束的位置。返回的数组包含第一个参数指定的位置和所有到但不含第二个参数指定的位置之间的所有数组元素。如果只指定一个参数，返回的数组将包含从开始位置到数组结尾的所有元素。如参数中出现负数，它表示相对于数组中最后一个元素的位置。例如，参数-1指定了最后一个元素，而-3指定了倒数第三个元素。注意，slice()不会修改调用的数组。下面有一些示例：
```javascript
var a = [1,2,3,4,5];
a.slice(0,3);//返回[1,2,3]
a.slice(3);//返回[4,5]
a.slice(1,-1);//返回[2,3,4]
a.slice(-3,-2);//返回[3]
```

**7.8.6 splice()**

Array.splice()方法是在数组中插入或删除元素的通用方法。不同于slice()和concat()，splice()会修改调用的数组。注意，splice()和slice()拥有非常相似的名字，但它们的功能却有本质的区别。

splice()能够从数组中删除元素、插入元素到数组中或者同时完成这两种操作。在插入或删除点之后的数组元素会根据需要增加或减小它们的索引值，因此数组的其他部分任然是保持连续的。splice()的第一个参数指定了插入和（或）删除的起始位置。第二个参数指定了应该从数组中删除的元素的个数。如果省略第二个参数，从起始点开始到数组结尾的所有元素都将被删除。splice()返回一个由删除元素组成的数组，或者如果没有删除元素就返回一个空数组。例如：
```javascript
var a = [1,2,3,4,5,6,7,8];
a.splice(4);//返回[5,6,7,8]; a是[1,2,3,4]
a.splice(1,2);//返回[2,3]; a是[1,4]
a.splice(1,1);//返回[4]; a是[1]
```

splice()的前两个参数指定了需要删除的数组元素。紧随其后的任意个数的参数指定了需要插入到数组中的元素，从第一个参数指定的位置开始插入。例如：
```javascript
var a = [1,2,3,4,5];
a.splice(2,0,'a','b');//返回[]; a是[1,2,'a','b',3,4,5]
a.splice(2,2,[1,2],3);//返回['a','b']; a是[1,2,[1,2],3,3,4,5]
```
注意，区别于concat(),splice()会插入数组本身而非数组的元素。

**7.8.7push()和pop()**

push()和pop()方法允许将数组当做栈来使用。push()方法在数组的尾部添加一个或多个元素，并返回数组新的长度。pop()方法则相反：它删除数组的最后一个元素，减小数组长度并返回它删除的值。注意，两个方法都修改并替换原始数组而非生成一个修改版的新数组。组合使用push()和pop()能够用JavaScript数组实现先进后出的栈。例如：
```javascript
var stack = [];//stack: []
stack.push(1,2);//stack: [1,2] 返回2
stack.pop();//stack: [1] 返回2
stack.push(3);//stack: [1,3] 返回2
stack.pop();//stack: [1] 返回3
stack.push([4,5]);//stack: [1,[4,5]] 返回2
stack.pop();//stack: [1] 返回[4,5]
stack.pop();//stack: [] 返回1
```

**7.8.8unshift()和shift()**

unshift()和shift()方法的行为非常类似于push()和pop()，不一样的是前者是在数组的头部而非尾部进行元素的插入和删除操作。unshift()在数组的头部添加一个或多个元素，并将已存在的元素移动到更高索引的位置来获得足够的空间，最后返回数组新的长度，shift()删除数组的第一个元素并将其返回，然后把所有随后的元素下移一个位置来填补数组头部的空缺。例如：
```javascript
var a = []; // a:[]
a.unshift(1);//a:[1]
a.unshift(22);//
a.shift();//
a.unshift(3,[4,5]);//
a.shift();//
a.shift();//
a.shift();//
```
注意，当使用多个参数调用unshift()时它的行为令人惊讶。参数是一次性插入的（就像splice（）方法）而非一次一个地插入。这意味着最终的数组中插入的元素的顺序和它们在参数列表中的顺序一致。而假如元素是一次一个地插入，它们的顺序应该是反过来的。

**7.8.9toString()和toLocaleString()**

数组和其他javascript对象一样拥有toString()方法。针对数组，该方法将其每个元素转化为字符串（如有必要将调用元素的toString()方法）并且输出用逗号分隔的字符串列表。注意，输出不包括方括号或其他形式的包裹数组值的分隔符。例如：
```javascript
[1,2,3].toString()//
["a","b","c"].toString()//
[1,[2,'c']].toString()//
```
注意，这里与不使用任何参数调用join()方法返回的字符串是一样的。
toLocaleString()是toString()方法的本地化版本。它调用元素的toLocaleString()方法将每个数组元素转化为字符串，并且使用本地化（和自定义实现的）分隔符将这些字符串连接起来生成最终的字符串。

**7.9ecmascript5中的数组方法**

ECMAScript5定义了9个新的数组方法来遍历、映射、过滤、检测、简化和搜素数组。下面几节描述了这些方法。
但在开始详细介绍之前，很有必要对ECMAScript5中的数组方法做一个概述。首先，大多数方法的第一个参数接收一个函数，并且对数组的每个元素（或一些元素）调用一次该函数。如果是稀疏数组，对不存在的元素不调用传递的函数。在大多数情况下，调用提供的函数使用三个参数：数组元素、元素的索引和数组本身。通常，只需要第一个参数值，可以忽略后两个参数。大多数ECMAScript5数组方法的第一个参数是一个函数，第二个参数是可选的。如果有第二个参数，则调用的函数被看做是第二个参数的方法。也就是说，在调用函数时传递进去的第二个参数作为它的this关键字的值来使用。被调用的函数的返回值非常重要，但是不同的方法处理返回值的方式也不一样。ECMAScript5中的数组方法都不会修改它们调用的原始数组。当然，传递给这些方法的函数是可以修改这些数组的。

**7.9.1forEach()**

forEach()方法从头至尾遍历数组，为每个元素调用指定的函数。如上所述，传递的函数作为forEach()的第一个参数。然后forEach()使用三个参数调用该函数：数组元素、元素的索引和数组本身。如果只关心数组元素的值，可以编写只有一个参数的函数——额外的参数将忽略：
```javascript
var data = [1,2,3,4,5];//
//计算数组元素的值
var sum = 0;//
data.forEach(function(value){sum +=value});//
sum //
//每个数组元素的值自加1
data.forEach(function(v,i,a){a[i]=v+1;});
data//
```
注意，forEach()无法在所有元素都传递给调用的函数之前终止遍历。也就是说，没有像for循环中使用的相应的break语句。如果要提前终止，必须把forEach()方法放在一个try块中，并能抛出一个异常，如果forEach()调用的函数抛出foreach.break异常，循环会提前终止：
```javascript
function foreach(a,f,t) {
    try {a.forEach(f,t);}
    catch(e) {
        if(e === foreach.break) return;
        else throw e;
    }
}
foreach.break = new Error("StopIteration");
```

**7.9.2map()**

map()方法将调用的数组的每个元素传递给指定的函数，并返回一个数组，它包含该函数的返回值。例如：
```javascript
a = [1,2,3];
b = a.map(function(x){return x*x});// b是[1,4,9]
```
传递给map()的函数的调用方式和传递给forEach()的函数的调用方式一样。但传递给map()的函数应该有返回值。注意，map()返回的是新数组，它不修改调用的数组。如果是稀疏数组，返回的也是相同方式的稀疏数组：它具有相同的长度，相同的缺失元素。

**7.9.3filter()**

filter()方法返回的数组元素是调用的数组的一个子集。传递的函数是用来逻辑判定的：
该函数返回true或false。调用判定函数就像调用forEach()和map()一样。如果返回值为true或能转化为true的值，那么传递给判定函数的元素就是这个子集的成员，它将被添加到一个作为返回值的数组中。例如：
```javascript
a = [5,4,3,2,1];
smallvalues = a.filter(function(x){return x < 3});//
everyother = a.filter(function(x,i){return i%2 ==0});//
```
注意，filter()会跳过稀疏数组中缺少的元素，它的返回数组总是稠密的。为了压缩稀疏数组的空缺，代码如下：

    var dense = sparse.filter(function(){return true}):
    
甚至，压缩空缺并删除undefined和null元素，可以这样使用filter():

    a = a.filter(function(x){return x !== undefined && x != null;});

**7.9.4every()和some()**

every()和some()方法是数组的逻辑判定：它们对数组元素应用指定的函数进行判定，返回true或false。
every()方法就像数学中的“针对所有”的量词：当且仅当针对数组中的所有元素调用判定函数都返回true，它才返回true：
```javascript
a = [1,2,3,4,5];
a.every(function(x){return x < 10})//=>true 所有的值<10
a.every(function(x){return x % 2 === 0})//=>false 不是所有的值都是偶数
```
some()方法就像数学中的“存在”的量词：当数组中至少有一个元素调用判定函数返回true，它就返回true：并且当且仅当数值中的所有元素调用判定函数都返回false，它才返回false：
```javascript
a = [1,2,3,4,5];
a.some(function(x){return x%2 ===0;})//=> true a含有偶数值
a.some(isNaN)//=> false a不包含非数值元素
```
注意，一旦every()和some()确认该返回什么值它们就会停止遍历数组元素。some()在判定函数第一次返回true后就返回true，但如果判定函数一直返回false，它就会遍历整个数组。every恰好相反：它在判定函数第一次返回false后就返回false，但如果判定函数一直返回true，它将会遍历整个数组。注意，根据数学上的惯例，在空数组上调用时，every()返回true，some()返回false。

**7.9.5 reduce()和reduceRight()**

reduce()和reduceRight()方法使用指定的函数将数组元素进行组合，生成单个值。这在函数式编程中是常见的操作，也可以称为“注入”和“折叠”。举例说明它是如何工作的：
```javascript
var a = [1,2,3,4,5]
var sum = a.reduce(function(x,y) { return x+y }, 0);//数组求和
var product = a.reduce(function(x,y) { return x*y }, 1);//数组求积
var max = a.reduce(function(x,y) { return (x>y)?x:y; });//求最大值
```
reduce()需要两个参数。第一个是执行化简操作的函数。化简函数的任务就是用某种方法把两个值组合或化简为一个值，并返回化简后的值。在上述例子中，函数通过加法、乘法或取最大值的方法组合两个值。第二个（可选）的参数是一个传递给函数的初始值。

reduce()使用的函数与forEach()和map()使用的函数不同。比较熟悉的是，数组元素、元素的索引和数组本身将作为第2~4个参数传递给函数。第一个参数是到目前为止的化简操作累积的结果。第一次调用函数时，第一个参数是一个初始值，它就是传递给reduce()的第二个参数。在接下来的调用中，这个值就是上一次化简函数的返回值。在上面的第一个例子中，第一次调用化简函数时的参数是0和1。将两者相加并返回1.再次调用时的参数是1和2，它返回3。然后它计算3+3=6、6+4=10，最后计算10+5=15。最后的值是15，reduce()返回这个值。

可能已经注意到了，上面第三次调用reduce()时只有一个参数：没有指定初始值。当不指定初始值调用reduce()时，它将使用数组的第一个元素作为其初始值。这意味着第一次调用化简函数就使用了第一个和第二个数组元素作为其第一个和第二个参数。在上面求和与求积的例子中，可以省略初始值参数。

在空数组上，不带初始值参数调用reduce()将导致类型错误异常。如果调用它的时候只有一个值——数组只有一个元素并且没有指定初始值，或者有一个空数组并且指定一个初始值——reduce()只是简单地返回那个值而不会调用化简函数。

reduceRight()的工作原理和reduce()一样，不同的是它按照数组索引从高到低（从右到左）处理数组，而不是从低到高。如果化简操作的优先顺序是从右到左，你可能想使用它，例如：
```javascript
var a = [2,3,4]
//计算2^(3^4)。乘方操作的优先顺序是从右到左
var big = a.reduceRight(function(accumulator,value){
    return Math.pow(value,accumulator);
});
```
注意，reduce()和reduceRight()都能接收一个可选的参数，它指定了化简函数调用时的this关键字的值。可选的初始值参数仍然需要占一个位置。如果想让化简函数作为一个特殊对象的方法调用，请参看Function.bind()方法。
值得注意的是，上面描述的every()和some()方法是一种类型的数组化化简操作。但是不同的是，它们会尽早终止遍历而不总是访问每一个数组元素。
为了简单起见，到目前位置所展示的例子都是数值的，但数学计算不是reduce()和reduceRight()的唯一意图。考虑一下例6-2中的union()函数。它计算两个对象的“并集”，并返回另一个新对象，新对象具有二者的属性。该函数期待两个对象并返回另一个对象，所以它的工作原理和一个化简函数一样，并且可以使用reduce()来把它一般化，计算任意数目的对象的“并集”。
```javascript
var objects = [{x:1}, {y:2}, {z:3}]
var merged = objects.reduce(union);//=> {x:1, y:2, z:3}
```
回想一下，当两个对象拥有同名的属性时，union()函数使用第一个参数的属性值。这样，reduce()和reduceRight()在使用union()时给出了不同的结果
```javascript
var objects = [{x:1,a:1},{y:2,a:2},{z:3,a:3}];
var leftunion = objects.reduce(union);//{x:1, y:2, z:3, a:1}
var leftunion = objects.reduceRight(union);//{x:1, y:2, z:3, a:3}
```

**7.9.6indexOf()和lastIndexOf()**

indexOF()和lastIndexOf()搜索整个数组中具有给定值的元素，返回找到的第一个元素的索引或者如果没有找到就返回-1。indexOf()从头至尾搜索，而lastIndexOf()则反向搜索。
```javascript
a = [0,1,2,1,0]
a.indexOf(1) //=>1 a[1]是1
a.lastIndexOf(1) //=>3 a[3]是1
a.indexOf(3) //=>-1 没有值为3的元素
```
不同于本节描述的其他方法，indexOf()和lastIndexOf()方法不接收一个函数作为其参数。第一个参数是需要搜索的值，第二个参数是可选的：它指定数组中的一个索引，从那里开始搜索。如果省略该参数，indexOf()从头开始搜索，而lastIndexOf()从末尾开始搜索。第二个参数也可以是负数，它代表相对数组末尾的偏移量，对于splice()方法：例如，-1指定数组的最后一个元素。

如下函数在一个数组中搜索指定的值并返回包含所有匹配的数组索引的一个数组。它展示了如何运用indexOf()的第二个参数来查找除了第一个以外匹配的值。
```javascript
//在数组中查找所有出现的x，并返回一个包含匹配索引的数组
function findall(a,x) {
    var results = [],//将会返回的数组
    len = a.length,//待搜索数组的长度
    pos = 0;//开始搜索的位置
    while(pos<len){//循环搜索多个元素
        pos = a.indexOf(x,pos);//搜索
        if(pos === -1) break;//未找到，就完成搜索
        results.push(pos);//否则，在数组中存储索引
        pos = pos + i;//并从下一个位置开始搜索
    }
    return results;//返回包含索引的数组
}
```
注意，字符串也有indexOf()和lastIndexOf()方法，它们和数组方法的功能类似。

**7.10数组类型**

我们在本章中到处都可以看见数组是具有特殊行为的对象。给定一个未知的对象，判定它是否为数组通常非常有用。在ECMASCript5中，可以使用Array.isArray()函数来做这件事：
```javascript
Array.isArray([])//=>true
Array.isArray({})//=>false
```
但是，在ECMAScript5以前，要区分数组和非数组对象却令人惊讶地困难。typeof操作符在这里帮不上忙：对数组它返回“对象”（并且对于除了函数以外的所有对象都是如此）。instanceof操作符只能用于简单的情形：
```javascript
[] instanceof Array //=>true
({}) instanceof Array //=>false
```
使用instanceof的问题是在web浏览器中有可能有多个窗口或窗体（frame）存在。每个窗口都有自己的javascript环境，有自己的全局对象。并且，每个全局对象有自己的一组构造函数。因此一个窗体中的对象将不可能是另外窗体中的构造函数的实例。窗体之间的混淆不常发生，但这个问题足已证明instanceof操作符不能视为一个可靠的数组检测方法。

解决方案是检查对象的类属性（见6.8.2节）。对数组而言该属性的值总是“Array”，因此在ECMASCript3中isArray()函数的代码可以这样书写：
```javascript
var isArray = function.isArray || function(o) {
    return typeof o === "Object" && Object.prototype.toString.call(o) === "[object Array]";
};
```
实际上，此处类属性的检测就是ECMAScript5中Array.isArray()函数所做的事情。获得对象类属性的技术使用了6.8.2节和例6-4中展示的Object.prototype.toString()方法。

**7.11类数组对象**

我们已经看到，javascript数组的有一些特性是其他对象所没有的：

* 当有新的元素添加到列表中时，自动更新length属性。
* 设置length为一个较小值将截断数组
* 从Array.prototype中继承一些有用的方法。
* 其类属性为“Array”

这些特性让javascript数组和常规的对象有明显的区别。但是它们不是定义数组的本质特性。一种常常完全合理的看法把拥有一个数值length属性和对应非负整数属性的对象看做一种类型的数组。

实践中这些“类数组”对象实际上偶尔出现，虽然不能在它们之上直接调用数组方法或者期望length属性有什么特殊的行为，但是仍然可以用针对真正数组遍历的代码来遍历它们。结论就是很多数组算法针对类数组对象工作得很好，就像针对真正的数组一样。如果算法把数组看成只读的或者如果它们至少保持数组长度不变，也尤其是这种情况。

以下代码为一个常规对象增加了一些属性使其变成类数组对象，然后遍历生成的伪数组的“元素”：
```javascript
var a = {};//从一个常规空对象开始
//添加一些属性，称为“类数组”
var i = 0;
while(i<10) {
    a[i] = i*i;
    i++;
}
a.length = i;
//现在，当做真正的数组遍历它
var total = 0;
for(var j = 0; j<a.length; j++){
    total += a[j];
}
```
8.3.2节描述的Arguments对象就是一个类数组对象。在客户端javascript中，一些DOM方法（如document.getElementsByTagName()）也返回类数组对象。下面有一个函数可以用来检测类数组对象：
```javascript
//判定o是否是一个类数组对象
//字符串和函数有length属性，但是它们
//可以用typeof检测将其排除。在客户端javascript中，DOM文本节点
//也有length属性，需要用额外判断o.nodeType != 3 将其排除
function isArrayLike(o) {
    if( o &&                                //o非null、undefined等
        typeof o === "object" &&            //o是对象
        isFinite(o.length)&&                //o.length是有限数值
        o.length >= 0 &&                    //o.length为非负值
        o.length === Math.floor(o.length) &&//o.length是整数
        o.length < 4294967296)              //o.lenght<2^32
        return true;                        //o是类数组对象
    else
        return false;                       //否则它不是
}
```
将在7.12节中看到在ECMAScript5中字符串的行为与数组类似（并且有些浏览器在ECMAScript5之前已经让字符串变成索引的了）。然而，类似上述的类数组对象的检测方法针对字符串常常返回false——它们通常最好当做字符串处理，而非数组。

javascript数组方法是特意定义为通用的，因此它们不仅应用在真正的数组而且在类数组对象上都能正确工作。在ECMAScript5中，所有数组方法都是通用的。在ECMAScript3中，除了toString()和toLocaleString()以外的所有方法也是通用的。（concat()方法是一个特例：虽然可以用在类数组对象上，但它没有将那个对象扩充进返回的数组中。）既然类数组对象没有继承自Array.prototype，那就不能在它们上面直接调用数组方法。尽管如此，可以间接地使用function.call方法调用：
```javascript
var a = {"0":"a", "1":"b", "2":"c", lenght:3};//类数组对象
Array.join(a,"+")
Array.slice(a,0)
Array.map(a,function(x){return x.toUpperCase();})
```
当用在类数组对象上时，数组方法的静态函数版本非常有用。但既然它们不是标准的，不能期望它们在所有的浏览器中都有定义。可以这样书写代码来保证使用它们之前是存在的：
```javascript
Array.join = Array.join || function (a,sep) {
    return Array.prototype.join.call(a,sep);
};
Array.slice = Array.slice || function (a,from,to) {
    return Array.prototype.slice.call(a,from,to);
};
Array.map = Array.map || function (a,f,thisArg) {
    return Array.prototype.map.call(a,f,thisArg);
};
```

**7.12作为数组的字符串**

在ECMAscript5（在众多最近的浏览器实现——包括IE8——早于ECMAScript5）中，字符串的行为类似于只读的数组。除了用charAt()方法来访问单个的字符以外，还可以使用方括号：
```javascript
var s = test;
s.charAt(0) //=>"t"
s[1] //=>"e"
```
当然，针对字符串的typeof操作符仍然返回“string”，但是如果给Array.isArray()传递字符串，它将返回false。

可索引的字符串的最大的好处就是简单，用方括号代替了charAt()调用，这样更加简洁、可读并且可能更高效。不仅如此，字符串的行为类似于数组的事实使得通用的数组方法可以应用到字符串上。例如：
```javascript
s = "javascript"
Array.prototype.join.call(s,"") //=>"J a v a S c r i p t"
Array.prototype.filter.call(s,  //过滤字符串中的字符
    function(x) {
    return x.match(/[^aeiou]/);//只匹配非元音字母
    }).join("") //=> "JvScrpt"
```
请记住，字符串是不可变值，故当把它们作为数组看待时，它们是只读的。如push()、sort()、reverse()和splice()等数组方法会修改数组，它们在字符串上是无效的。不仅如此，使用数组方法来修改字符串会导致错误：出错的时候没有提示。


