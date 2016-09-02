
第8章 函数
----------

函数是这样的一段JavaScript代码，它只定义一次，但可能被执行或调用任意次。你可能已经从诸如子例程（subroutine）或者过程（proceduew）这些名字里对函数的概念有所了解。JavaScript函数是参数化的：函数的定义会包括一个称为形参（patamer）的标识符列表，这些参数在函数体中像局部变量一样工作。函数调用会为形参提供实参的值。（参数有形参（parameter）和实参（argument）的区别，形参相当于函数中定义的变量，实参是在运行时的函数调用时传入的参数）函数使用它们实参的值来计算返回值，成为该函数调用表达式的值。除了实参之外，每次调用还会拥有另一个值——本次调用的上下文——这就是this关键字的值。

如果函数挂载在一个对象上，作为对象的一个属性，就称它为对象的方法。当通过这个对象来调用函数时，该对象就是此次调用的上下文（context），也就是该函数的this的值。用于初始化一个新创建的对象的函数称为构造函数（constructor）。6.1节会对构造函数有进一步的讲解，第9章还会再谈到它。

在JavaScript里，函数即对象，程序可以随意操控它们。比如，JavaScript可以把函数赋值给变量，或者作为参数传递给其他函数。因为函数就是对象，所以可以给它们设置属性，甚至调用它们的方法。

JavaScript的函数可以嵌套在其他函数中定义，这样它们就可以访问它们被定义时所处的作用域中的任何变量。这意味着JavaScript函数构成了一个闭包（closure），它给JavaScript带来了非常强劲的编程能力。

**8.1函数定义**

函数使用function关键字来定义，它可以用在函数定义表达式（见4.3节）或者函数声明语句（见5.3.2节）里。在两种形式中，函数定义都从function关键字开始，其后跟随这些组成部分：

* 函数名称标识符。函数名称是函数声明语句必需的部分。它的用途就像变量的名字，新定义的函数对象会赋值给这个变量。对函数定义表达式来说，这个名字是可选的：如果存在，该名字只存在于函数体中，并指代表函数对象本身。

* 一对圆括号，其中包含由0个或者多个用逗号隔开的标识符组成的列表。这些标识符是函数的参数名称，它们就像函数体中的局部变量一样。

* 一对花括号，其中包含0条或多条javascript语句。这些语句构成了函数体：一旦调用函数，就会执行这些语句。

例8-1分别展示了函数语句和表达式两种方式的函数定义。注意，以表达式来定义函数只适用于它作为一个大的表达式的一部分，比如在赋值和调用过程中定义函数：

例8-1：定义JavaScript函数
```javascript
//Print the name and value of each property of o.  Return undefined.
//输出o的每个属性的名称和值，返回undefined
function printprops(o) {
    for(var p in o) 
        console.log(p + ": " + o[p] + "\n"); 
}

//Compute the distance between Cartesian points (x1,y1) and (x2,y2).
//计算两个笛卡尔坐标(x1,y1)和(x2,y2)之间的距离
function distance(x1, y1, x2, y2) {
    var dx = x2 - x1;
    var dy = y2 - y1;
    return Math.sqrt(dx*dx + dy*dy);
}

// A recursive function (one that calls itself) that computes factorials
// Recall that x! is the product of x and all positive integers less than it.
//计算阶乘的递归函数（调用自身的函数）
//x!的值是从x到x递减（步长为1）的值的类乘
function factorial(x) {
    if (x <= 1) return 1;
    return x * factorial(x-1);
}

//This function expression defines a function that squares its argument.
//Note that we assign it to a variable
//这个函数表达式定义了一个函数用来求传入参数的平方
//注意我们把它赋值给一个变量
var square = function(x) { return x*x; }

//Function expressions can include names, which is useful for recursion.
//函数表达式可以包含名称，这在递归时很有用
var f = function fact(x) { if (x <= 1) return 1; else return x*fact(x-1); };

// Function expressions can also be used as arguments to other functions:
//函数表达式也可以作为参数传给其他函数
data.sort(function(a,b) { return a-b; });

// Function expressions are sometimes defined and immediately invoked:
//函数表达式有时定义后立即调用
var tensquared = (function(x) {return x*x;}(10));
```

注意：以表达式方式定义的函数，函数的名称是可选的。一条函数声明语句实际上声明了一个变量，并把一个函数对象赋值给它。相对而言，定义函数表达式时并没有声明一个变量。函数可以命名，就像上面的阶乘函数，它需要一个名称来指代自己。如果一个函数定义表达式包含名称，函数的局部作用域将会包含一个绑定到函数对象的名称。实际上，函数的名称将成为函数内部的一个局部变量。通常而言，以表达式方式定义函数时都不需要名称，这会让定义它们的代码更为紧凑。函数定义表达式特别适合用来定义那些只会用到一次的函数，比如上面展示的最后两个例子。

函数命名：任何合法的JavaScript标识符都可以用做一个函数的名称。命名时要尽量选择描述性强而又简洁的函数名。在这两者之间做到恰到好处是一门艺术，需要丰富的经验。精心挑选的函数名可以极大地改善代码的可读性（从而也提高了可维护性）。函数名称通常是动词或以动词为前缀的词组。通常函数名的第一个字符为小写，这是一种编程的约定。当函数名包含多个单词时，一种约定是将单词以下划线分隔，就像like_this()。还有另外一种约定，就是除了第一个单词之外的单词首字母使用大写字母，就像likeThis()。有一些函数是用做内部函数或私有函数（不是作为公用API的一部分），这种函数名通常以一条下划线为前缀。在一些编程风格中，或者编程框架里，通常为那些经常调用的函数指定短名称，比如客户端JavaScript框架jQuery（第19章会详细讲述）就将最常用的方法重命名为$()（一个美元符号）（2.4节提到，美元符号和下划线是除了字母和数字之外的两个合法的JavaScript标识符）。

如5.3.2节所述，函数声明语句“被提前”到外部脚本或外部函数作用域的顶部，所以以这种方式声明的函数，可以被在它定义之前出现的代码所调用。不过，以表达式定义的函数就另当别论了，为了调用一个函数，必须要能引用它，而要使用一个以表达式方式定义的函数之前，必须把它赋值给一个变量。变量的声明提前了（参见3.10.1节），但给变量赋值是不会提前的，所以，以表达式方式定义的函数在定义之前无法调用。

请注意，例8-1中的大多数函数都是用来计算出一个值的，它们使用return把值返回给调用者。而printprops()函数的不用之处在于，它的任务是输出对象各属性的名称和值。没有必要返回值，该函数不包含return语句。printprops()函数的返回值始终是undefined。（没有返回值的函数有时称为过程）

嵌套函数：
在javascript里，函数可以嵌套在其他函数里。例如：
```javascript
function hypotenuse(a,b) {
    function square(x) {return x*x}
    return Math.sqrt(square(a) + square(b));
}
```

嵌套函数的有趣之处在于它的变量作用域规则：它们可以访问嵌套它们（或多重嵌套）的函数的参数和变量。例如：在上面的代码里，内部函数square()可以读写外部函数hypotenuse()定义的参数a和b。这些作用域规则对内嵌函数非常重要，我们会在8.6节再深入了解它们。

5.3.2节曾提到，函数声明语句并非真正的语句，ECMAScript规范只是允许它们作为顶级语句。它们可以出现在全局代码里，或者内嵌在其他函数中，但它们不能出现在循环、条件判断，或者try/cache/finally以及with语句中。（有些JavaScript的实现并未严格遵守这条规则，比如，Firefox就允许在if语句中出现条件函数声明）注意，此限制仅适用于以语句声明形式定义的函数。函数定义表达式可以出现在JavaScript代码的任何地方。

**8.2函数调用**

构成函数主体的JavaScript代码在定义之时并不会执行，只有调用该函数时，它们才会执行。有4种方式来调用JavaScript函数：

* 作为函数
* 作为方法
* 作为构造函数
* 通过它们的call()和apply()方法间接调用

**8.2.1函数调用**

使用调用表达式可以进行普通的的函数调用也可进行方法调用（见4.5节）。一个调用表达式由多个函数表达式组成，每个函数表达式都是由一个函数对象和左圆括号、参数列表和右圆括号组成，参数列表是由逗号分隔的零个或多个参数表达式组成。如果函数表达式是一个属性访问表达式，即该函数是一个对象的属性或数组中的一个元素，那么它就是一个方法调用表达式。下面将会解释这种情形。下面的代码展示了一些普通的函数调用表达式：

```javascript
printprops({x:1});
var total = distance(0,0,2,1) + distance(2,1,3,5);
var probability = factorial(5)/factorial(13)
```

在一个调用中，每个参数表达式（圆括号之间的部分）都会计算出一个值，计算的结果作为参数传递给另外一个函数。这些值作为实参传递给声明函数时定义的形参。在函数体中存在一个形参的引用，指向当前传入的实参列表，通过它可以获得参数的值。

对于普通的函数调用，函数的返回值成为调用表达式的值。如果该函数返回是因为解释器到达结尾，返回值就是undefined。如果函数返回是因为解释器执行到一条return语句，返回值就是return之后的表达式的值，如果return语句没有值，则返回undefined。

根据ECMAScript3和非严格的ECMAScript5对函数调用的规定，调用上下文（this的值）是全局对象。然而，在严格模式下，调用的上下文则是undefined。
以函数形式调用的函数通常不使用this关键字。不过，“this”可以用来判断当前是否是严格模式。

```javascript
//定义并调用一个函数来确定当前脚本运行时是否为严格模式
var strict = (function(){return !this;}());
```

**8.2.2方法调用**

一个方法无非是个保存在一个对象的属性里的JavaScript函数。如果有一个函数f和一个对象o，则可以用下面的代码给o定义一个名为m()的方法：

    o.m = f;
    
给对象o定义了方法m()，调用它时就像这样：

    o.m();
    
或者，如果m()需要两个实参，调用起来则像这样：

    o.m(x,y);

上面的代码是一个调用表达式：它包括一个函数表达式o.m，以及两个实参表达式x和y，函数表达式本身就是一个属性访问表达式（见4.4节），这意味着该函数被当做一个方法，而不是作为一个普通函数来调用。

对方法调用的参数和返回值的处理，和上面所描述的普通函数调用完全一致。但是，方法调用和函数调用有一个重要的区别，即：调用上下文。属性访问表达式由两部分组成：一个对象（本例中的o）和属性名称（m）。在像这样的方法调用表达式里，对象o成为调用上下文，函数体可以使用关键字this引用该对象。下面是一个具体的例子：

```javascript
var calculator = {//对象直接量
    operand1:1,
    operand2:1,
    add: function() {
    //注意this关键字的用法，this指代当前对象
        this.result = this.operand1 + this.operand2;
    }
};
calculator.add();//这个方法调用计算1+1的结果
calculator.result;//=>2
```

大多数方法调用使用点符号来访问属性，使用方括号（的属性访问表达式）也可以进行属性访问操作。下面两个例子都是函数调用：

```javascript
o["m"](x,y);//o.m(x,y)的另外一种写法
a[0](z)//同样是一个方法调用（这里假设a[0]是一个函数）
```

方法调用可能包括更复杂的属性访问表达式：
```javascript
customer.surname.toUpperCase();//调用customer.surname的方法
f().m();//在f()调用结束后继续调用返回值中的方法m()
```

方法和this关键字是面向对象编程范例的核心。任何函数只要作为方法调用实际上都会传入一个隐式的实参——这个实参是一个对象，方法调用的母体就是这个对象。通常来讲，基于那个对象的方法可以执行多种操作，方法调用的语法已经很清晰地表明了函数将基于一个对象进行操作，比较下面两行代码：
```javascript
rect.setSize(width,height);
setRectSize(rect,width,height);
```
我们假设这两行代码的功能完全一样，它们都作用于一个假定的对象rect。可以看出，第一行的方法调用语法非常清晰地表明这个函数执行的载体是rect对象，函数中的所有操作都将基于这个对象。

方法链：当方法的返回值是一个对象，这个对象还可以再调用它的方法。这种方法调用序列中（通常称为“链”或者“级联”）每次的调用结果都是另外一个表达式的组成部分。比如，基于jQuery库（参见第19章），我们常常会这样写代码：
```
//找到所有的header，取得它们id的映射，转换为数组并对它们进行排序
$(":header").map(function() {return this.id}).get().sort();
```
当方法并不需要返回值时，最好直接返回this。如果在设计的API中一直采用这种方式（每个方法都返回this），使用API就可以进行“链式调用”风格的编程，在这种编程风格中，只要指定一次要调用的对象即可，余下的方法都可以基于此进行调用：
```
shape.setX(100).setY(100).setSize(50).setOutline("red").setFill("blue").draw();
```
不要将方法的链式调用和构造函数的链式调用混为一谈，9.7.2节将会讨论构造函数的链式调用。


需要注意的是，this是一个关键字，不是变量，也不是属性名。JavaScript的语法不允许给this赋值。

和变量不同，关键字this没有作用域的限制，嵌套的函数不会从调用它的函数中继承this。如果嵌套函数作为方法调用，其this的值指向调用它的对象。如果嵌套函数作为函数调用，其this值不是全局对象（非严格模式下）就是undefined（严格模式下）。很多人误以为调用嵌套函数时this会指向调用外层函数的上下文。如果你想访问这个外部函数的this值，需要将this的值保存在一个变量里，这个变量和内部函数都同在一个作用域内。通常使用变量self来保存this，比如：
```javascript
var o = {                           //对象o
    m: function() {                 //对象中的方法m()
        var self = this;            //将this的值保存至一个变量中
        console.log(this === o);    //输出true，this就是这个对象o
        f();                        //调用辅助函数f()
        function f() {              //定义一个嵌套函数f()
            console.log(this === o);//“false”: this的值是全局对象或undefined
            console.log(self === o);//“true”: self指外部函数的this值
        }
    }
}
o.m();  //调用对象o的方法m()
```
在8.7.4节的例8-5中有var self=this更切合实际的用法。


**8.2.3构造函数调用**

如果函数或方法调用之前带有关键字new，它就构成构造函数调用（构造函数调用在4.6节和6.1.2节有简单介绍，第9章会对构造函数做更详细地讨论）。构造函数调用和普通的函数调用以及方法调用在实参处理、调用上下文和返回值方面都有不同。

如果构造函数调用在圆括号内包含一组实参列表，先计算这些实参表达式，然后传入函数内，这和函数调用和方法调用是一致的。但如果构造函数没有形参，JavaScript构造函数调用的语法是允许省略实参列表和圆括号的。凡是没有形参的构造函数调用都可以省略圆括号，比如，下面这两行代码是等价的：

```javascript
var o = new Object();
var o = new Object;
```

构造函数调用创建一个新的空对象，这个对象继承自构造函数的prototype属性。构造函数试图初始化这个新创建的对象，并将这个对象用做其调用上下文，因此构造函数可以使用this关键字来引用这个新创建的对象。注意，尽管构造函数看起来像一个方法调用，它依然会使用这个新对象作为调用上下文。也就是说，在表达式new o.m()中，调用上下文并不是o。

构造函数通常不使用return关键字，它们通常初始化新对象。当构造函数的函数体执行完毕时，它会显示返回。在这种情况下，构造函数调用表达式的计算结果就是这个新对象的值。然而如果构造函数显示地使用return语句返回一个对象，那么调用表达式的值就是这个对象。如果构造函数使用return语句但没有指定返回值，或者返回一个原始值，那么这时将忽略返回值，同时使用这个新对象作为调用结果。

**8.2.4间接调用**

JavaScript中的函数也是对象，和其他JavaScript对象没什么两样，函数对象也可以包含方法。其中的两个方法call()和apply()可以用来间接地调用函数。两个方法都允许显式指定调用所需的this值，也就是说，任何函数可以作为任何对象的方法来调用，哪怕这个函数不是那个对象的方法。两个方法都可以指定调用的实参。call()方法使用它自有的实参列表作为函数的实参，apply()方法则要求以数组的形式传入参数。8.7.3节会有关于call()和apply()方法的详细讨论。

**8.3函数的实参和形参**

JavaScript中的函数定义并未指定函数形参的类型，函数调用也未对传入的实参值做任何类型检查。实际上，JavaScript函数调用甚至不检查传入形参的个数。下面几节将会讨论当调用函数时的实参个数和声明的形参个数不匹配时出现的状况，同样说明了如何显式测试函数实参的类型，以避免非法的实参传入函数。

**8.3.1可选形参**

当调用函数的时候传入的实参比函数声明时指定的形参个数要少，剩下的形参都将设置为undefined值。因此在调用函数时形参是否可选以及是否可以省略应当保持较好的适应性。为了做到这一点，应当给省略的参数赋一个合理的默认值，来看这个例子：

```javascript
//将对象o中可枚举的属性名追加至数组a中，并返回这个数组a
//如果省略a，则创建一个新数组并返回这个新数组
function getPropertyNames(o,/*optional*/ a){
    if(a === undefined) a = [];//如果未定义，则使用新数组
    for(var property in o) a.push(property);
    return a;
}
//这个函数调用可以传入1个或2个实参
var a = getPropertyNames(o);//将o的属性存储到一个新数组中
getPropertyNames(p,a);//将p的属性追加至数组a中
```

如果在第一行代码中不使用if语句，可以使用“||”运算符，这是一种习惯用法（需要注意的是，使用“||”运算符代替if语句的前提是a必须预先声明，否则a=a||[]会报引用错误，在这个例子中a是作为形参传入的，相当于var a，即已经声明了a，所以这样用是没有问题的。）：

```javascript
a = a || [];
```

回忆一下，4.10.2节介绍了“||”运算符，如果第一个实参是真值的话就返回第一个实参；否则返回第二个实参。在这个场景下，如果作为第二个实参传入任意对象，那么函数就会使用这个对象。如果省略掉第二个实参（或者传递null以及其他任何值），那么就新创建一个空数组，并赋值给a。

需要注意的是，当用这种可选实参来实现函数时，需要将可选实参放在实参列表的最后。那些调用你的函数的程序员是没办法省略第一个实参并传入第二个实参的，它必须将undefined作为第一个实参显式传入（当函数的实参可选时往往传入一个无意义的占位符，惯用做法是传入null作为占位符，当然也可以使用undefined作为占位符）。同样注意在函数定义中使用注释/*optional*/来强调形参是可选的。

**8.3.2可变长的实参列表：实参对象**

当调用函数的时候传入的实参个数超过函数定义时的形参个数时，没有办法直接获得未命名值的引用。参数对象解决了这个问题。在函数体内，标识符arguments是指向实参对象的引用，实参对象是一个类数组对象（参照7.11节），这样可以通过数字下标就能访问传入函数的实参值，而不用非要通过名字来得到实参。

假设定义了函数f，它的实参只有一个x。如果调用这个函数时传入两个实参，第一个实参可以通过参数名x来获得，也可以通过arguments[0]来得到。第二个实参只能通过arguments[i]来得到。此处，和真正数组一样，arguments也包含一个length属性，用以标识其所包含元素的个数。因此，如果调用函数f()时传入两个参数，arguments.length的值就是2。

实参对象在很多地方都非常有用，下面的例子展示了使用它来验证实参的个数，从而调用正确的逻辑，因为JavaScript本身不会这么做：
```javascript
function f(x,y,z) {
    //首先，验证传入实参的个数是否正确
    if(arguments.length != 3) {
        throw new Error("function f called with" + arguments.length + "arguments, but it expects 3 arguments.");
    }
    //再执行函数的其他逻辑…
}
```

需要注意的是，通常不必像这样检查实参个数。大多数情况下JavaScript的默认行为是可以满足需要的：省略的实参都将是undefined，多出的参数会自动忽略。

实参对象有一个重要的用处，就是让函数可以操作任意数量的实参。下面的函数就可以接收任意数量的实参，并返回传入实参的最大值（内置函数Max.max()的功能与之类似）：
```javascript
function max(/**/) {
    var max = Number.NEGATIVE_INFINITY;
    //遍历实参，查找并记住最大值
    for (var i= 0; i < arguments.length; i++){
        if(arguments[i] > max) max = arguments[i];
    //返回最大值
    return max;
    }
}
var largest = max(i, 10, 100, 2, 3, 1000, 4, 5, 10000, 6);//=>10000
```
类似这种函数可以接收任意个数的实参，这种函数也称为“不定实参函数”（varargs function），这个术语源自古老的C语言。

注意，不定实参函数的实参个数不能为零，arguments[]对象最适合的应用场景是在这样一类函数中，这类函数包含固定个数的命名和必需参数，以及随后个数不定的可选实参。

记住，arguments并不是真正的数组，它是一个实参对象。每个实参对象都包含以数字为索引的一组元素以及length属性，但它毕竟不是真正的数组。可以这样理解，它是一个对象，只是碰巧具有以数字为索引的属性。参照7.11节以获得更多关于类数组对象的信息。

数组对象包含一个非同寻常的特性。在非严格模式下，当一个函数包含若干形参，实参对象的数组元素是函数形参所对应实参的别名，实参对象中以数字为索引，并且形参名称可以认为是相同变量的不同命名。通过实参名字来修改实参值的话，通过arguments[]数组也可以获得到更改后的值，下面这个例子清除地说明了这一点：

```javascript
function f(x) {
    console.log(x);//输出实参的初始值
    arguments[0] = null;//修改实参数组的元素同样会修改x的值
    console.log(x);//输出“null”
}
```

如果实参对象是一个普通数组的话，第二条console.log(x)语句的结果绝对不会是null，在这个例子中，arguments[0]和x指代同一个值，修改其中一个的值会影响到另一个。

在ECMAScript5中移除了实参对象的这个特殊特性。在严格模式下还有一点（和非严格模式下相比的）不同，在非严格模式中，函数里的arguments仅仅是一个标识符，在严格模式中，它变成了一个保留字。严格模式中的函数无法使用arguments作为形参名或局部变量名，也不能给arguments赋值。

callee和caller属性：除了数组元素，实参对象还定义了callee和caller属性。在ECMAScript5严格模式中，对这两个属性的读写操作都会产生一个类型错误。而在非严格模式下，ECMAScript标准规范规定callee属性指代当前正在执行的函数。caller是非标准的，但大多数浏览器都实现了这个属性，它指代调用当前正在执行的函数的函数。通过caller属性可以访问调用栈。callee属性在某些时候会非常有用，比如在匿名函数中通过callee来递归地调用自身。

```javascript
var factorial = function(x) {
    if(x <= 1) return 1;
    return x*arguments.callee(x-1);
}
```

**8.3.3将对象属性用做实参**

当一个函数包含超过三个形参时，对于程序员来说，要记住调用函数中实参的正确顺序实在让人头疼。每次调用这个函数时都要不厌其烦地查阅文档，为了不让程序员每次都翻阅手册这么麻烦，最好通过名/值对的形式传入参数，这样参数的顺序就无关紧要了。为了实现这种风格的方法调用，定义函数的时候，传入的实参都写入一个单独的对象之中，在调用的时候传入一个对象，对象中的名/值对是真正需要的实参数据。下面的代码就展示了这种风格的函数调用，这种写法允许在函数中设置省略参数的默认值：

```javascript
//将原始数组的length元素复制至目标数组
//开始复制原始数组的from_start元素
//并且将其复制至目标数组的to_start中
//要记住实参的顺序并不容易
function arraycopy(/*array*/from,/*index*/from_start,/*array*/to,/*index*/to_start,/*integer*/length)
{
    //逻辑代码
}
//这个版本的实现效率稍微有些低，但你不必再去记住实参的顺序
//并且from_start和to_start都默认为0
function easycopy(args) {
    arraycopy(args.from,
              args.from_start||0,//注意这里设置了默认值
              args.to,
              args.to_start||0,
              args.length);
}
//来看如何调用easycopy()
var a = [1, 2, 3, 4], b = [];
easycopy({ from: a, to:b, length: 4 });
```

**8.3.4实参类型**

JavaScript方法的形参并未声明类型，在形参传入函数体之前也未做任何类型检查。可以采用语义化的单词来给函数实参命名，或者像刚才的示例代码中的arraycopy()方法一样给实参补充注释，以此使代码自文档化，对于可选的实参来说，可以在注释中补充一下“这个实参是可选的”。当一个方法可以接收任意数量的实参时，可以使用省略号：

```javascript
function max(/*number...*/){/*代码区*/}
```

3.8节已经提到，JavaScript在必要的时候会进行类型转换。因此如果函数期望接收一个字符串实参，而调用函数时传入其他类型的值，所传入的值会在函数体内将其用做字符串的地方转换为字符串类型。所有的原始类型都可以转换为字符串，所有的对象都包含toString()方法（尽管不一定有用），所以这种场景下是不会有任何错误的。

然而事情不总是这样，回头看一下刚才提到的arraycopy()方法。这个方法期望它的第一个实参是一个数组。当传入一个非数组的值作为第一个实参时（通常会传入类数组对象），尽管看起来是没有问题的，实际上会出错。除非所写的函数是只用到一两次的“用完即丢”函数，你应当添加类似的实参类型检查逻辑，因为宁愿程序在传入非法值时报错，也不愿非法值导致程序在执行时报错，相比而言，逻辑执行时的报错消息不甚清晰且更难处理。下面这个例子中的函数就做了这种类型检查。注意这里使用了7.11节的isArrayLike()函数：

```javascript
//返回数组（或类数组对象）a的元素的累加和
//数组a中必须为数字，null和undefined的元素都将忽略
function sum(a) {
    if(isArrayLike(a)) {
        var total = 0;
        for (var i = 0; i< a.length; i++){ //遍历所有元素
            var element = a[i];
            if(element == null) continue; //要跳过null和undefined
            if(isFinite(element)) total += element;
            else throw new Error("sum():elements must be finite numbers");
        }
        return total;
    }
    else throw new Error("sum():argument must be array-like");
}
```

这里的sum()方法进行了非常严格的实参检查，当传入非法的值时会给出容易看懂的错误提示信息。但当涉及类数组对象和真正的数组（不考虑数组元素是否是null还是undefined），这种做法带来的灵活性其实并不大。

JavaScript是一种非常灵活的弱类型语言，有时适合编写实参类型和实参个数的不确定性的函数。接下来的flexisum()方法就是这样（可能走向了一个极端）。比如，它可以接受任意数量的实参，并可以递归地处理实参是数组的情况，这样的话，它就可以用做不定实参函数或者实参是数组的函数。此外，这个方法尽可能的在抛出异常之前将非数字转换为数字：

```javascript
function flexisum(a) {
    var total = 0;
    for (var i=0; i < arguments.length; i++) {
        var element = arguments[i],n;
        if(element == null) continue;//忽略null和undefined实参
        if(isArray(element)) //如果实参是数组
            n = flexisum.apply(this,element);//递归地计算累加和
        else if (typeof element === "function")//否则，如果是函数…
            n = Number(element());//调用它并做类型转换
        else
            n = Number(element);//否则直接做类型转换
        if (isNaN(n)) //如果无法转换为数字，则抛出异常
            throw Error("flexisum(): can't convert" + element + "to number");
        total += n;//否则，将n累加至total
    }
    return total;
}
```


**8.4作为值的函数**

函数可以定义，也可以调用，这是函数最重要的特性。函数定义和调用是JavaScript的词法特性，对于其他大多数编程语言来说亦是如此。然而在JavaScript中，函数不仅是一种语法，也是值，也就是说，可以将函数赋值给变量，存储在对象的属性或数组的元素中，作为参数传入另外一个函数等。

为了便于理解JavaScript中的函数是如何用做数据的以及JavaScript语法，来看一下这样一个函数定义：
```javascript
function square(x) { return x*x; }
```

这个定义创建一个新的函数对象，并将其赋值给变量square。函数的名字实际上是看不见的，它（square）仅仅是变量的名字，这个变量指代函数对象。函数还可以赋值给其他的变量，并且仍可以正常工作：
```javascript
var s = square;//现在s和square指代同一个函数
square(4);//=> 16
s(4);//=> 16
```

除了可以将函数赋值给变量，同样可以将函数赋值给对象的属性。当函数作为对象的属性调用时，函数就称为方法：
```javascript
var o = {square: function(x) {return x*x}};//对象直接量
var y = o.square(16);//y等于256
```

函数甚至不需要带名字，当把它们赋值给数组元素时：
```javascript
var a = [function(x) {return x*x;},20];//数组直接量
a[0](a[1]);//=>400
```
最后一句代码看起来很奇怪，但的确是合法的函数调用表达式！

例8-2展示了将函数用做值时的一些例子，这段代码可能会难读一些，但注释解释了代码的具体含义：
例8-2：将函数用做值
```javascript
// We define some simple functions here，在这里定义了一些简单的函数
function add(x,y) { return x + y; }
function subtract(x,y) { return x - y; }
function multiply(x,y) { return x * y; }
function divide(x,y) { return x / y; }

// Here's a function that takes one of the above functions，这里的函数以上面的某个函数作为参数
// as an argument and invokes it on two operands，并给它传入两个操作数然后调用它
function operate(operator, operand1, operand2) {
    return operator(operand1, operand2);
}

// We could invoke this function like this to compute the value (2+3) + (4*5):
// 这行代码所示的函数调用实际上计算了(2+3) + (4*5)的值
var i = operate(add, operate(add, 2, 3), operate(multiply, 4, 5));

// For the sake of the example, we implement the simple functions again, 
// this time using function literals within an object literal;
// 我们为这个例子重复实现一个简单的函数，这次实现使用函数直接量，这些函数直接量定义在一个对象直接量中
var operators = {
    add:      function(x,y) { return x+y; },
    subtract: function(x,y) { return x-y; },
    multiply: function(x,y) { return x*y; },
    divide:   function(x,y) { return x/y; },
    pow:      Math.pow  // Works for predefined functions too 使用预定义的函数
};

// This function takes the name of an operator, looks up that operator
// in the object, and then invokes it on the supplied operands. Note
// the syntax used to invoke the operator function.
// 这个函数接收一个名字作为运算符，在对象中查找这个运算符，然后将它作用于所提供的操作数，注意这里调用运算符函数的语法
function operate2(operation, operand1, operand2) {
    if (typeof operators[operation] === "function")
        return operators[operation](operand1, operand2);
    else throw "unknown operator";
}
// Compute the value ("hello" + " " + "world") like this： 这样来计算("hello"+" "+"world")的值
var j = operate2("add", "hello", operate2("add", " ", "world"));
// Using the predefined Math.pow() function: 使用预定义的函数Math.pow()
var k = operate2("pow", 10, 2);
```

这里是将函数用做值的另外一个例子，考虑一下Array.sort()方法。这个方法用来对数组元素进行排序。因为排序的规则有很多（基于数值大小、字母表顺序、日期大小、从小到大、从大到小等）,sort()方法可以接收一个函数作为参数，用来处理具体的排序操作。这个函数的作用非常简单，对于任意两个值都返回一个值，以指定它们在排序后的数组中的先后顺序。这个函数参数使得Array.sort()具有更完美的通用性和无限可扩展性，它可以对任何类型的数据进行任意排序。7.8.3节有示例代码。

自定义函数属性：JavaScript中的函数并不是原始值，而是一种特殊的对象，也就是说，函数可以拥有属性。当函数需要一个“静态”变量来在调用时保持某个值不变，最方便的方式就是给函数定义属性，而不是定义全局变量，显然定义全局变量会让命名空间变得更加杂乱无章。比如，假设你想写一个返回一个唯一整数的函数，不管在哪里调用函数都会返回这个整数，而函数不能两次返回同一个值，为了做到这一点，函数必须能够跟踪它每次返回的值，而且这些值的信息需要在不同的的函数调用过程中持久化。可以将这些信息存放到全局变量中，但这并不是必需的，因为这个信息仅仅是函数本身用到的。最好将这个信息保存到函数对象的一个属性中，下面这个例子就实现了这样一个函数，每次调用函数都会返回一个唯一的整数：

```javascript
//初始化函数对象的计数器属性
//由于函数声明被提前了，因此这里是可以在函数声明之前给它的成员赋值的
uniqueInteger.counter = 0;
//每次调用这个函数都会返回一个不同的整数
//它使用一个属性来记住下一次将要返回的值
function uniqueInteger() {
    return uniqueInteger.counter++;//先返回计数器的值，然后计数器自增1
}
```

来看另外一个例子，下面这个函数factorial()使用了自身的属性（将自身当做数组来对待）来缓存上一次的计算结果：
```javascript
//计算阶乘，并将结果缓存至函数的属性中
function factorial(n) { 
    if (isFinite(n)&&n>0&&n==Math.round(n)) {   //有限的正整数
        if(!(n in factorial))                   //如果没有缓存结果
            factorial[n] = n * factorial(n-1);  //计算结果并缓存之
        return factorial[n];                    //返回缓存结果
    }
    else return NaN;//如果输入有误
}
factorial[1] = 1;//初始化缓存以保存这种基本情况
```

**8.5作为命名空间的函数**

3.10.1节介绍了JavaScript中的函数作用域的概念：在函数中声明的变量在整个函数体内都是可见的（包括在嵌套的函数中），在函数的外部是不可见的。不在任何函数内的声明的变量是全局变量，在整个JavaScript程序中都是可见的。在JavaScript中是无法声明只在一个代码块内可见的变量，基于这个原因，我们常常简单地定义一个函数用做临时的命名空间，在这个命名空间内定义的变量都不会污染到全局命名空间。

比如，假设你写了一段JavaScript模块代码，这段代码将要用在不同的JavaScript程序中（对于客户端JavaScript来讲通常是用在各种各样的网页中）。和大多数代码一样，假定这段代码定义了一个用以存储中间计算结果的变量。这样问题就来了，当模块代码放到不同的程序中运行时，你无法得知这个变量是否已经创建了，如果已经存在这个变量，那么将会和代码发生冲突。解决办法当然是将代码放入一个函数内，然后调用这个函数。这样全局变量就变成了函数内的局部变量：

```javascript
function mymodule() {
    //模块代码
    //这个模块所使用的所有变量都是局部变量
    //而不是污染全局命名空间
}
mymodule();//不要忘了还要调用这个函数
```

这段代码仅仅定义了一个单独的全局变量：名叫"mymodule"的函数。这样还是太麻烦，可以直接定义一个匿名函数，并在单个表达式中调用它：
```javascript
(function() {   //mymodule()函数重写为匿名的函数表达式
    //模块代码
}());   //结束函数定义并立即调用它
```

这种定义匿名函数并立即在单个表达式中调用它的写法非常常见，已经成为一种惯用法了。注意上面的代码的圆括号的用法，function之前的左圆括号是必需的，因为如果不写这个左圆括号，JavaScript解释器会试图将关键字function解析为函数声明语句。使用圆括号JavaScript解释器才会正确地将其解析为函数定义表达式。使用圆括号是习惯用法，尽管有些时候没有必要也不应当省略。这里定义的函数会立即调用。

例8-3展示了这种命名空间技术。它定义了一个返回extend()函数的匿名函数，正如在例6-2中所展示的那样，匿名函数中的代码检测了是否出现了一个众所周知的IE bug，如果出现了这个bug，就返回一个带补丁的函数版本。此外，这个匿名函数命名空间用来隐藏一组属性名。

例8-3：特定场景下返回带补丁的extend()版本
```javascript
// Define an extend function that copies the properties of its second and 
// subsequent arguments onto its first argument.
// We work around an IE bug here: in many versions of IE, the for/in loop
// won't enumerate an enumerable property of o if the prototype of o has 
// a nonenumerable property by the same name. This means that properties
// like toString are not handled correctly unless we explicitly check for them.
// 定义一个扩展函数，用来将第二个以及后续参数复制至第一个参数
// 这里我们处理了IE bug：在多数IE版本中
// 如果o的属性拥有一个不可枚举的同名属性，则for/in循环
// 不会枚举对象o的可枚举属性，也就是说，将不会正确地处理诸如toString的属性
// 除非我们显式检测它
var extend = (function() {  // Assign the return value of this function ，将这个函数的返回值赋值给extend
    // First check for the presence of the bug before patching it.，在修复它之前，首先检查是否存在bug
    for(var p in {toString:null}) {
        // If we get here, then the for/in loop works correctly and we return
        // 如果代码执行到这里，那么for/in循环会正确工作并返回
        // a simple version of the extend() function
        // 一个简单版本的extend()函数
        return function extend(o) {
            for(var i = 1; i < arguments.length; i++) {
                var source = arguments[i];
                for(var prop in source) o[prop] = source[prop];
            }
            return o;
        };
    }
    // If we get here, it means that the for/in loop did not enumerate
    // the toString property of the test object. So return a version
    // of the extend() function that explicitly tests for the nonenumerable
    // properties of Object.prototype.
    // 如果代码执行到这里，说明for/in循环不会枚举测试对象的toString属性，因此返回另一个版本的extend()函数，这个函数显式测试
    // Object.prototype中的不可枚举属性
    return function patched_extend(o) {
        for(var i = 1; i < arguments.length; i++) {
            var source = arguments[i];
            // Copy all the enumerable properties，复制所有的可枚举属性
            for(var prop in source) o[prop] = source[prop];

            // And now check the special-case properties，现在检查特殊属性
            for(var j = 0; j < protoprops.length; j++) {
                prop = protoprops[j];
                if (source.hasOwnProperty(prop)) o[prop] = source[prop];
            }
        }
        return o;
    };
    // This is the list of special-case properties we check for
    // 这个列表列出了需要检查的特殊属性
    var protoprops = ["toString", "valueOf", "constructor", "hasOwnProperty","isPrototypeOf", "propertyIsEnumerable","toLocaleString"];

}());
```

**8.6闭包**

和其他大多数的现代编程语言一样，JavaScript也采用词法作用域（lexical-scoping），也就是说，函数的执行依赖于变量作用域，这个作用域是在函数定义时决定的，而不是函数调用时决定。为了实现这种词法作用域，JavaScript函数对象的内部状态不仅包含函数的代码逻辑，还必须引用当前的作用域链（在继续阅读后续的章节之前，应当复习一下3.10节和3.10.3节中讲到的变量作用域和作用域链的概念）。函数对象可以通过作用域链相互关联起来，函数体内部的变量都可以保存在函数作用域内，这种特性在计算机科学文献中称为“闭包”。这个术语非常古老，是指函数变量可以被隐藏于作用域链之内，因此看起来是函数将变量“包裹”了起来。

从技术的角度讲，所有的JavaScript函数都是闭包的：它们都是对象，它们都关联到作用域链。定义大多数函数时的作用域链在调用函数时依然有效，但这并不影响闭包。当调用函数时闭包所指向的作用域链和定义函数时的作用域链不是同一个作用域链时，事情就变得非常微妙。当一个函数嵌套了另外一个函数，外部函数将嵌套的函数对象作为返回值返回的时候往往会发生这种事情。有很多强大的编程技术都利用到了这类嵌套的函数闭包。以至于这种编程模式在JavaScript中非常常见。当你第一次碰到闭包时可能会觉得非常让人费解，一旦你理解掌握了闭包之后，就能非常自如地使用它了，了解这一点至关重要。

理解闭包首先要了解嵌套函数的词法作用域规则。看一下这段代码（这段代码和你刚在3.10节中看到的代码非常类似）：
```javascript
var scope = "global scope"//全局变量
function checkscope() {
    var scope = "local scope";//局部变量
    function f() {return scope;}//在作用域中返回这个值
    return f():
}
checkscope()//=>"local scope"
```

checkscope()函数声明了一个局部变量，并定义了一个函数f()，函数f()返回了这个变量的值，最后将函数f()的执行结果返回。你应当非常清楚为什么调用checkscope()会返回“local scope”。现在我们对这段代码做一点改动。你知道这段代码返回什么吗？

```javascript
var scope = "global scope";//全局变量
function checkscope() {
    var scope = "local scope";//局部变量
    function f() {return scope;}//在作用域中返回这个值
    return f;
}
checkscope()()//返回值是什么
```
在这段代码中，我们将函数内的一对圆括号移动到了checkscope()之后。checkscope()现在仅仅返回函数内嵌套的一个函数对象，而不是直接返回结果。在定义函数的作用域外面，调用这个嵌套的函数（包含最后一行代码的最后一对圆括号）会发生什么事情呢？

回想一下词法作用域的基本规则：JavaScript函数的执行用到了作用域链，这个作用域链是函数定义的时候创建的。嵌套的函数f()定义在这个作用域链里，其中的变量scope一定是局部变量，不管在何时何地执行函数f()，这种绑定在执行f()时依然有效。因此最后一段代码返回“local scope”，而不是“global scope”。简言之，闭包的这个特性强大到让人吃惊：它们可以捕捉到局部变量（和参数），并一直保存下来，看起来像这些变量绑定到了在其中定义它们的外部函数。

实现闭包：如果你理解了词法作用域的规则，你就能很容易地理解闭包：函数定义时的作用域链到函数执行时依然有效。然而很多程序员觉得闭包非常难理解，因为它们在深入学习闭包的实现细节时将自己搞得晕头转向。他们觉得在外部函数中定义的局部变量在函数返回后就不存在了（之所以有这种想法是因为很多人以为函数执行结束后，与之相关的作用域链似乎也不存在了，但在JavaScript中并非如此），那么嵌套的函数如何能调用不存在的作用域链呢？如果你想搞清楚这个问题，你需要更深入地了解类似c语言这种更底层的编程语言，并了解基于栈的CPU架构：如果一个函数的局部变量定义在CPU的栈中，那么当函数返回时它们的确就不存在了。

但回想一下在3.10.3节中是如何定义作用域链的。我们将作用域链描述为一个对象列表，不是绑定的栈。每次调用JavaScript函数的时候，都会为之创建一个新的对象用来保存局部变量，把这个对象添加至作用域链中。但函数返回的时候，就从作用域链中将这个绑定变量的对象删除。如果不存在嵌套的函数，也没有引用指向这个绑定对象，它就会被当做垃圾回收掉。如果定义了嵌套的函数，每个嵌套的函数都各自对应一个作用域链，并且这个作用域链指向的一个变量绑定对象。但如果这些嵌套的函数对象在外部函数中保存下来，那么它们也会和所指向的变量绑定对象一样当做垃圾回收。但是如果这个函数定义了嵌套的函数，并将它们作为返回值返回或者存储在某处的属性里，这时就会有一个外部引用指向这个嵌套的函数。它就不会被当做垃圾回收，并且它所指向的变量绑定对象也不会被当做垃圾回收（作者在这里清楚地解释了闭包和垃圾回收之间的关系，如果使用不慎，闭包很容易造成“循环引用”，当DOM对象和JavaScript对象之间存在循环引用时需要格外小心，在某些浏览器下会造成内存泄漏）。

在8.4.1节中定义了uniqueInteger()函数，这个函数使用自身的一个属性来保存每次返回的值，以便每次调用都能跟踪上次的返回值。但这种做法有一个问题，就是恶意代码可能将计数器重置或者把一个非整数赋值给它，导致uniqueInteger()函数不一定能产生“唯一”的“整数”。而闭包可以捕捉到单个函数调用的局部变量，并将这些局部变量用做私有状态。我们可以利用闭包这样来重写uniqueInteger()函数：

```javascript
var uniqueInteger = (function() {//定义函数并立即调用
    var counter = 0;//函数的私有状态
    return function() {return counter++;};
}())；
```

你需要仔细阅读这段代码才能理解其含义。粗略来看，第一行代码看起来像将函数值给一个变量uniqueInteger，实际上，这段代码定义了一个立即调用的函数（函数的开始带有左圆括号），因此是这个函数的返回值赋值给变量uniqueInteger。现在，我们来看函数体，这个函数返回另外一个函数，这是一个嵌套的函数，我们将它赋值给变量uniqueInteger，嵌套的函数是可以访问作用域内的变量的，而且可以访问外部函数中定义的counter变量。当外部函数返回之后，其他任何代码都无法访问counter变量，只有内部的函数才能访问它。

像counter一样的私有变量不是只能用在一个单独的闭包内，在同一个外部函数内定义的多个嵌套函数也可以访问它，这多个嵌套函数都共享一个作用域链，看一下这段代码：
```javascript
function counter() {
    var n = 0;
    return {
        count: function() { return n++; },
        reset: function() { n=0; }
    };
}
var c = counter(), d = counter();//创建两个计数器
c.count();//=> 0
d.count();//=> 0 它们互不干扰
c.reset();//reset() 和 count() 方法共享状态
c.count();//=> 0 因为我们重置了c 
d.count();//=> 1 而没有重置d
```

counter()函数返回一个“计数器”对象，这个对象包含两个方法：count()返回下一个整数，reset()将计数器重置为内部状态。首先要理解，这两个方法都可以访问私有变量n。再者，每次调用counter()都会创建一个新的作用域链和一个新的私有变量。因此，如果调用counter()两次，则会得到两个计数器对象，而且彼此包含不同的私有变量，调用其中一个计数器对象的count()或reset()不会影响到另一个对象。

从技术角度看，其实可以将这个闭包合并为属性存取器方法getter和setter。下面这段代码所示的counter()函数的版本是6.6节中代码的变种，所不同的是，这里私有状态的实现是利用了闭包，而不是利用普通的对象属性来实现。
```javascript
function counter(n) {//函数参数n是一个私有变量
    return {
        //属性getter方法返回并给私有计数器var递增1
        get count() {return n++},
        //属性setter不允许n递减
        set count(m) {
        if (m>=n) n=m;
        else throw Error("count can only be set to a larger value");
        }
    };
}
var c = counter(1000);
c.count //=> 1000
c.count //=> 1001
c.count = 2000
c.count //=> 2000
c.count = 2000//=> Error!
```
需要注意的是，这个版本的counter()函数并未声明局部变量，而这是使用参数n来保存私有状态，属性存取器方法可以访问n。这样的话，调用counter()函数就可以指定私有变量的初始值了。

例8-4是这种使用闭包技术来共享的私有状态的通用做法。这个例子定义了addPrivateProperty()函数，这个函数定义了一个私有变量，以及两个嵌套的函数用来获取和设置这个私有变量的值。它将这些嵌套函数添加为所指定对象的方法：
```javascript
// This function adds property accessor methods for a property with
//这个函数给对象o增加了属性存取器方法
// the specified name to the object o.  The methods are named get<name>
//方法名称为get<name>和set<name>。如果提供了一个判定函数
// and set<name>.  If a predicate function is supplied, the setter
//setter方法就会用它来检测参数的合法性，然后在存储它
// method uses it to test its argument for validity before storing it.
// If the predicate returns false, the setter method throws an exception.
//如果判定函数返回false，setter方法抛出一个异常
// The unusual thing about this function is that the property value
//这个函数有一个非同寻常之处，就是getter和setter函数
// that is manipulated by the getter and setter methods is not stored in
//所操作的属性值并没有存储在对象o中
// the object o.  Instead, the value is stored only in a local variable
// 相反，这个值仅仅是保存在函数中的局部变量
// in this function.  The getter and setter methods are also defined
//getter和setter方法同样是局部函数，因此可以访问这个局部变量
// locally to this function and therefore have access to this local variable.
// This means that the value is private to the two accessor methods, and it 
// 也就是说，对于两个存取器方法来说这个变量是私有的
// cannot be set or modified except through the setter method.
//没有办法绕过存取器方法来设置或修改这个值
function addPrivateProperty(o, name, predicate) {
    var value;  // This is the property value，这是一个属性值
    // The getter method simply returns the value.，getter方法简单地将其返回
    o["get" + name] = function() { return value; };
    //The setter method stores the value or throws an exception if
    //setter方法首先检查值是否合法，若不合法就抛出异常
    // the predicate rejects the value.
    //否则就将其存储起来
    o["set" + name] = function(v) {
        if (predicate && !predicate(v))
            throw Error("set" + name + ": invalid value " + v);
        else
            value = v;
    };
}

// The following code demonstrates the addPrivateProperty() method.
//下面的代码展示了addPrivateProperty()方法
var o = {};  // Here is an empty object，设置一个空对象
// Add property accessor methods getName and setName()，增加属性存取器方法getName()和setName()
// Ensure that only string values are allowed，确保只允许字符串值
addPrivateProperty(o, "Name", function(x) { return typeof x == "string"; });
o.setName("Frank");       // Set the property value，设置属性值
console.log(o.getName()); // Get the property value，得到属性值
o.setName(0);             // Try to set a value of the wrong type，试图设置一个错误类型的值
```

我们已经给出了很多例子，在同一个作用域链中定义两个闭包，这两个闭包共享同样的私有变量或变量。这是一种非常重要的技术，但还是要特别小心那些不希望共享的变量往往不经意间共享给了其他的闭包，了解这一点也很重要。看一下下面这段代码：
```javascript
//这个函数返回一个总是返回v的函数
function constfunc(v) { return function() {return v;};}
//创建一个数组用来存储常数函数
var funcs = [];
for (var i = 0; i< 10; i++) func[i] = constfunc(i);
//在第5个位置的元素所表示的函数返回值为5
funcs[5]()//=> 5
```

这段代码利用了循环创建了很多个闭包，当写类似这种代码的时候往往会犯一个错误，那就是试图将循环代码移入定义这个闭包的函数之内，看一下这段代码：
```javascript
//返回一个函数组成的数组，它们的返回值是0～9
function constfuncs() {
    var funcs = [];
    for (var i =0; i < 10; i++) {
        funcs[i] = function() {return i;};
        return funcs;
    }
}
var funcs = constfuncs();
funcs[5]()//返回值是什么
```

上面这段代码创建了10个闭包，并将它们存储到一个数组中。这些闭包都是在同一个函数调用中定义的，因此它们可以共享变量i。当constfuncs()返回时，变量i的值是10，所有的闭包都共享这一个值，因此，数组中的函数的返回值都是同一个值，这不是我们想要的结果。关联到闭包的作用域链都是“活动的”，记住这一点非常重要。嵌套的函数不会将作用域内的私有成员复制一份，也不会对所绑定的变量生成静态快照（static snapshot）。

书写闭包的时候还需注意一件事情，this是JavaScript的关键字，而不是变量。正如之前讨论的，每个函数调用都包含一个this值，如果闭包在外部函数里是无法访问this的（严格讲，闭包内的逻辑是可以使用this的，但这个this和当初定义函数时的this不是同一个，即便是同一个this，this的值是随着调用栈的变化而变化的，而闭包里的逻辑所取到的this的值也是不确定的，因此外部函数内的闭包是可以使用this的，但要非常小心地使用才行，作者在这里提到的将this转存为一个变量的做法就可以避免this的不确定性带来的歧义。），除非外部函数将this转存为一个变量：
```javascript
    var self = this;//将this保存至一个变量中，以便嵌套的函数能够访问它
```

绑定arguments的问题与之类似。arguments并不是一个关键字，但在调用每个函数时都会自动声明它，由于闭包具有自己所绑定的arguments，因此闭包内无法直接访问外部函数的参数数组，除非外部函数将参数数组保存到另一个变量中：
```javascript
var outerArguments = arguments;//保存起来以便嵌套的函数能使用它
```

在本章接下来讲到的例8-5中就利用了这种编程技巧来定义闭包，以便在闭包中可以访问外部函数的this和arguments值。

**8.7函数属性、方法和构造函数**

我们看到在JavaScript程序中，函数是值。对函数执行typeof运算会返回字符串“function”，但是函数是JavaScript中特殊的对象。因为函数也是对象，它们也可以拥有属性和方法，就像普通的对象可以拥有属性和方法一样。甚至可以用Function()构造函数来创建新的函数对象。接下来几节就会着重介绍函数属性和方法以及Function()构造函数。在第三部分也有关于这些内容的讲解。

**8.7.1 length属性**

在函数体里，arguments.length表示传入函数的实参的个数。而函数本身的length属性则有着不同含义。函数的length属性是只读属性，它代表函数实参的数量，这里的参数指的是“形参”而非“实参”，也就是在函数定义时给出的实参个数，通常也是在函数调用时期望传入函数的实参个数。

下面的代码定义了一个名叫check()的函数，从另外一个函数给它传入arguments数组，它比较arguments.length（实际传入的实参个数）和arguments.callee.length（期望传入的实参个数）来判断所传入的实参个数是否正确。如果个数不正确，则抛出异常。check()函数之后定义一个测试函数f()，用来展示check()的用法：
```javascript
//这个函数使用arguments.callee，因此它不能在严格模式下工作
funtion check(args) {
    var actual = args.length;//实参的真实个数
    var expected = args.callee.length;//期望的实参个数
    if (actual !== expected )//如果不同则抛出异常
    throw Error("Expected" + expected + "args; got " + actual);
}
function f(x,y,z) {
    check(arguments); //检查实参个数和期望的实参个数是否一致
    return x + y + z; //再执行函数的后续逻辑
}
```

**8.7.2 prototype属性**

每一个函数都包含一个prototype属性，这个属性是指向一个对象的引用，这个对象称做“原型对象”（prototype-object）。每一个函数都包含不同的原型对象。当将函数用做构造函数的时候，新创建的对象会从原型对象上继承属性。6.1.3节讨论了原型和prototype属性，在第9章里会有进一步讨论。

**8.7.3 call()方法和apply()方法**

我们可以将call()和apply()看做是某个对象的方法，通过调用方法的形式来间接调用（见8.2.4节）函数（比如在例6-4我们使用了call()方法来调用一个对象的Object.prototype.toString方法，用以输出对象的类）。call()和apply()的第一个实参是要调用函数的母对象，它是调用上下文，在函数体内通过this来获得对它的引用。要想以对象o的方法来调用函数f(),可以这样使用call()和apply():
```javascript
f.call(o);
f.apply(o);
```
每行代码和下面代码的功能类似（假设对象o中预先不存在名为m的属性）
```javascript
o.m = f;// 将f存储为o的临时方法
o.m();// 调用它，不传入参数
delete o.m;// 将临时方法删除
```

在ECMAScript5的严格模式中，call()和apply()的第一个实参都会变为this的值，哪怕传入的实参是原始值甚至是null或undefined。在ECMAScript3和非严格模式中，传入的null和undefined都会被全局对象代替，而其他原始值则会被相应的包装对象（wrapper object）所替代。

对于call()来说，第一个调用上下文实参之后的所有实参就是要传入待调用函数的值。比如，以对象o的方法的形式调用函数f()，并传入两个参数，可以使用这样的代码：
```
f.call(o, 1, 2);
``` 

apply()方法和call()类似，但传入实参的形式和call()有所不同，它的实参都放入一个数组当中：
```
f.apply(o,[1,2]);
``` 

如果一个函数的实参可以是任意数量，给apply()传入的参数数组可以是任意长度的。比如，为了找出数组中最大的数值元素，调用Math.max()方法的时候可以给apply()传入一个包含任意个元素的数组：
```
var biggest = Math.max.apply(Math, array_of_numbers);
```

需要注意的是，传入apply()的参数数组可以是类数组对象也可以是真实数组。实际上，可以将当前函数的arguments数组直接传入（另一个函数的）apply()来调用另一个函数，参照如下代码：
```javascript
//将对象o中名为m()的方法替换为另一个方法
//可以在调用原始的方法之前和之后记录日志消息
function trace(o, m) {
    var original = o[m];//在闭包中保存原始方法
    o[m] = function() {
        console.log(new Date(), "Entering:", m); //输出日志信息
        var result = original.apply(this, arguments); //调用原始函数
        console.log(new Date(), "Exiting:", m); //输出日志消息
        return result;  //返回结果
    }
}
```
trace()函数接收两个参数，一个对象和一个方法名，它将指定的方法替换为一个新方法，这个新方法是“包裹”原始方法的另一个泛函数。这种动态修改已有方法的做法有时称做“monkey-patching”。

**8.7.4 bind()方法**

bind()是在ECMAScript 5中新增的方法，但在ECMAScript3中可以轻易模拟bind()。从名字就可以看出，这个方法的主要作用域就是将函数绑定至某个对象。当在函数f()上调用bind()方法并传入一个对象o作为参数，这个方法将返回一个新的函数。（以函数调用的方式）调用新的函数将会把原始的函数f()当做o的方法来调用。传入新函数的任何实参都将传入原始函数，比如：
```javascript
function f(y) { return this.x + y; } //这个是待绑定的函数
var o = { x : 1 }; //将要绑定的对象
var g = f.bind(o); //通过调用g(x)来调用o.f(x)
g(2) //=>3
```

可以通过如下代码轻易地实现这种绑定：
```javascript
//返回一个函数，通过调用它来调用o中的方法f()，传递它所有的实参
function bind(f, o) {
    if (f.bind) return f.bind(o); //如果bind()方法存在的话，使用bind()方法
    else return function() {    //否则，这样绑定
        return f.apply(o, arguments);
    }
}
```

ECMAScript5中的bind()方法不仅仅是将函数绑定至一个对象，它还附带一些其他应用，除了第一个实参之外，传入bind()的实参也会绑定至this，这个附带的应用是一种常见的函数式编程技术，有时也被称为“柯里化”（curring）。参照下面这个例子中的bind()方法实现：
```javascript
var sum = function(x,y) {return x+y};//返回两个实参的和值
//创建一个类似sum的新函数，但this的值绑定到null
//并且第一个参数绑定到1，这个新的函数期望只传入一个实参
var succ = sum.bind(null, 1);   
succ(2) //=>3 x绑定到1，并传入2作为实参y
function f(y,z) { return this.x + y + z };//另外一个做累加计算的函数
var g = f.bind({x:1}, 2);//绑定this和y
g(3) //=> 6 this.x绑定了1，y绑定到了2，z绑定到了3
```

我们可以绑定this的值并在ECMAScript3中实现这个附带的应用。例8-5中的示例代码就模拟实现了标准的bind()方法。

注意，我们将这个方法另存为Function.prototype.bind，以便所有的函数对象都继承它，这种技术在9.4节中有详细介绍：
例8-5：ECMAScript3版本的Function.bind()方法
```javascript
if (!Function.prototype.bind) {
    Function.prototype.bind = function(o /*, args */) {
        // Save the this and arguments values into variables so we can
        // use them in the nested function below.
        // 将this和arguments的值保存至变量中
        // 以便在后面嵌套的函数中可以使用它们
        var self = this, boundArgs = arguments;

        // The return value of the bind() method is a function
        // bind()方法的返回值是一个函数
        return function() {
            // Build up an argument list, starting with any args passed
            // to bind after the first one, and follow those with all args
            // passed to this function.
            //创建一个实参列表，将传入bind()的第二个及后续的实参都传入这个函数
            var args = [], i;
            for(i = 1; i < boundArgs.length; i++) args.push(boundArgs[i]);
            for(i = 0; i < arguments.length; i++) args.push(arguments[i]);
            // Now invoke self as a method of o, with those arguments
            // 现在将self作为o的方法来调用，传入这些实参
            return self.apply(o, args);
        };
    };
}
```
我们注意到，bind()方法返回的函数是一个闭包，在这个闭包的外部函数中声明了self和boundArgs变量，这两个变量在闭包里用到。尽管定义闭包的内部函数已经从外部函数中返回，而且调用这个闭包逻辑的时刻要在外部函数返回之后（在闭包中照样可以正确访问这两个变量）。

ECMAScript5定义的bind()方法也有一些特性是上述ECMAScript3代码无法模拟的。首先，真正的bind()方法返回一个函数对象，这个函数对象的length属性是绑定函数的形参个数减去实参的个数（length的值不能小于零）。再者，ECMAScript5的bind()方法可以顺带用做构造函数。如果bind()返回的函数用做构造函数，将忽略传入bind()的this，原始函数就会以构造函数的形式调用，它的实参也已经绑定。由bind()方法所返回的函数并不包含prototype属性（普通函数固有的prototype属性是不能删除的），并且将这些绑定的函数用做构造函数时所创建对象从原始的未绑定的构造函数中继承prototype。同样，在使用instanceof运算符时，绑定构造函数和未绑定构造函数并无两样。

**8.7.5 toString()方法**

和所有的JavaScript对象一样，函数也有toString()方法，ECMAScript规范规定这个方法返回一个字符串，这个字符串和函数声明语句的语法相关。实际上，大多数（非全部）的toString()方法的实现都返回函数的完整源码。内置函数往往返回一个类似“[native code]”的字符串作为函数体。

**8.7.6 Function()构造函数**

不管是通过函数定义语句还是函数直接量表达式，函数的定义都要使用function关键字。但函数还可以通过Function()构造函数来定义，比如：
```
var f = new Function("x", "y", "return x*y;");
```

这一行代码创建一个新的函数，这个函数和通过下面代码定义的函数几乎等价：
```
var f = function(x, y) { return x*y; }
```

Function()构造函数可以传入任意数量的字符串实参，最后一个实参所表示的文本就是函数体，它可以包含任意的JavaScript语句，每两条语句之间用分号分隔。传入构造函数的其他所有的实参字符串是指定函数的形参名字的字符串。如果定义的函数不包含任何参数，只须给构造函数简单地传入一个字符串——函数体——即可。

注意，Function()构造函数并不需要通过传入实参以指定函数名。就像函数直接量一样，Function()构造函数创建一个匿名函数。

关于Function()构造函数有几点需要特别注意：

* Function()构造函数允许JavaScript在运行时动态地创建并编译函数
* 每次调用Function()函数都会解析函数体，并创建新的函数对象。如果是在一个循环或者多次调用的函数中执行这个构造函数，执行效率会受影响。相比之下，循环中的嵌套函数和函数定义表达式则不会每次执行时都重新编译。
* 最后一点，也是关于Function()构造函数非常重要的一点，就是它所创建的函数并不是使用词法作用域，相反，函数体代码的编译总是会在顶层函数（也就是全局作用域）执行，正如下面代码所示：

```javascript
var scope = "global";
function constructFunction() {
    var scope = "local";
    return new Function("return scope");//无法捕获局部作用域
}
//这一行代码返回global，因为通过Function()构造函数所返回的函数使用的不是局部作用域
constructFunction()(); //=>"global"
```

我们可以将Function()构造函数认为是在全局作用域中执行的eval()（参照4.12.2节），eval()可以在自己的私有作用域内定义新变量和函数，Function()构造函数在实际编程过程中很少会用到。

**8.7.7 可调用的对象**

我们在7.11节中提到“类数组对象”并不是真正的数组，但大部分场景下可以将其当做数组来对待。对于函数也存在类似的情况。“可调用的对象”（callable object）是一个对象，可以在函数调用表达式中调用这个对象。所有的函数都是可调用的，但并非所有的可调对象都是函数。

截至目前，可调用对象在两个JavaScript实现中不能算作函数。首先，IEweb浏览器（IE8及之前的版本）实现了客户端方法（诸如Window.alert()和Document.getElementsById()），使用了可调用的宿主对象，而不是内置函数对象。IE中的这些方法在其他浏览器中也都存在，但它们本质上不是Function对象。IE9将它们实现为真正的函数，因此这类可调用的对象将越来越罕见。

另外一个常见的可调用对象是RegExp对象（在众多浏览器中均有实现），可以直接调用RegExp对象，这比调用它的exec()方法更快捷一些。在JavaScript中这是一个彻头彻尾的非标准特性，最开始是由Netscape提出，后被其他浏览器厂商所复制，仅仅是为了和Netscape兼容。代码最好不要对可调用的RegExp对象有太多的依赖，这个特性在不久的将来可能会废弃并删除。对RegExp执行typeof运算的结果并不统一，在有些浏览器中返回“function”，在有些中返回“object”。

如果想检测一个对象是否是真正的函数对象（并且具有函数方法），可以参照例6-4中的代码检测它的class属性（见6.8.2节）：
```javascript
function isFunction(x) {
    return Object.prototype.toString.call(x) === "[object Function]";
}
```
注意，这里的isFunction()函数和7.10节的isArray()函数极其类似。

**8.8函数式编程**

和Lisp、Haskell不同，JavaScript并非函数式编程语言，但在JavaScript中可以像操控对象一样操控函数，也就是说可以在JavaScript中应用函数式编程技术。ECMAScript5中的数组方法（诸如map()和reduce()）就可以非常适合用于函数式编程风格。接下来的几节会着重介绍JavaScript中的函数式编程技术。对JavaScript函数的探讨会让人倍感兴奋，你会体会到JavaScript函数非常强大，而不仅仅是学习一种编程风格而已。

**8.8.1 使用函数处理数组**

假设有一个数组，数组元素都是数字，我们想要计算这些元素的平均值和标准差。若使用非函数式编程风格的话，代码会是这样：
```javascript
var data = [1,1,3,5,5]; //这里是待处理的数组
//平均数是所有元素的累加和值除以元素个数
var total = 0;
for (var i = 0; i<data.length; i++ ){
    total += data[i];
}
var mean = total/data.length; //平均数是3
//计算标准差，首先计算每个数据减去平均数之后偏差的平方然后求和
total = 0;
for (var i = 0; i < data.length; i++) {
    var deviation = data[i] - mean;
    total += deviation*deviation;
}
var stddev = Math.sqrt(total/(data.length - 1)); //标准差的值是2        
```

可以使用数组方法map()和reduce()来实现同样的计算，这种实现极其简洁（参照7.9节来查看这些方法）：
```javascript
//首先定义两个简单的函数
var sum = function(x,y) {return x+y};
var square = function(x) {return x*x};
//然后将这些函数和数组方法配合使用计算出的平均数和标准差
var data = [1,1,3,5,5];
var mean = data.reduce(sum)/data.length;
var deviations = data.map(function(x){return x-mean});
var stddev = Math.sqrt(deviations.map(square).reduce(sum)/(data.length - 1));
```

如果我们基于ECMAScript3来如何实现呢？因为ECMAScript3中并不包含这些数组方法，如果不存在内置方法的话我们可以自定义map()和reduce()函数：
```javascript
//对于每个数组元素调用函数f()，并返回一个结果数组
//如果Array.prototype.map定义了的话，就使用这个方法
var map = Array.prototype.map
    ? function(a, f) { return a.map(f); } //如果已经存在map()方法，就直接使用它
    : function(a, f) {                  //否则，自己实现一个 
        var results = [];
        for (var i = 0, len = a.length; i < len; i++ ) {
            if (i in a) results[i] = f.call(null, a[i], i, a);
        }
        return results;
    };
//使用函数f()和可选的初始值将数组a减至一个值
//如果Array.prototype.reduce存在的话，就使用这个方法
var reduce = Array.prototype.reduce 
    ? function(a, f, initial) { //如果reduce()方法存在的话
    if (arguments.length > 2)
        return a.reduce(f, initial); //如果传入一个初始值
        else return a.reduce(f); //否则没有初始值
    }
    : function(a, f, initial) { //这个算法来自ES5规范
        var i = 0, len = a.length, accumulator; 
        //以特定的初始值开始，否则第一个值取自a
        if (arguments.length > 2) accumulator = initial;
        else { //找到数组中第一个已定义的索引
            if (len == 0) throw TypeError();
            while (i < len) {
                if (i in a) {
                    accumulator = a[i++];
                    break;
                }
                else i++;
            }
            if (i == len) throw TypeError();
        }
        //对于数组中剩下的元素依次调用f()
        while (i < len) {
            if (i in a)
                accumulator = f.call(undefined, accumulator, a[i], i, a);
            i++;
        }
        return accumulator;
    };
```

使用定义的map()和reduce()函数，计算平均值和标准差的代码看起来像这样：
```javascript
var data = [1,1,3,5,5];
var sum = function(x, y) { return x+y; };
var square = function(x) { return x*x; };
var mean = reduce(data, sum)/data.length;
var deviations = map(data, function(x) {return x-mean;});
var stddev = Math.sqrt(reduce(map(deviations, square), sum)/(data.length -1));
```


**8.8.2 高阶函数**
所谓高阶函数（higher-order function）就是操作函数的函数，它接收一个或多个函数作为参考，并返回一个新函数，来看这个例子：
```javascript
//这个高阶函数返回一个新的函数，这个新的函数将它的实参传入f()
//并返回f的返回值的逻辑非
function not (f) {
    return function() { //返回一个新的函数
        var result = f.apply(this, arguments); // 调用f()
        return !result; //对结果求反
    };
}
var even = function(x) { //判断a是否为偶数的函数
    return x%2 === 0;  
};
var odd = not(even); //一个新函数，所做的事情和even()相反
[1, 1, 3, 5, 5].every(odd); //=>true 每个元素都是奇数
```

上面的not()函数就是一个高阶函数，因为它接收一个函数作为参数，并返回一个新函数。另外一个例子，来看下面的mapper()函数，它也是接收一个函数作为参数，并返回一个新函数，这个新函数将一个数组映射到另一个使用这个函数的数组上。这个函数使用了之前定义的map()函数，但要首先理解这两个函数有哪里不同，理解这一点至关重要：
```javascript
//所返回的函数的参数应当是一个实参数组，并对每个数组元素执行函数f()
//并返回所有计算结果组成的数组
//可以对比一下这个函数和上文提到的map()函数
function mapper(f) {
    return function(a) {return map(a, f);};
}
var increment = function(x) {return x+1;};
var incrementer = mapper(increment);
incrementer([1,2,3]) //=> [2,3,4]
```

这里是一个更常见的例子，它接收两个函数f()和g()，并返回一个新的函数用以计算f(g()):
```javascript
//返回一个新的可以计算f(g(...))的函数
//返回的函数h()将它所有的实参传入g()，然后将g()的返回值传入f()
//调用f()和g()时的this值和调用h()时的this值是同一个this
function compose (f, g) {
    return function() {
        //需要给f()传入一个参数，所以使用f()的call()方法
        //需要给g()传入很多参数，所以使用g()的apply()方法
        return f.call(this, g.apply(this, arguments));
    };
}
var square = function(x) {return x*x; };
var sum = function(x, y) {return x+y; };
var squareofsum = compose(square, sum);
squareofsum(2, 3)//=> 25
```
本章后续几节中定义了partial()和memoize()函数，这两个函数是非常重要的高阶函数。

**8.8.3 不完全函数**

函数f()（见8.7.4节）的bind()方法返回一个新函数，给新函数传入特定的上下文和一组特定的参数，然后调用函数f()。我们说它把函数“绑定至”对象并传入一部分参数。bind()方法只是将实参放在（完整实参列表的）左侧，也就是说传入bind()的实参都是放在传入原始函数的实参列表开始的位置，但有时我们期望将传入bind()的实参放在（完整实参列表的）右侧：
```javascript
//实现一个工具函数将类数组对象（或对象）转换为真正的数组
//在后面的示例代码中用到了这个方法将arguments对象转换为真正的数组
function array(a, n) { return Array.prototype.slice.call(a, n || 0);}
//这个函数的实参传递至左侧
function partialLeft(f /*, ...*/) {
    var args = arguments; //保存外部的实参数组
    return function() { //并返回这个函数
        var a = array(args, 1); //开始处理外部的第1个args
        a = a.concat(array(arguments)); //然后增加所有的内部实参
        return f.apply(this, a);    //然后基于这个实参列表调用f()
    };
}
//这个函数的实参传递至右侧
function partialRight(f /*, ...*/) {
    var args = arguments; //保存外部实参数组
    return function() { //调用这个函数
        var a = array(arguments); //从内部参数开始
        a = a.concat(array(args, i)); //然后从外部第i个args开始添加
        return f.apply(this, a); // 最后基于这个实参列表调用f()
    };
}
//这个函数的实参被用做模板
//实参列表中的undefined值都被填充
function partial(f /*, ...*/) {
    var args = arguments; //保存外部实参数组
    return function() {
        var a = array(args, i); //从外部args开始
        var i = 0, j = 0;
        //遍历args，从内部实参填充undefined值
        for (; i < a.length; i++)
            if (a[i] === undefined) a[i] = arguments[j++];
        //现在将剩下的内部实参都追加进去
        a = a.concat(array(arguments, j));
        return f.apply(this, a);
    };
}
//这个函数带有三个实参
var f = function(x, y, z) {return x*(y -z);};
//注意这三个不完全调用之间的区别
partialLeft(f, 2)(3, 4) //=> -2 绑定第一个实参 2*(3 - 4)
partialRight(f, 2)(3, 4) //=> 6 绑定最后一个实参 3*(4 - 2)
partial(f, undefined, 2)(3, 4) //=> -6 绑定中间的实参 3*(2 - 4)
```
利用这种不完全函数的编程技巧，可以编写一些有意思的代码，利用已有的函数来定义新的函数，参照下面这个例子：
```javascript
var increment = partialLeft(sum, 1);
var cuberoot = partialRight(Math.pow, 1/3);
String.prototype.first = partial(String.prototype.charAt, 0);
String.prototype.last = partial(String.prototype.substr, -1, 1);
```
当将不完全调用和其他高阶函数整合在一起的时候，事情就变得格外有趣了。比如，这里的例子定义了not()函数，它用到了刚才提到的不完全调用：
```javascript
var not = partialLeft(compose, function(x) { return !x; });
var even = function(x) { return x%2 === 0;};
var odd = not(even);
var isNumber = not(isNaN);
```
我们也可以使用不完全调用的组合来重新组织求平均数和标准差的代码，这种编程风格是非常纯粹的函数式编程：
```javascript
var data = [1, 1, 3, 5, 5]; //我们要处理的数据
var sum = function(x, y) {return x*y; }; //两个初等函数
var product = function(x, y) { return x*y;};
var neg = partial(product, -1); //定义其他函数
var square = partial(Math.pow, undefined, 2);
var sqrt = partial(Math.pow, undefined, .5);
var reciprocal = partial(Math.pow, undefined, -1);
//现在计算平均值和标准差，所有的函数调用都不带运算符
//这段代码看起来很像lisp代码
var mean = product(reduce(data, sum), reciprocal(data.length));
var stddev = sqrt(product(reduce(map(data, compose(square, partial(sum, neg(mean)))),sum),reciprocal(sum(data.length, -1))));
```

**8.8.4 记忆**

在8.4.1节中定义了一个阶乘函数，它可以将上次的计算结果缓存起来。在函数式编程当中，这种缓存技巧叫做“记忆”（memorization）。下面的代码展示了一个高阶函数，memorize()接收一个函数作为实参，并返回带有记忆能力的函数。（需要注意的是，记忆只是一种编程技巧，本质上是牺牲算法的空间复杂度以换取更优的时间复杂度，在客户端JavaScript中代码的执行时间复杂度往往成为瓶颈，因此在大多数场景下，这种牺牲空间换取时间的做法以提升程序执行效率的做法是非常可取的。）
```javascript
//返回f()的带有记忆功能的版本
//只有当f()的实参的字符串表示都不相同时它才会工作
function memorize(f) {
    var cache = {}; //将值保存在闭包内
    return funciton(){
        //将实参转换为字符串的形式，并将其用做缓存的键
        var key = arguments.length + Array.prototype.join.call(arguments, ",");
        if (key in cache) return cache[key];
        else return cache[key] = f.apply(this, arguments);
    };
}
```
memorize()函数创建一个新的对象，这个对象被当做缓存（的宿主）并赋值给一个局部变量，因此对于返回的函数来说它是私有的（在闭包中）。所返回的函数将它的实参数组转换为字符串，并将字符串用做缓存对象的属性名。如果在缓存中存在这个值，则直接返回它。

否则，就调用既定的函数对实参进行计算，将计算结果缓存起来并返回，下面的代码展示了如何使用memorize():
```javascript
//返回两个整数的最大公约数
//使用欧几里德算法（http://en.wikipedia.org/wiki/Euclidean_algorithm）
function gcd(a, b) {    //这里省略对a和b的类型检查
    var t;  //临时变量用来存储交换数值
    if (a < b) t=b, b=a, a=t; //确保 a>=b
    while(b !- 0) t=b, b=a%b, a=t;//这是求最大公约数的欧几里德算法
    return a;
}
var gcdmemo = memorize(gcd);
gcdmemo(85, 187) // => 17
//注意，当我们写一个递归函数时，往往需要实现记忆功能
//我们更希望调用实现了记忆功能的递归函数，而不是原递归函数
var factorial = memorize(function(){
    return (n <= 1) ? 1: n * factorail(n-1);
});
factorial(5)  //=>120 对于4~1的值也有缓存
```


第9章 类和模块
---------------

第6章详细介绍了JavaScript对象，每个JavaScript对象都是一个属性集合，相互之间没有任何联系。在JavaScript中也可以定义对象的类，让每个对象都共享某些属性，这种“共享”的特性是非常有用的。类的成员或实例都包含一些属性，用以存放或定义它们的状态，其中有些属性定义了它们的行为（通常称为方法）。这些行为通常是由类定义的，而且为所有实例所共享。例如，假设一个名为Complex的类用来表示复数，同时还定义了一些复数运算。一个Complex实例应当包含复数的实部和虚部（状态），同样Complex类还会定义复数的加法和乘法操作（行为）。

在JavaScript中，类的实现是基于其原型继承机制的。如果两个实例都从同一个原型对象上继承了属性，我们说它们是同一个类的实例。JavaScript原型和继承在6.1.3节和6.2.2节中有详细讨论，为了更好地理解本章的内容，请务必首先阅读这两个章节。本章将会在9.1节对原型做进一步的讨论。

如果两个对象继承自同一个原型，往往意味着（但不是绝对）它们是由同一个构造函数创建并初始化的。我们已经在4.6节、6.2节和8.2.3节中详细讲解了构造函数，9.2节会有进一步讨论。

如果你对诸如Java和C++这种强类型（强/弱类型是指类型检查的严格程度，为所有变量指定数据类型称为“强类型”）的面向对象编程比较熟悉，你会发现JavaScript中的类和Java以及C++中的类有很大的不同。尽管在写法上类似，而且在JavaScript中也能“模拟”出很多经典的类的特性（比如传统类的封装、继承、多态），但是最好要理解JavaScript的类和基于原型的继承机制，以及和传统的Java（当然还有类似Java的语言）的类和基于类的继承的不同之处。9.3节展示了如何在JavaScript中实现经典的类。

JavaScript中类的一个重要特性是“动态可继承”（dynamically-extendable），9.4节详细解释这一特性。我们可以将类看做是类型，9.5节讲解检测对象的类的几种方式，该节同样介绍一种编程哲学——“鸭式辩型”（duck-typing），它弱化了对象的类型，强化了对象的功能。

在讨论了JavaScript中所有基本的面向对象编程特性之后，我们将关注点从抽象的概念转向一些实例。9.6节介绍两种非常重要的实现类的方法，包括很多实现面向对象的技术，这些技术可以很大程度上增强类的功能。9.7节展示（包含很多示例代码）如何实现类的继承，包括如何在JavaScript中实现类的继承。9.8节讲解如何使用ECMAScript5中的新特性来实现类以及面向对象编程。

定义类是模块开发和重用代码的有效方式之一，本章最后一节会集中讨论JavaScript中的模块。


**9.1类和原型**

在JavaScript中，类的所有实例对象都从同一个原型对象上继承属性。因此，原型对象是类的核心。在例6-1中定义了inherit()函数，这个函数返回一个新创建的对象，后者继承自某个原型对象。如果定义一个原型对象，然后通过inherit()函数创建一个继承自它的对象，这样就定义了一个JavaScript类。通常，类的实例还需要进一步的初始化，通常是通过定义一个函数来创建并初始化这个新对象，参照例9-1。例9-1给一个表示“值的范围”的类定义了原型对象，还定义了一个“工厂”函数用以创建并初始化类的实例。

例9-1：一个简单的JavaScript类
```javascript
//range.js 实现一个能表示值的范围的类
//这个工厂方法返回一个新的“范围对象”
function range(from, to) {
    //使用inherit()函数来创建对象，这个对象继承自在下面定义的原型对象
    //原型对象作为函数的一个属性存储，并定义所有“范围对象”所共享的方法（行为）
    var r = inherit(range.methods);
    //存储新的“范围对象”的起始位置和结束位置（状态）
    //这两个属性是不可继承的，每个对象都拥有唯一的属性
    r.from = from;
    r.to = to;
    //返回这个新创建的对象
    return r;
}
//原型对象定义方法，这些方法为每个范围对象所继承
range.methods = {
    //如果x在范围内，则返回true，否则返回false
    //这个方法可以比较数字范围，也可以比较字符串和日期范围
    includes: function(x) { return this.from <= x && x <= this.to; },
    //对于范围内的每个整数都调用一次f
    //这个方法只可用做数字范围
    foreach: function(f) {
        for(var x = Math.ceil(this.from); x <= this.to; x++) f(x);
    },
    //返回表示这个范围的字符串
    toString: function() { return "(" + this.from + "..." + this.to + ")"; }
};

//这里是使用“范围对象”的一些例子
var r = range(1,3);      //创建一个范围对象
r.includes(2);           // => true: 2 在这个范围内
r.foreach(console.log);  // 输出 1 2 3
console.log(r);          // 输出 (1...3)
```
在例子9-1中有一些代码是没有用的。这段代码定义了一个工厂方法range(),用来创建新的范围对象。我们注意到，这里给range()函数定义了一个属性range.methods，用以快捷地存放定义类的原型对象。把原型对象挂在函数上没什么大不了，但也不是惯用做法。再者，注意range()函数给每个范围对象都定义了from和to属性，用以定义范围的起始位置和结束位置，这两个属性是非共享的，当然也是不可继承的。最后，注意在range.methods中定义的那些可共享，可继承的方法都用到了from和to属性，而且使用了this关键字，为了指代它们，二者使用this关键字来指代调用这个方法的对象。任何类的方法都可以通过this的这种基本用法来读取对象的属性。


**9.2类和构造函数**

例9-1展示了在JavaScript中定义类的其中一种方法。但这种方法并不常用，毕竟它没有定义构造函数，构造函数是用来初始化新创建的对象的。8.2.3节已经讲到，使用关键字new来调用构造函数。使用new调用构造函数会自动创建一个新对象，因此构造函数本身只需要初始化这个新对象的状态即可。调用构造函数的一个重要特征是，构造函数的prototype属性被用做新对象的原型。这意味着通过同一个构造函数创建的所有对象都继承自一个相同的对象，因此它们都是同一个类的成员。例9-2对例9-1的“范围类”做了修改，使用构造函数代替工厂函数：
例9-2：使用构造函数来定义“范围类”
```javascript
// 这是一个构造函数，用以初始化新创建的“范围对象”
// 注意，这里并没有创建并返回一个对象，仅仅是初始化
function Range(from, to) {
    // 存储“范围对象”的起始位置和结束位置（状态）
    // 这两个属性是不可继承的，每个对象都拥有唯一的属性
    this.from = from;
    this.to = to;
}

// 所有的“范围对象”都继承自这个对象
// 注意，属性的名字必须是“prototype”
Range.prototype = {
    // 如果x在范围内，则返回true，否则返回false
    // 这个方法可以比较数字范围，也可以比较字符串和日期范围
    includes: function(x) { return this.from <= x && x <= this.to; },
    // 对于范围内的每个整数都调用一次f
    // 这个方法只可用于数字范围.
    foreach: function(f) {
        for(var x = Math.ceil(this.from); x <= this.to; x++) f(x);
    },
    // 返回表示这个范围的字符串
    toString: function() { return "(" + this.from + "..." + this.to + ")"; }
};

// 这里是使用“范围对象”的一些例子
var r = new Range(1,3);   // 创建一个范围对象
r.includes(2);            // => true: 2 在这个范围内
r.foreach(console.log);   // 输出 1 2 3
console.log(r);           // 输出 (1...3)
```
将例9-1和例9-2中的代码做一个仔细的对比，可以发现两种定义类的技术的差别。首先，注意当工厂函数range()转化为构造函数时被重命名为Range()。这里遵循了一个常见的编程约定：从某种意义上讲，定义构造函数既是定义类，并且类名首字母要大写。而普通的函数和方法都是首字母小写。

再者，注意Range()构造函数是通过new关键字调用的（在示例代码的末尾），而range()工厂函数则不必使用new。例9-1通过调用普通函数（见8.2.1节）来创建新对象，例9-2则使用构造函数调用（见8.2.3节）来创建新对象。由于Range()构造函数是通过new关键字调用的，因此不必调用inherit()或其他什么逻辑来创建新对象。在调用构造函数之前就已经创建了新对象，通过this关键字可以获取这个新对象。Range()构造函数只不过是初始化this而已。构造函数甚至不必返回这个新创建的对象，构造函数会自动创建对象，然后将构造函数作为这个对象的方法来调用一次，最后返回这个新对象。事实上，构造函数的命名规则（首字母大写）和普通函数是如此不同还有另外一个原因，构造函数调用和普通函数调用是不尽相同的。构造函数就是用来“构造新对象”的，它必须通过关键字new调用，如果将构造函数用做普通函数的话，往往不会正常工作。开发者可以通过命名约定来（构造函数首字母大写，普通方法首字母小写）判断是否应当在函数之前冠以关键字new。

例9-1和例9-2之间还有一个非常重要的区别，就是原型对象的命名。在第一段示例代码中的原型是range.methods。这种命名方式很方便同时具有很好的语义，但又过于随意。在第二段示例代码中的原型是Range.prototype，这是一个强制的命名。对Range()构造函数的调用会自动使用Range.prototype作为新Range对象的原型。

最后，需要注意在例9-1和例9-2中两种类定义方式的相同之处，两者的范围方法定义和调用方式是完全一样的。

**9.2.1构造函数和类的标识**

上文提到，原型对象是类的唯一标识，当且仅当两个对象继承自同一个原型对象时，它们才是属于同一个类的实例。而初始化对象的状态的构造函数则不能作为类的标识，两个构造函数的prototype属性可能指向同一个原型对象。那么这两个构造函数创建的实例是属于同一个类的。

尽管构造函数不像原型那样基础，但构造函数是类的“外在表现”。很明显的，构造函数的名字通常用做类名。比如，我们说Range()构造函数创建Range对象。然而，更根本地讲，当使用instanceof运算符来检测对象是否属于某个类时会用到构造函数。假设这里有一个对象r，我们想知道r是否是Range对象，我们这样写：
```javascript
r instanceof Range //如果r继承自Range.prototype 则返回true
``` 

实际上instanceof运算符并不会检查r是否是由Range()构造函数初始化而来，而会检查r是否继承自Range.prototype。不过，instanceof的语法则强化了“构造函数是类的公有标识”的概念。在本章的后面还会碰到对instanceof运算符的介绍。

**9.2.2 constructor属性**

在例9-2中，将Range.prototype定义为一个新对象，这个对象包含类所需要的方法。其实没有必要新创建一个对象，用单个对象直接量的属性就可以方便地定义原型上的方法。任何JavaScript函数都可以用做构造函数，并且调用构造函数是需要用到一个prototype属性的。因此，每个JavaScript函数（ECMAScript5中的Function.bind()方法返回的函数除外）都自动拥有一个prototype属性。这个属性的值是一个对象，这个对象包含唯一一个不可枚举属性constructor。constructor属性的值是一个函数对象：
```javascript
var F = function() {}; //这是一个函数对象
var p = F.prototype; //这是F相关联的原型对象
var c = p.constructor; //这是与原型相关联的函数
c === F  //=>true 对于任意函数F.prototype.constructor == F
```
可以看到构造函数的原型中存在预先定义好的constructor属性。这意味着对象通常继承的constructor均指代它们的构造函数。由于构造函数是类的“公共标识”，因此这个constructor属性为对象提供子类。
```javascript
var o = new F(); //创建类F的一个对象
o.constructor === F //=>true constructor属性指代这个类
```

如图9-1所示，图9-1展示了构造函数和原型对象之间的关系，包括原型到构造函数的反向引用以及构造函数创建的实例。

图9-1：构造函数及其原型和实例

需要注意的是，图9-1用Range()构造函数作为示例，但实际上，例9-2中定义的Range类使用它自身的一个新对象重写预定义的Range.prototype对象。这个新定义的原型对象不含有constructor属性。因此Range类的实例也不含有constructor属性。我们可以通过补救措施来修正这个问题，显式给原型添加一个构造函数：
```javascript
Range.prototype = {
    constructor: Range, //显式设置构造函数反向引用
    includes: function(x) {return this.from <= x && x <= this.to;},
    foreach: function(f) {
        for( var x = Math.ceil(this.from); x <= this.to; x++) f(x);
    },
    toString: function() {return "(" + this.from + "..." + this.to + ")";}
};
```

另一种常见的解决办法是使用预定义的原型对象，预定义的原型对象包含constructor属性，然后依次给原型对象添加方法：
```javascript
//扩展预定义的Range.prototype对象，而不重写之
//这样就自动创建Range.prototype.constructor属性
Range.prototype.includes = function (x) {return this.from <= x && x <= this.to;};
Range.prototype.foreach = function (f) {
    for (var x = Math.ceil(this.from); x <= this.to; x++) f(x);
};
Range.prototype.toString = function () {
    return "(" + this.from + "..." + this.to + ")";
};
```

**9.3 JavaScript中Java式的类继承**

如果你有过Java或其他类似强类型面向对象语言的开发经历的话，在你的脑海中，类成员的模样可能会是这个样子：
```
    实例字段
        它们是基于实例的属性或变量，用以保存独立对象的状态。
    实例方法
        它们是类的所有实例所共享的方法，由每个独立的实例调用。
    类字段
        这些属性或变量是属于类的，而不是属于类的某个实例的。
    类方法
        这些方法是属于类的，而不是属于类的某个实例的。
```        
        
JavaScript和Java的一个不同之处在于，JavaScript中的函数都是以值的形式出现的，方法和字段之间并没有太大的区别。如果属性值是函数，那么这个属性就定义了一个方法；否则，它只是一个普通的属性或“字段”。尽管存在诸多差异，我们还是可以用JavaScript模拟出Java中的这四种类成员类型。JavaScript中的类牵扯三种不同的对象（参照图9-1），三种对象的属性的行为和下面三种类成员非常相似：
```
构造函数对象：之前提到，构造函数（对象）为JavaScript的类定义了名字。任何添加到这个构造函数对象中的属性都是类字段和类方法（如果属性值是函数的话就是类方法）。
    
原型对象：原型对象的属性被类的所有实例所继承，如果原型对象的属性值是函数的话，这个函数就作为类的实例的方法来调用。
    
实例对象：类的每个实例都是一个独立的对象，直接给这个实例定义的属性是不会为所有实例对象所共享的。定义在实例上的非函数属性，实际上是实例的字段。
```

在JavaScript中定义类的步骤可以缩减为一个分三步的算法。第一步，先定义一个构造函数，并设置初始化新对象的实例属性。第二步，给构造函数的prototype对象定义实例的方法。第三步，给构造函数定义类字段和类属性。我们可以将这三个步骤封装进一个简单的defineClass()函数中（这里用到了例6-2中的extend()函数和例8-3中的改进版）：
```javascript
//一个用以定义简单类的函数
function defineClass(constructor, //用以设置实例的属性的函数
                    methods, //实例的方法，复制至原型中
                    statics)    //类属性，复制至构造函数中
{
    if(methods) extend(constructor.prototype, methods);
    if(statics) extend(constructor, statics);
    return constructor;
}
//这是Range类的另一个实现
var SimpleRange =
    defineClass(function(f,t) {this.f = f; this.t = t;},
                {
                    includes: function(x) {return this.f <= x && x <= this.t;},
                    toString: function() {return this.f + "..." + this.t;},
                },
                { upto: function(t) { return new SimpleRange(o,t);} });
```

例9-3中定义类的代码更长一些。这里定义了一个表示复数的类，这段代码展示了如何使用JavaScript来模拟实现Java式的类成员。例9-3中的代码没有用到上面的defineClass()函数，而是“手动”来实现：
例9-3：Complex.js 表示复数的类
```javascript
/*
 * Complex.js:
 * This file defines a Complex class to represent complex numbers.
 * Recall that a complex number is the sum of a real number and an
 * imaginary number and that the imaginary number i is the square root of -1.
 * 这个文件定义了Complex类，用来描述复数，回忆一下，复数是实数和虚数的和，并且虚数i是-1的平方根
 */

/*
 * This constructor function defines the instance fields r and i on every
 * instance it creates.  These fields hold the real and imaginary parts of
 * the complex number: they are the state of the object.
 * 这个构造函数为它所创建的每个实例定义了实例字段r和i
 * 这两个字段分别保存复数的实部和虚部，它们是对象的状态
 */
function Complex(real, imaginary) {
    if (isNaN(real) || isNaN(imaginary)) // Ensure that both args are numbers，确保两个实参都是数字
        throw new TypeError();           // Throw an error if they are not，如果不都是数字则抛出错误
    this.r = real;                       // The real part of the complex number，复数的实部
    this.i = imaginary;                  // The imaginary part of the number，复数的虚部
}

/*
 * The instance methods of a class are defined as function-valued properties
 * of the prototype object.  The methods defined here are inherited by all
 * instances and provide the shared behavior of the class. Note that JavaScript
 * instance methods must use the this keyword to access the instance fields.
 * 类的实例方法定义为原型对象的函数值属性，这里定义的方法可以被所有实例继承，并为它们提供共享的行为
 * 需要注意的是，JavaScript的实例方法必须使用关键字this来存取实例的字段
 */

// Add a complex number to this one and return the sum in a new object.
// 当前复数对象加上另一个复数，并返回一个新的计算和值后的复数对象
Complex.prototype.add = function(that) {
    return new Complex(this.r + that.r, this.i + that.i);
};

// Multiply this complex number by another and return the product.
// 当前复数乘以另外一个复数，并返回一个新的计算乘积之后的复数对象
Complex.prototype.mul = function(that) {
    return new Complex(this.r * that.r - this.i * that.i,
                       this.r * that.i + this.i * that.r);
};

// Return the real magnitude of a complex number. This is defined
// as its distance from the origin (0,0) of the complex plane.
//计算复数的模，复数的模定义为原点(0,0)到复平面的距离
Complex.prototype.mag = function() {
    return Math.sqrt(this.r*this.r + this.i*this.i);
};

// Return a complex number that is the negative of this one.
// 复数的求负运算
Complex.prototype.neg = function() { return new Complex(-this.r, -this.i); };

// Convert a Complex object to a string in a useful way.
// 将复数对象转换为一个字符串
Complex.prototype.toString = function() {
    return "{" + this.r + "," + this.i + "}";
};

// Test whether this Complex object has the same value as another.
// 检测当前复数对象是否和另一个复数值相等
Complex.prototype.equals = function(that) {
    return that != null &&                      // must be defined and non-null，必须有定义且不能是null
        that.constructor === Complex &&         // and an instance of Complex，并且必须是Complex的实例
        this.r === that.r && this.i === that.i; // and have the same values，并且必须包含相同的值
};

/*
 * Class fields (such as constants) and class methods are defined as 
 * properties of the constructor. Note that class methods do not 
 * generally use the this keyword: they operate only on their arguments.
 * 类字段（比如常量）和类方法直接定义为构造函数的属性
 * 需要注意的是，类的方法通常不使用关键字this，
 * 它们只对其参数进行操作
 */

// Here are some class fields that hold useful predefined complex numbers.
// 这里预定义了一些对复数运算有帮助的类字段
// Their names are uppercase to indicate that they are constants.
// 它们的命名全都是大写的，用以表明它们是常量
// (In ECMAScript 5, we could actually make these properties read-only.)
// （在ECMAScript5中，还能设置这些类字段的属性为只读）
Complex.ZERO = new Complex(0,0);
Complex.ONE = new Complex(1,0);
Complex.I = new Complex(0,1);

// This class method parses a string in the format returned by the toString
// 这个类方法将由实例对象的toString方法返回的字符串格式解析为一个Complex对象
// instance method and returns a Complex object or throws a TypeError.
// 或者抛出一个类型错误异常
Complex.parse = function(s) {
    try {          // Assume that the parsing will succeed，假设解析成功
        var m = Complex._format.exec(s);  // Regular expression magic，利用正则表达式进行匹配
        return new Complex(parseFloat(m[1]), parseFloat(m[2]));
    } catch (x) {  // And throw an exception if it fails，如果解析失败则抛出异常
        throw new TypeError("Can't parse '" + s + "' as a complex number.");
    }
};

// A "private" class field used in Complex.parse() above.
// The underscore in its name indicates that it is intended for internal
// use and should not be considered part of the public API of this class.
// 定义类的“私有”字段，这个字段在Complex.parse()中用到了，下划线前缀表明它是类内部使用的，而不属于类的公有API的部分
Complex._format = /^\{([^,]+),([^}]+)\}$/;
```

从例9-3中所定义的Complex类可以看出，我们用到了构造函数、实例字段、实例方法、类字段和类方法，看一下这段示例代码：
```javascript
var c = new Complex(2, 3); //使用构造函数创建新的对象
var d = new Complex(c.i, c.r); //用到了c的实例属性
c.add(d).toString(); //=>"{5,5}" 使用了实例的方法
//这个稍微复杂的表达式用到了类方法和类字段
Complex.parse(c.toString()). //将c转换为字符串
    add(c.neg()).           //加上它的负数
    equals(Complex.ZERO)    //结果应当永远是“零”
```

尽管JavaScript可以模拟出Java式的类成员，但Java中有很多重要的特性是无法在JavaScript类中模拟的。首先，对于Java类的实例方法来说，实例字段可以用做局部变量，而不需要使用关键字this来引用它们。JavaScript是没办法模拟这个特性的，但可以使用with语句来近似地实现这个功能（但这种做法并不推荐）：
```javascript
Complex.prototype.toString = function() {
    with(this) {
        return "{" + r + "," + i + "}";
    }
};
```

在Java中可以使用final声明字段为常量，并且可以将字段和方法声明为private，用以表示它们是私有成员且在类的外面是不可见的。在JavaScript中没有这些关键字。例9-3中使用了一些命名写法上的约定来给出一些暗示，比如哪些成员是不能修改的（以大写字母命名的命名），哪些成员在类外部是不可见的（以下划线为前缀的命名）。关于这两个主题的讨论在本章后续还会碰到：私有属性可以使用闭包里的局部变量来模拟（参照9.6.6节），常量属性可以在ECMAScript5中直接实现（参照9.8.2节）。

**9.4类的扩充**

JavaScript中基于原型的继承机制是动态的：对象从其原型继承属性，如果创建对象之后原型的属性发生改变，也会影响到继承这个原型的所有实例对象。这意味着我们可以通过给原型对象添加新方法来扩充JavaScript类。这里我们给例9-3中的Complex类添加方法来计算复数的共轭复数。（两个实部相等，虚部互为相反数的复数互为共轭复数）
```javascript
//返回当前复数的共轭复数
Complex.prototype.conj = function() { return new Complex(this.r, -this.i); };
```
javascript内置类的原型对象也是一样如此“开放”，也就是说可以给数字、字符串、数组、函数等数据类型添加方法。在例8-5中我们曾给ECMAScript3中的函数类添加了bind()方法，这个方法原来是没有的：
```javascript
if (!Function.prototype.bind) {
    Function.prototype.bind = function(o /*, args*/) {
        //bind()方法的代码...
    }
}
```

这里有一些其他的例子：
```javascript
//多次调用这个函数f，传入一个迭代数
//比如，要输出“hello”三次：
//var n = 3；
//n.times(function(n) { console.log(n + " hello"); });
Number.prototype.times = function(f, context) {
    var n = Number(this);
    for(var i = 0; i < n; i++) f.call(context, i);
};
//如果不存在ES5的String.trim()方法的话，就定义它
//这个方法用以去除字符串开头和结尾的空格
String.prototype.trim = String.prototype.trim || function() {
    if (!this) return this; //空字符串不做处理
    return this.replace(/^\s+|\s+$/g, "");//使用正则表达式进行空格替换
};
//返回函数的名字，如果它有（非标准）name属性，则直接使用name属性
//否则，将函数转换为字符串然后从中提取名字
//如果是没有名字的函数，则返回一个空字符串
function.prototype.getName = function() {
    return this.name||this.toString().match(/function\s*([^()*]\(/)[1];
};
```
可以给Object.prototype添加方法，从而使所有的对象都可以调用这些方法。但这种做法并不推荐，因为在ECMAScript5之前，无法将这些新增的方法设置为不可枚举的，如果给Object.prototype添加属性，这些属性是可以被for/in循环遍历到的。在9.8.1节中会给出ECMAScript5中的一个例子，其中使用Object.defineProperty()方法可以安全地扩充Object.prototype。

然而并不是所有的宿主环境（比如web浏览器）都可以使用Object.defineProperty()，这跟ECMAScript的具体实现有关。比如，在很多web浏览器中，可以给HTMLElement.prototype添加方法，这样当前文档中表示HTML标记的所有对象就可以继承这些方法。但当前版本的IE则不支持这样做。这对客户端编程实用技术有着严重的限制。

**9.5类和类型**

回想一下第3章的内容，JavaScript定义了少量的数据类型：null、undefined、布尔值、数字、字符串、函数和对象。typeof运算符（见4.13.2节）可以得出值的类型。然而，我们往往更希望将类作为类型来对待，这样就可以根据对象所属的类来区分它们。JavaScript语言核心中的内置对象（通常是指客户端JavaScript的宿主对象）可以根据它们的class属性（见6.8.2节）来区分彼此，比如在例6-4中用到了classof()函数。但当我们使用本章所提到的技术来定义类的话，实例对象的class属性都是“Object”，这时classof()函数也无用武之地。

接下来的几节介绍了三种用以检测任意对象的类的技术：instanceof运算符，constructor属性，以及构造函数的名字。但每种技术都不甚完美，本节总结讨论了鸭式辩型，这种编程哲学更加关注对象可以完成什么工作（它包含什么方法）而不是对象属于哪个类。

**9.5.1 instanceof运算符**

4.9.4节已经讨论过了instanceof运算符，左操作符是待检测其类的对象，右操作符是定义类的构造函数。

如果o继承自c.prototype，则表达式o instanceof c 值为true。

这里的继承可以不是直接继承，如果o所继承的对象继承自另一个对象，后一个对象继承自c.prototype，这个表达式的运算结果也是true。

正如在本章前面所讲到的，构造函数是类的公共标识，但原型是唯一的标识。尽管instanceof运算符的右操作数是构造函数，但计算过程实际上是检测了对象的继承关系，而不是检测创建对象的构造函数。

如果你想检测对象的原型链上是否存在某个特定的原型对象，有没有不使用构造函数作为中介的方法呢？答案是肯定的，可以使用isPrototypeOf()方法。比如，可以通过如下代码来检测对象r是否是例9-1中定义的范围类的成员：
```
range.methods.isPrototypeOf(r); //range.method 是原型对象
```

instanceof运算符和isPrototypeOf()方法的缺点是，我们无法通过对象来获得类名，只能检测对象是否属于指定的类名。在客户端JavaScript中还有一个比较严重的不足，就是在多窗口和多框架子页面的web应用中兼容性不佳。每个窗口和框架子页面都具有单独的执行上下文，每个上下文都包含独有的全局变量和一组构造函数。在两个不同框架页面中创建的两个数组继承自两个相同但相互独立的原型对象，其中一个框架页面中的数组不是另一个框架页面的Array()构造函数的实例，instanceof运算结果是false。

**9.5.2 constructor属性**

另一种识别对象是否属于某个类的方法是使用constructor属性。因为构造函数是类的公共标识，所以最直接的方法就是使用constructor属性，比如：
```javascript
function typeAndValue(x) {  
    if ( x == null ) return "";//null和undefined没有构造函数
    switch(x.constructor) {
        case Number: return "Number:" + x; //处理原始类型
        case String: return "String:'" + x + "'"; 
        case Date: return "Date: " + x ; //处理内置类型
        case RegExp: return "RegExp: " + x ;
        case Complex: return "Complex: " + x ; //处理自定义类型
    }
}
```
需要注意的是，在代码中关键字case后的表达式都是函数，如果改用typeof运算符或获取到对象的class属性的话，它们应当改为字符串。

使用constructor属性检测对象属于某个类的技术的不足之处和instanceof一样。在多个执行上下文的场景中它是无法正常工作的（比如在浏览器窗口的多个框架子页面中）。在这种情况下，每个框架页面各自拥有独立的构造函数集合，一个框架页面中的Array构造函数和另一个框架页面的Array构造函数不是同一个构造函数。

同样，在JavaScript中也并非所有的对象都包含constructor属性。在每个新创建的函数原型上默认会有constructor属性，但我们常常会忽略原型上的constructor属性。比如本章前面的实例代码中所定义的两个类（在例9-1和例9-2中），它们的实例都没有constructor属性。

**9.5.3 构造函数的名称**

使用instanceof运算符和constructor属性来检测对象所属的类有一个主要的问题，在多个执行上下文中存在构造函数的多个副本的时候，这两种方法的检测结果会出错。多个执行上下文中的函数看起来是一模一样的，但它们是相互独立的对象，因此彼此也不相等。

一种可能的解决方案是使用构造函数的名字而不是构造函数本身作为类标识符。一个窗口里的Array构造函数和另一个窗口的Array构造函数是不相等的，但是它们的名字是一样的。在一些JavaScript的实现中为函数对象提供了一个非标准的属性name，用来表示函数的名称。对于那些没有name属性的JavaScript实现来说，可以将函数转换为字符串，然后从中提取出函数名（在9.4节中的示例代码给Function类添加了getName()方法，就是使用这种方式来得到函数名）。

例9-4定义的type()函数以字符串的形式返回对象的类型。它用typeof运算符来处理原始值和函数，对于对象来说，它要么返回class属性的值要么返回构造函数的名字。type()函数用到了例6-4中的classof()函数和9.4节中的Function.getName()方法。为了简单起见，这里包含了函数和方法的代码。
例9-4 可以判断值的类型的type()函数
```javascript
/**
 * Return the type of o as a string:
 *   -If o is null, return "null", if o is NaN, return "nan".
 *   -If typeof returns a value other than "object" return that value.
 *    (Note that some implementations identify regexps as functions.)
 *   -If the class of o is anything other than "Object", return that.
 *   -If o has a constructor and that constructor has a name, return it.
 *   -Otherwise, just return "Object".
 * 以字符串形式返回o的类型：
 *    如果o是null，返回“null”，如果o是NaN，返回“nan”
 *    如果typeof返回的值不是“object”，则返回这个值
 *    （注意，有一些JavaScript的实现将正则表达式识别为函数）
 *    如果o的类不是“object”，则返回这个值
 *    如果o包含构造函数并且这个构造函数具有名称，则返回这个名称
 *    否则，一律返回“object”
 **/
function type(o) {
    var t, c, n;  // type, class, name

    // Special case for the null value，处理null值得特殊情形
    if (o === null) return "null";

    // Another special case: NaN is the only value not equal to itself，另外一种特殊情形，NaN和它自身不相等
    if (o !== o) return "nan";

    // Use typeof for any value other than "object"，如果typeof的值不是”object“，则使用这个值
    // This identifies any primitive value and also functions，这可以识别出原始值的类型和函数
    if ((t = typeof o) !== "object") return t;

    // Return the class of the object unless it is "Object"，返回对象的类名，除非值为”object“
    // This will identify most native objects，这种方式可以识别出大多数的内置对象
    if ((c = classof(o)) !== "Object") return c;

    // Return the object's constructor name, if it has one，如果对象构造函数的名字存在的话，则返回它
    if (o.constructor && typeof o.constructor === "function" &&
        (n = o.constructor.getName())) return n;

    // We can't determine a more specific type, so return "Object"，其他的类型都无法判别，一律返回”object“
    return "Object";
}

// Return the class of an object，返回对象的类
function classof(o) {
    return Object.prototype.toString.call(o).slice(8,-1);
};
    
// Return the name of a function (may be "") or null for nonfunctions
// 返回函数的名字（可能是空字符串），不是函数的话返回null
Function.prototype.getName = function() {
    if ("name" in this) return this.name;
    return this.name = this.toString().match(/function\s*([^(]*)\(/)[1];
};
```

这种使用构造函数名字来识别对象的类的做法和使用constructor属性一样有一个问题：并不是所有的对象都具有constructor属性。此外，并不是所有的函数都有名字。如果使用不带名字的函数定义表达式定义一个构造函数，getName()方法则会返回空字符串：
```javascript
//这个构造函数没有名字
var Complex = function(x,y) {this.r = x; this.i = y;}
//这个构造函数有名字
var Range = function Range(f,t) { this.from = f; this.to = t;}
```

**9.5.4 鸭式辩型**

上式所描述的检测对象的类的各种技术多少都会有些问题，至少在客户端JavaScript中是如此。解决方法就是规避掉这些问题：不要关注”对象的类是什么“，而是关注”对象能做什么“。这种思考问题的方式在Python和Ruby中非常普遍，称为”鸭式辩型“（这个表述是由作家James-Whitcomb-Riley提出的）。
```
像鸭子一样走路、游泳并且嘎嘎叫的鸟就是鸭子
```    
对于JavaScript程序员来说，这句话可以理解为”如果一个对象可以像鸭子一样走路、游泳并且嘎嘎叫，就认为这个对象是鸭子，哪怕它并不是从鸭子类的原型对象继承来的“。

我们拿例9-2中的Range类来举例好了。起初定义这个类用以描述数字的范围。但要注意，Range()构造函数并没有对实参进行类型检查以确保实参是数字类型。但却将参数使用”>“运算符进行比较运算，因为这里假定它们是可比较的。同样，includes()方法使用"<="运算符进行比较，但没有对范围的结束点进行类似的假设。因为类并没有强制使用特定的类型，它的includes()方法可以作用于任何结束点，只要结束点可以用关系运算符执行比较运算。
```javascript
var lowercase = new Range("a", "z");
var thisYear = new Range(new Date(2009, 0, 1), new Date(2010, 0, 1));
```
Range类的foreach()方法中也没有显式地检测表示范围的结束点的类型，但Math.ceil()和”++“运算符表明它只能对数字结束点进行操作。
另外一个例子，回想一下在7.11节中所讨论的类数组对象。在很多场景下，我们并不知道一个对象是否真的是Array的实例，当然是可以通过判断是否包含非负的length属性来得知是否是Array的实例。我们说”包含一个值是非负整数的length“是数组的一个特征——“会走路”，任何具有“会走路”这个特征的对象都可以当做数组来对待（在很多情形中）。

然而必须要了解的是，真正数组的length属性有一些独有的行为：当添加新的元素时，数组的长度会自动更新，并且当给length属性设置一个更小的整数时，数组会自动截断。我们说这些特征是“会游泳”和“嘎嘎叫”。如果所实现的代码需要“会游泳”且能“嘎嘎叫”，则不能使用只“会走路”的类似数组的对象。

上文所讲到的鸭式辩型的例子提到了进行对象的“<”运算符的职责以及length属性的特殊行为。但当我们提到鸭式辩型时，往往是说检测对象是否实现了一个或多个方法。一个强类型的triathlon()函数所需要的参数必须是TriAthlete对象。而一种“鸭式辩型”式的做法是，只要对象包含walk()、swim()和bike()这三个方法就可以作为参数传入。同理，可以重新设计Range类，使用结束点对象的compareTo()和succ()（successor）方法来代替“<”和“++”运算符。

鸭式辩型的实现方法让人感觉太“放任自流”：仅仅是假设输入对象实现了必要的方法，根本没有执行进一步的检查。如果输入对象没有遵循“假设”，那么当代码试图调用那些不存在的方法时就会报错。另一种实现方法是对输入对象进行检查。但不是检查它们的类，而是用适合的名字来检查它们所实现的方法。这样可以将非法输入尽可能早地拦截在外，并可给出带有更多提示信息的报错。

例9-5中按照鸭式辩型的理念定义了quacks()函数（函数名叫“implements”会更加合适，但implement是保留字）。quacks()用以检查一个对象（第一个实参）是否实现了剩下的参数所表示的方法。对于除第一个参数外的每个参数，如果是字符串的话则直接检查是否存在以它命名的方法；如果是对象的话则检查第一个对象中的方法是否在这个对象中也具有同名的方法；如果参数是函数，则假定它是构造函数，函数将检查第一个对象实现的方法是否在构造函数的原型对象中也具有同名的方法。

例9-5 利用鸭式辩型实现的函数
```javascript
// Return true if o implements the methods specified by the remaining args.
// 如果o实现了除第一个参数之外的参数所表示的方法，则返回true
function quacks(o /*, ... */) {
    for(var i = 1; i < arguments.length; i++) {  // for each argument after o，遍历o之后的所有参数
        var arg = arguments[i];
        switch(typeof arg) { // If arg is a:如果参数是
        case 'string':       // string: check for a method with that name直接用名字做检查
            if (typeof o[arg] !== "function") return false;
            continue;
        case 'function':     // function: use the prototype object instead，检查函数的原型对象上的方法
            // If the argument is a function, we use its prototype object，如果实参是函数，则使用它的原型
            arg = arg.prototype;// fall through to the next case，进入下一个case
        case 'object':       // object: check for matching methods，检查匹配的方法
            for(var m in arg) { // For each property of the object，遍历对象的每个属性
                if (typeof arg[m] !== "function") continue; // skip non-methods，跳过不是方法的属性
                if (typeof o[m] !== "function") return false;
            }
        }
    }
    // If we're still here, then o implements everything，如果程序能执行到这里，说明o实现了所有的方法
    return true;
}
```
关于这个quacks()函数还有一些地方是需要尤为注意的。首先，这里只是通过特定的名称来检测对象是否含有一个或多个值为函数的属性。我们无法得知这些已经存在的属性的细节信息，比如，函数是干什么用的？它们需要多少参数？参数类型是什么？然而这是鸭式辩型的本质所在，如果使用鸭式辩型而不是强制的类型检测的方式定义API，那么创建的API应当更具有灵活性才可以，这样才能确保你提供给用户的API更加安全可靠。关于quacks()函数还有另一问题需要注意，就是它不能应用于内置类。比如，不能通过quacks(o,Array)来检测o是否实现了Array中所有同名的方法。原因是内置类的方法都是不可枚举的，quacks()中的for/in循环无法遍历到它们（注意，在ECMAScript5中有一个补救方法，就是使用Object.getOwnPropertyNames()）。

**9.6 JavaScript中的面向对象技术**

到目前为止，我们讨论了JavaScript中类的基础知识：原型对象的重要性、它和构造函数之间的联系、instanceof运算符如何工作等。本节将目光转向一些实际的例子（尽管这不是基础知识），包括如何利用JavaScript中的类进行编程。我们从两个重要的例子开始，这两个例子中实现的类非常有意思，接下来的讨论都将基于此作展开。

**9.6.1 一个例子：集合类**

集合（set）是一种数据结构，用以表示非重复值的无序集合。集合的基础方法包括添加值、检测值是否在集合中，这种集合需要一种通用的实现，以保证操作效率。JavaScript的对象是属性名以及与之对应的值的基本集合。因此将对象只用做字符串的集合是大材小用。例子9-6用JavaScript实现了一个更加通用的Set类，它实现了从JavaScript值到唯一字符串的映射，然后将字符串用做属性名。对象和函数都不具备如此简明可靠的唯一字符串表示。因此集合类必须给集合中的每一个对象或函数定义一个唯一的属性标志。

例9-6：Set.js 值的任意集合
```javascript
function Set() {          // This is the constructor，这是一个构造函数
    this.values = {};     // The properties of this object hold the set，集合数据保存在对象的属性里
    this.n = 0;           // How many values are in the set，集合中值的个数
    this.add.apply(this, arguments);  // All arguments are values to add，把所有参数都添加进这个集合
}

// Add each of the arguments to the set，将每个参数都添加至集合中
Set.prototype.add = function() {
    for(var i = 0; i < arguments.length; i++) {  // For each argument，遍历每个参数
        var val = arguments[i];                  // The value to add to the set，待添加到集合中的值
        var str = Set._v2s(val);                 // Transform it to a string，把它转换为字符串
        if (!this.values.hasOwnProperty(str)) {  // If not already in the set，如果不在集合中
            this.values[str] = val;              // Map string to value，将字符串和值对应起来
            this.n++;                            // Increase set size，集合中值的计数加一
        }
    }
    return this;                                 // Support chained method calls，支持链式方法调用
};

// Remove each of the arguments from the set，从集合删除元素，这些元素由参数指定
Set.prototype.remove = function() {
    for(var i = 0; i < arguments.length; i++) {  // For each argument，遍历每个参数
        var str = Set._v2s(arguments[i]);        // Map to a string，将字符串和值对应起来
        if (this.values.hasOwnProperty(str)) {   // If it is in the set，如果它在集合中
            delete this.values[str];             // Delete it，删除它
            this.n--;                            // Decrease set size，集合中指的计数减一
        }
    }
    return this;                                 // For method chaining，支持链式方法调用
};

// Return true if the set contains value; false otherwise.
// 如果集合包含这个值，则返回true，否则，返回false
Set.prototype.contains = function(value) {
    return this.values.hasOwnProperty(Set._v2s(value));
};

// Return the size of the set，返回集合的大小
Set.prototype.size = function() { return this.n; };

// Call function f on the specified context for each element of the set.
// 遍历集合中的所有元素，在指定的上下文中调用f
Set.prototype.foreach = function(f, context) {
    for(var s in this.values)                 // For each string in the set，遍历集合中的所有字符串
        if (this.values.hasOwnProperty(s))    // Ignore inherited properties，忽略继承的属性
            f.call(context, this.values[s]);  // Call f on the value，调用f，传入value
};

// This internal function maps any JavaScript value to a unique string.
// 这是一个内部函数，用以将任意javascript值和唯一的字符串对应起来
Set._v2s = function(val) {
    switch(val) {
        case undefined:     return 'u';          // Special primitive，特殊的原始值
        case null:          return 'n';          // values get single-letter，值只有一个字母
        case true:          return 't';          // codes，代码
        case false:         return 'f';
        default: switch(typeof val) {
            case 'number':  return '#' + val;    // Numbers get # prefix，数字带有#前缀
            case 'string':  return '"' + val;    // Strings get " prefix，字符串都带有"前缀
            default: return '@' + objectId(val); // Objs and funcs get @
        }
    }

    // For any object, return a string. This function will return a different
    // string for different objects, and will always return the same string
    // if called multiple times for the same object. To do this it creates a
    // property on o. In ES5 the property would be nonenumerable and read-only.
    // 对任意对象来说，都会返回一个字符串
    // 针对不同的对象，这个函数会返回不同的字符串
    // 对于同一个对象的多次调用，总是返回相同的字符串
    // 为了做到这一点，它给o创建了一个属性，在ES5中，这个属性是不可枚举且是只读的
    function objectId(o) {
        var prop = "|**objectid**|";   // Private property name for storing ids，私有属性，用以存放id
        if (!o.hasOwnProperty(prop))   // If the object has no id，如果对象没有id
            o[prop] = Set._v2s.next++; // Assign it the next available，将下一个值赋给它
        return o[prop];                // Return the id，返回这个id
    }
};
Set._v2s.next = 100;    // Start assigning object ids at this value，设置初始id的值
```

**9.6.2 一个例子：枚举类型**

枚举类型（enumerable type）是一种类型，它是值的有限集合，如果值定义为这个类型则该值是可列出（或“可枚举”）的。在C及其派生语言中，枚举类型是通过关键字enum声明的。Enum是ECMAScript5中的保留字（还未使用），很有可能在将来JavaScript就会内置支持枚举类型。到那时，例9-7展示了如何在JavaScript中定义枚举类型的数据。需要注意的是，这里用到了例6-1中的inherit()函数。

例9-7包含一个单独函数enumeration()。但它不是构造函数，它并没有定义一个名叫“enumeration”的类。相反，它是一个工厂方法，每次调用它都会创建并返回一个新的类，比如：
```javascript
//使用4个值创建新的Coin类，Coin.Penny，Coin.Nickel等
var Coin = enumeration({Penny:1, Nickel:5, Dime:10, Quarter:25});
var c = Coin.Dime; //这是新类的实例
c instanceof Coin //=>true instanceof正常工作
c.constructor == Coin//=>true 构造函数的属性正常工作
Coin.Quarter + 3*Coin.Nickel //=>40 将值转换为数字
Coin.Dime == 10 //=>true 更多转换为数字的例子
Coin.Dime > Coin.Nickel //=>true 关系运算符正常工作
String(Coin.Dime)+ ":" + Coin.Dime //=>"Dime:10" 强制转换为字符串
```
这个例子清楚地展示了JavaScript类的灵活性，JavaScript的类要比C++和java语言中的静态类要更加灵活。

例9-7 JavaScript中的枚举类型
```javascript
// This function creates a new enumerated type.  The argument object specifies
// the names and values of each instance of the class. The return value
// is a constructor function that identifies the new class.  Note, however
// that the constructor throws an exception: you can't use it to create new
// instances of the type.  The returned constructor has properties that 
// map the name of a value to the value itself, and also a values array,
// a foreach() iterator function
// 这个函数创建一个新的枚举类型，实参对象表示类的每个实例的名字和值
// 返回值是一个构造函数，它标识这个新类
// 注意，这个构造函数也会抛出异常，不能使用它来创建该类型的新实例
// 返回的构造函数包含名/值对的映射表
// 包括由值组成的数组，以及一个foreach()迭代器函数
function enumeration(namesToValues) {
    // This is the dummy constructor function that will be the return value.
    // 这个虚拟的构造函数是返回值
    var enumeration = function() { throw "Can't Instantiate Enumerations"; };

    // Enumerated values inherit from this object.
    // 枚举值继承自这个对象
    var proto = enumeration.prototype = {
        constructor: enumeration,                   // Identify type，标识类型
        toString: function() { return this.name; }, // Return name，返回名字
        valueOf: function() { return this.value; }, // Return value，返回值
        toJSON: function() { return this.name; }    // For serialization，转换为JSON
    };

    enumeration.values = [];  // An array of the enumerated value objects，用以存放枚举对象的数组

    // Now create the instances of this new type.
    // 现在创建新类型的实例
    for(name in namesToValues) {         // For each value ，遍历每个值
        var e = inherit(proto);          // Create an object to represent it，创建一个代表它的对象
        e.name = name;                   // Give it a name，给它一个名字
        e.value = namesToValues[name];   // And a value，给它一个值
        enumeration[name] = e;           // Make it a property of constructor，将它设置为构造函数的属性
        enumeration.values.push(e);      // And store in the values array，将它存储到值数组中
    }
    // A class method for iterating the instances of the class
    // 一个类方法，用来对类的实例进行迭代
    enumeration.foreach = function(f,c) {
        for(var i = 0; i < this.values.length; i++) f.call(c,this.values[i]);
    };

    // Return the constructor that identifies the new type
    // 返回标识这个新类型的构造函数
    return enumeration;
}
```
如果用这个枚举类型来实现一个“hello world”小程序的话，就可以使用枚举类型来表示一副扑克牌。
例9-8使用enumeration()函数实现了这个表示一副扑克牌的类。
例9-8 使用枚举类型来表示一副扑克牌
```javascript
// Define a class to represent a playing card
// 定义一个表示“玩牌”的类
function Card(suit, rank) {
    this.suit = suit;         // Each card has a suit，每张牌都有花色
    this.rank = rank;         // and a rank，以及点数
}

// These enumerated types define the suit and rank values
// 使用枚举类型定义花色和点数
Card.Suit = enumeration({Clubs: 1, Diamonds: 2, Hearts:3, Spades:4});
Card.Rank = enumeration({Two: 2, Three: 3, Four: 4, Five: 5, Six: 6,
                         Seven: 7, Eight: 8, Nine: 9, Ten: 10,
                         Jack: 11, Queen: 12, King: 13, Ace: 14});

// Define a textual representation for a card
// 定义用以描述牌面的文本
Card.prototype.toString = function() {
    return this.rank.toString() + " of " + this.suit.toString();
};
// Compare the value of two cards as you would in poker
// 比较扑克牌中两张牌的大小
Card.prototype.compareTo = function(that) {
    if (this.rank < that.rank) return -1;
    if (this.rank > that.rank) return 1;
    return 0;
};

// A function for ordering cards as you would in poker
// 以扑克牌的玩法规则对牌进行排序的函数
Card.orderByRank = function(a,b) { return a.compareTo(b); };

// A function for ordering cards as you would in bridge 
// 以桥牌的玩法规则对扑牌进行排序的函数
Card.orderBySuit = function(a,b) {
    if (a.suit < b.suit) return -1;
    if (a.suit > b.suit) return 1;
    if (a.rank < b.rank) return -1;
    if (a.rank > b.rank) return  1;
    return 0;
};

// Define a class to represent a standard deck of cards
// 定义用以表示一副标准扑克牌的类
function Deck() {
    var cards = this.cards = [];     // A deck is just an array of cards，一副牌就是由牌组成的数组
    Card.Suit.foreach(function(s) {  // Initialize the array，初始化这个数组
                          Card.Rank.foreach(function(r) {
                                                cards.push(new Card(s,r));
                                            });
                      });
}
 
// Shuffle method: shuffles cards in place and returns the deck
// 洗牌的方法：重新洗牌并返回洗好的牌
Deck.prototype.shuffle = function() { 
    // For each element in the array, swap with a randomly chosen lower element
    // 遍历数组中的每个元素，随机找出牌面最小的元素，并与之（当前遍历的元素）交换
    var deck = this.cards, len = deck.length;
    for(var i = len-1; i > 0; i--) {
        var r = Math.floor(Math.random()*(i+1)), temp;     // Random number，随机数
        temp = deck[i], deck[i] = deck[r], deck[r] = temp; // Swap，交换
    }
    return this;
};

// Deal method: returns an array of cards，发牌的方法：返回牌的数组
Deck.prototype.deal = function(n) {  
    if (this.cards.length < n) throw "Out of cards";
    return this.cards.splice(this.cards.length-n, n);
};

// Create a new deck of cards, shuffle it, and deal a bridge hand
// 创建一副新扑克牌，洗牌并发牌
var deck = (new Deck()).shuffle();
var hand = deck.deal(13).sort(Card.orderBySuit);
```

**9.6.3 标准转换方法**

3.8.3和6.10节讨论了对象类型转换所用到的重要方法，有一些方法是在需要做类型转换时由JavaScript解释器自动调用的。不需要为定义的每个类都实现这些方法，但这些方法的确非常重要，如果没有为自定义的类实现这些方法，也应当是有意为之，而不应当因为疏忽而漏掉它们。

最重要的方法首当toString()。这个方法的作用是返回一个可以表示这个对象的字符串。在希望使用字符串的地方用到对象的话（比如将对象用做属性名或使用“+”运算符来进行字符串连接运算），JavaScript会自动调用这个方法。如果没有实现这个方法，类会默认从Object.prototype中继承toString()方法，这个方法的运算结果是“[Object Object]”，这个字符串用处不大。
toString()方法应当返回一个可读的字符串，这样最终用户才能将这个输出值利用起来，然而有时候并不一定非要如此，不管怎样，可以返回可读字符串的toString()方法也会让程序调试变得更加轻松。例9-2和例9-3中的Range类和Complex类都定义了toString()方法，例9-7中的枚举类型也定义了toString()。下面我们会给例9-6中的set类也定义toString()方法。

toLocaleString()和toString()极为类似：toLocaleString()是以本地敏感性（locale-sensitive）的方式来将对象转换为字符串。默认情况下，对象所继承的toLocaleString()方法只是简单地调用toString()方法。有一些内置类型包含有用的toLocaleString()方法用以实际上返回本地化相关的字符串。如果需要为对象到字符串的转换定义toString()方法，那么同样需要定义toLocaleString()方法用以处理本地化的对象到字符串的转换。下面的Set类的定义中会有相关的代码。

第三个方法是valueOf()，它用来将对象转换为原始值。比如，当数学运算符（除了“+”运算符）和关系运算符作用于数字文本表示的对象时，会自动调用valueOf()方法。大多数对象都没有合适的原始值来表示它们，也没有定义这个方法。但在例9-7中的枚举类型的实现则说明valueOf()方法是非常重要的。

第四个方法是toJSON()，这个方法是由JSON.stringify()自动调用的。JSON格式用于序列化良好的数据结构，而且可以处理JavaScript原始值、数组和纯对象。它和类无关，当对一个对象执行序列化操作时，它会忽略对象的原型和构造函数。比如将Range对象或Complex对象作为参数传入JSON.stringify()，将会返回诸如{"from:1", "to":3}或{"r":1, "i":-1}这种字符串。
如果将这些字符串传入JSON.parse()，则会得到一个和Range对象和Complex对象具有相同属性的纯对象，但这个对象不会包含从Range和Complex继承来的方法。

这种序列化操作非常适用于诸如Range和Complex这种类，但对于其他一些类则必须自定义toJSON()方法来定制个性化的序列化格式。如果一个对象有toJSON()方法，JSON.stringify()并不会对传入的对象做序列化操作，而会调用toJSON()来执行序列化操作（序列化的值可能是原始值也可能是对象）。比如，Date对象的toJSON()方法可以返回一个表示日期的字符串。例9-7中的枚举类型也是如此：它们的toJSON()方法和toString()方法完全一样。如果要模拟一个集合，最接近JSON的表示方法就是数组，因此在下面的例子中将定义toJSON()方法用以将集合对象转换为值数组。

例9-6中的Set类并没有定义上述方法中的任何一个。JavaScript中没有哪个原始值可以表示集合，因此也没必要定义valueOf()方法，但该类应当包含toString()、toLocaleString()和toJSON()方法。可以用如下代码来实现。注意extend()函数（例6-2）的用法，这里使用extend()来向Set.prototype来添加方法：
```javascript
//将这些方法添加至Set类的原型对象中
extend(Set.prototype,{
    //将集合转换为字符串
    toString: function () {
        var s = "{",
        i = 0;
        this.foreach(function (v) {s += ((i++>0)? ", " : "") + v;});
        return s + "}";
    },
    //类似toString，但是对于所有的值都将调用toLocaleString()
    toLocaleString: function () {
        var s = "{", i=0;
        this.foreach(function (v){
            if (i++>0) s += ", ";
            if (v == null) s += v; //null和undefined
            else s += v.toLocaleString(); //其他情况
        });
    },
    //将集合转换为值数组
    toArray: function () {
        var a = [];
        this.foreach(function (v) {a.push(v);});
    }
});
//对于要从JSON转换为字符串的集合都被当做数组来对待
Set.prototype.toJSON = Set.prototype.toArray;
```

**9.6.4 比较方法**

JavaScript的相等运算符比较对象时，比较的是引用而不是值。也就是说，给定两个对象引用，如果要看它们是否指向同一个对象，不是检查这两个对象是否具有相同的属性名和相同的属性值，而是直接比较这两个单独的对象是否相等，或者比较它们的顺序（就像“<”和“>”运算符进行的比较一样）。如果定义一个类，并且希望比较类的实例，应该定义合适的方法来执行比较操作。

Java编程语言有很多用于对象比较的方法，将Java中的这些方法借用到JavaScript中是一个不错的主意。为了能让自定义类的实例具备比较的功能，定义一个名叫equals()实例方法。这个方法只能接收一个实参，如果这个实参和调用此方法的对象相等的话则返回true。当然，这里所说的“相等”的含义是根据类的上下文来决定的。对于简单的类，可以通过简单地比较它们的constructor属性来确保两个对象是相同类型，然后比较两个对象的实例属性以保证它们的值相等。例9-3中的Complex类就实现了这样的equals()方法，我们可以轻易地为Range类也实现类似的方法：
```javascript
//Range类重写它的constructor属性，现在将它添加进去
Range.prototype.constructor = Range;
//一个Range对象和其他不是Range的对象均不相等
//当且仅当两个范围的端点相等，它们才相等
Range.prototype.equals = function(that) {
    if (that == null) return false; //处理null和undefined
    if (that.constructor !== Range) return false; //处理非Range对象
    //当且仅当两个端点相等，才返回true
    return this.from == that.from && this.to == this.to;
}
```

给Set类定义equals()方法稍微有些复杂。不能简单地比较两个集合的values属性，还要进行更深层次的比较：
```javascript
Set.prototype.equals = function (that) {
    //一些次要情况的快捷处理
    if (this === that) return true;
    //如果that对象不是一个集合，它和this不相等
    //我们用到了instanceof，使得这个方法可以用于Set的任何子类
    //我们希望采用鸭式辩型的方法，可以降低检查的严格程度
    //或者可以通过 this.constructor == that.constructor 来加强检查的严格程度
    //注意，null和undefined两个值是无法用于instanceof运算的
    if (!(that instanceof Set)) return false;
    //如果两个集合的大小不一样，则它们不相等
    if (this.size() != that.size()) return false;
    //现在检查两个集合中的元素是否完全一样
    //如果两个集合不相等，则通过抛出异常来终止foreach循环
    try {
        this.foreach(function (v) { if (!that.contains(v)) throw false; });
        return true; //所有的元素都匹配：两个集合相等
    } catch(x) {
        if (x === false) return false; //如果集合中有元素在另外一个集合中不存在
        throw x; //重新抛出异常
    }
};
```
按照我们需要的方式比较对象是否相等常常是很有用的。对于某些类来说，往往需要比较一个实例“大于”或者“小于”另外一个示例。比如，你可能会基于Range对象的下边界来定义实例的大小关系。枚举类型可以根据名字的字母表顺序来定义实例的大小，也可以根据它包含的数值（假设它包含的都是数字）来定义大小。另一方面，Set对象其实是无法排序的。

如果将对象用于JavaScript的关系比较运算符，比如“<”和“<=”，JavaScript会首先调用对象的valueOf()方法，如果这个方法返回一个原始值，则直接比较原始值。例9-7中由enumeration()方法所返回的枚举类型包含valueOf()方法，因此可以使用关系运算符对它们做有意义的比较。但大多数类并没有valueOf()方法，为了按照显式定义的规则来比较这些类型的对象，可以定义一个名叫copareTo()方法（同样，这里遵循Java中的命名约定）。

compareTo()方法应当只能接收一个参数，这个方法将这个参数和调用它的对象进行比较。如果this对象小于参数对象，compareTo()应当返回比0小的值。如果this对象大于参数对象，应当返回比0大的值。如果两个对象相等，应当返回0。这些关于返回值的约定非常重要，这样我们可以用下面的表达式替换掉关系比较和相等性运算符：

|待替换|替换为|
|------|------|
|a<b|a.compareTo(b)<0|
|a<=b|a.compareTo(b)<=0|
|a>b|a.compareTo(b)>0|
|a>=b|a.compareTo(b)>=0|
|a==b|a.compareTo(b)==0|
|a!=b|a.compareTo(b)!=0|

例9-8中的Card类定义了该类的compareTo()方法，可以给Range类添加一个类似的方法，用以比较它们的下边界：
```javascript
Range.prototype.compareTo = function(that) {
    return this.from - that.from;
};
```
需要注意的是，这个方法中的减法操作根据两个Range对象的关系正确地返回了小于0、等于0和大于0的值。例9-8中的Card.Rank枚举值包含valueOf()方法，其实也可以给Card类实现类似的compareTo()方法。

上文所提到的equals()方法对其参数执行了类型检查，如果参数类型不合法则返回false。compareTo()方法并没有返回一个表示“这两个值不能比较”的值，由于compareTo()没有对参数做任何类型检查，因此如果给compareTo()方法传入错误类型的参数，往往会抛出异常。

注意，如果两个范围对象的下边界相等，为Range类定义的compareTo()方法会返回0.这意味着就compareTo()而言，任何两个起始点相同的Range对象都相等。这个相等概念的定义和equals()方法定义的相等概念是相背的，equals()要求两个端点均相等才算相等。这种相等概念上的差异性会造成很多bug，最好将Range类的equals()和compareTo()方法中处理相等的逻辑保持一致，但当出入不可比较的值时仍然会报错：
```javascript
//根据下边界来对Range对象排序，如果下边界相等则比较上边界
//如果传入非Range值，则抛出异常
//当且仅当this.equals(that)时，才返回0
Range.prototype.compareTo = function(that) {
    if (!(that instanceof Range))
        throw new Error("Can't compare a Range with " + that);
    var diff = this.from - that.from; //比较下边界
    if (diff == 0) diff = this.to - that.to; //如果相等，比较上边界
    return diff;
};
```
给类定义了compareTo()方法，这样就可以对类的实例组成的数组进行排序了。Array.sort()方法可以接收一个可选的参数，这个参数是一个函数，用来比较两个值的大小，这个函数返回值的约定和compareTo()方法保持一致。假定有了上文提到的compareTo()方法，就可以很方便地对Range对象组成的数组进行排序了：
```
ranges.sort(function(a,b) {return a.compareTo(b); });
``` 
排序运算非常重要，如果已经为类定义了实例方法compareTo()，还应当参照这个方法定义一个可传入两个参数的比较函数。使用compareTo()方法可以非常轻松地定义这个函数，比如：
```
Range.byLowerBound = function(a,b) { return a.compareTo(b); };
```
使用这个方法可以让数组排序的操作变得非常简单：
```
ranges.sort(Range.byLowerBound);
```    
有些类可以有很多方法进行排序。比如Card类，可以定义两个方法分别按照花色排序和按照点数排序。

**9.6.5 方法借用**

JavaScript中的方法没有什么特别：无非是一些简单的函数，赋值给了对象的属性，可以通过对象来调用它。一个函数可以赋值给两个属性，然后作为两个方法来调用它。比如，我们在Set类中就这样做了，将toArray()方法创建了一个副本，并让它可以和toJSON()方法一样完成同样的功能。

多个类中的方法可以共用一个单独的函数。比如，Array类通常定义了一些内置方法，如果定义了一个类，它的实例是类数组的对象，则可以从Array.prototype中将函数复制至所定义的类的原型对象中。如果以经典的面向语言的视角来看JavaScript的话，把一个类的方法用到其他的类中的做法也称做“多重继承”（multiple inheritance）。然而，JavaScript并不是经典的面向对象语言，我更倾向于将这种方法重用更正式地称为“方法借用”（borrowing）。

不仅Array的方法可以借用，还可以自定义泛型方法（generic-method）。例9-9定义了泛型方法toString()和equals()，可以被Range、Complex和Card这些简单的类使用。如果Range类没有定义equals()方法，可以这样借用泛型方法equals():
```javascript
Range.prototype.equals = generic.equals;
```
注意，generic.equals()只会执行浅比较，因此这个方法并不适用于其实例太复杂的类，它们的实例属性通过其equals()方法指代对象。同样需要注意，这个方法包含一些特殊情况的程序逻辑，以处理新增至Set对象中的属性（见例9-6）。

例9-9方法借用的泛型实现
```javascript
var generic = {
    // Returns a string that includes the name of the constructor function
    // if available and the names and values of all noninherited, nonfunction
    // properties.
    //返回一个字符串，这个字符串包含构造函数的名字（如果构造函数包含名字）
    //以及所有非继承来的、非函数属性的名字和值
    toString: function() {
        var s = '[';
        // If the object has a constructor and the constructor has a name,
        // use that class name as part of the returned string.  Note that
        // the name property of functions is nonstandard and not supported
        // everywhere.
        // 如果这个对象包含构造函数，且构造函数包含名字
        // 这个名字会作为返回字符串的一部分
        // 需要注意的是，函数的名字属性是非标准的，并不是在所有的环境中都可用
        if (this.constructor && this.constructor.name)
            s += this.constructor.name + ": ";

        // Now enumerate all noninherited, nonfunction properties
        // 枚举所有非继承且非函数的属性
        var n = 0;
        for(var name in this) {
            if (!this.hasOwnProperty(name)) continue;   // skip inherited props，跳过继承来的属性
            var value = this[name];
            if (typeof value === "function") continue;  // skip methods，跳过方法
            if (n++) s += ", ";
            s += name + '=' + value;
        }
        return s + ']';
    },

    // Tests for equality by comparing the constructors and instance properties
    // of this and that.  Only works for classes whose instance properties are
    // primitive values that can be compared with ===.
    // As a special case, ignore the special property added by the Set class.
    // 通过比较this和that的构造函数和实例属性来判断它们是否相等
    // 这种方法只适合于那些实例属性是原始值的情况，原始值可以通过“===”来比较
    // 这里还处理一种特殊情况，就是忽略由Set类添加的特殊属性
    equals: function(that) {
        if (that == null) return false;
        if (this.constructor !== that.constructor) return false;
        for(var name in this) {
            if (name === "|**objectid**|") continue;     // skip special prop，跳过特殊属性
            if (!this.hasOwnProperty(name)) continue;    // skip inherited ，跳过继承来的属性
            if (this[name] !== that[name]) return false; // compare values，比较是否相等
        }
        return true;  // If all properties matched, objects are equal，如果所有属性都匹配，两个对象相等
    }
};
```

**9.6.6 私有状态**

在经典的面向对象编程中，经常需要将对象的某个状态封装或隐藏在对象内，只有通过对象的方法才能访问这些状态，对外只暴露一些重要的状态变量可以直接读写。为了实现这个目的，类似Java的编程语言允许声明类的“私有”实例字段，这些私有实例字段只能被类的实例方法访问，且在类的外部是不可见的。

我们可以通过将变量（或参数）闭包在一个构造函数内来模拟实现私有实例字段，调用构造函数会创建一个实例。为了做到这一点，需要在构造函数内部定义一个函数（因此这个函数可以访问构造函数内部的参数和变量），并将这个函数赋值给新创建对象的属性。例9-10展示了对Range类的另一种封装，新版的类的实例包含from()和to()方法用以返回范围的端点，而不是用from和to属性来获取端点。这里的from()和to()方法是定义在每个Range对象上的，而不是从原型中继承来的。其他的Range方法还是和之前一样定义在原型中，但获取端点的方式从之前直接从属性读取变成了通过from()和to()方法来读取。

例9-10 对Range类的读取端点方法的简单封装
```javascript
function Range(from, to) {
    // Don't store the endpoints as properties of this object. Instead
    // define accessor functions that return the endpoint values.
    // These values are stored in the closure.
    // 不要将端点保存为对象的属性，相反
    // 定义存取器函数来返回端点的值
    // 这些值都保存在闭包中
    this.from = function() { return from; };
    this.to = function() { return to; };
}

// The methods on the prototype can't see the endpoints directly: they have
// to invoke the accessor methods just like everyone else.
// 原型上的方法无法直接操作端点
// 它们必须调用存取器方法
Range.prototype = {
    constructor: Range,
    includes: function(x) { return this.from() <= x && x <= this.to(); },
    foreach: function(f) {
        for(var x=Math.ceil(this.from()), max=this.to(); x <= max; x++) f(x);
    },
    toString: function() { return "(" + this.from() + "..." + this.to() + ")"; }
};
```
这个新的Range类定义了用以读取范围端点的方法，但没有定义设置端点的方法或属性。这让类的实例看起来是不可修改的，如果使用正确的话，一旦创建Range对象，端点数据就不可修改了。除非使用ECMAScript5（参照9.3节）中的某些特性，但from和to属性依然是可写的，并且Range对象实际上并不是真正不可修改的：
```javascript
var r = new Range(1,5); //一个不可修改的范围
r.from = function() {return 0;}; //通过方法替换来修改它
```
但需要注意的是，这种封装技术造成了更多系统的开销。使用闭包来封装类的状态的类一定会比不使用封装的状态变量的等价类运行速度更慢，并占用更多内存。

**9.6.7 构造函数的重载和工厂方法**

有时候，我们希望对象的初始化有多种方式。比如，我们想通过半径和角度（极坐标）来初始化一个Complex对象，而不是通过实部和虚部来初始化，或者通过元素组成的数组来初始化一个Set对象，而不是通过传入构造函数的参数来初始化它。

有一个方法可以实现，通过重载（overload）这个构造函数让它根据传入参数的不同来执行不同的初始化方法。下面这段代码就是重载Set()构造函数的例子：
```javascript
function Set() {
    this.values = {}; //用这个对象的属性来保存这个集合
    this.n = 0; //集合中值的个数
    //如果传入一个类数组的对象，将这个元素添加至集合中
    //否则，将所有的参数都添加至集合中
    if (arguments.length == 1 && isArrayLike(arguments[0]))
        this.add.apply(this, arguments[0]);
    else if (arguments.length > 0)
        this.add.apply(this, arguments);
}
```
这段代码所定义的Set()构造函数可以显式将一组元素作为参数列表传入，也可以传入元素组成的数组。但是这个构造函数有多义性，如果集合的某个成员是一个数组就无法通过这个构造函数来创建这个集合了（为了做到这一点，需要首先创建一个空集合，然后显式调用add()方法）。

在使用极坐标来初始化复数的例子中，实际上并没有看到有函数重载。代表复数两个维度的数字都是浮点数，除非给构造函数传入第三个参数，否则构造函数无法识别到底传入的是极坐标参数还是直角坐标参数。相反，可以写一个工厂方法——一个类的方法用以返回类的一个实例。下面的例子即是使用工厂方法来返回一个使用极坐标初始化的Complex对象：
```javascript
Complex.polar = function(r, theta) {
    return new Complex(r*Math.cos(theta), r*Math.sin(theta));
};
```
下面这个工厂方法用来通过数组初始化Set对象：
```javascript
Set.fromArray = function(a) {
    s = new Set(); //创建一个空集合
    s.add.apply(s, a); //将数组a的成员作为参数传入add()方法
    return s; //返回这个新集合
};
```
可以给工厂方法定义任意的名字，不同名字的工厂方法用以执行不同的初始化。但由于构造函数是类的公有标识，因此每个类只能有一个构造函数。但这并不是一个“必须遵守”的规则。在javascript中是可以定义多个构造函数继承自一个原型对象的，如果这样做的话，由这些构造函数的任意一个所创建的对象都属于同一类型。并不推荐这种技术，但下面的示例代码使用这种技术定义了该类型的一个辅助构造函数：
```javascript
//Set类的一个辅助构造函数
function SetFromArray(a) {
    //通过以函数的形式调用set()来初始化这个新对象
    //将a的元素作为参数传入
    Set.apply(this, a);
}
//设置原型，以便SetFromArray能创建Set的实例
SetFromArray.prototype = Set.prototype;
var s = new SetFromArray([1,2,3]);
s instanceof Set //=>true
```

**9.7子类**

在面向对象编程中，类B可以继承自另一个类A。我们将A称为父类（superclass），将B称为子类（subclass）。B的实例从A继承了所有的实例方法。类B可以定义自己的实例方法，有些方法可以重载类A中的同名方法，如果B的方法重载了A中的方法，B中的重载方法可能会调用A中重载方法，这种做法称为“方法链”（method chaining）。同样，子类的构造函数B()有时需要调用父类的构造函数A()，这种做法称为“构造函数链”（constructor chaining）。
子类还可以有子类，当涉及类的层次结构时，往往需要定义抽象类（abstract-class）。抽象类中定义的方法没有实现。抽象类中的抽象方法是在抽象类的具体子类中实现的。

在JavaScript中创建子类的关键之处在于，采用合适的方法对原型对象进行初始化。如果类B继承自类A，B.prototype必须是A.prototye的后嗣。B的实例继承自B.prototype，后者同样也继承自A.prototype。本节将会对刚才提到的子类相关的术语做一一讲解，还会介绍类继承的替代方案：“组合”（composition）。

我们从例9-6中的Set类开始讲解，本节将会讨论如何定义子类，如何实现构造函数链并重载方法，如何使用组合来代替继承，以及最后如何通过抽象类从实现中提炼出接口。本节以一个扩展的例子结束，这个例子定义了Set类的层次结构。注意，本节开始的几个例子着重讲述了实现子类的基础技术。其中某些技术有着重要的缺陷，后续几节会讲到。

**9.7.1 定义子类**

JavaScript的对象可以从类的原型对象中继承属性（通常继承的是方法）。如果O是类B的实例，B是A的子类，那么O也一定从A继承了属性。为此，首先要确保B的原型对象继承自A的原型对象。通过inherit()函数（例6-1），可以这样来实现：
```javascript
B.prototype = inherit(A.prototype); //子类派生自父类
B.prototype.constructor = B; //重载继承来的constructor属性
```
这两行代码是在JavaScript中创建子类的关键。如果不这样做，原型对象仅仅是一个普通对象，它只继承自Object.prototype，这意味着你的类和所有的类一样是Object的子类。如果将这两行代码添加至defineClass()函数中（参照9.3节），可以将它变成例9-11中的defineSubclass()函数和Function.prototype.extend()方法：
例9-11 定义子类
```javascript
// A simple function for creating simple subclasses
// 用一个简单的函数创建简单的子类
function defineSubclass(superclass,  // Constructor of the superclass，父类的构造函数
                        constructor, // The constructor for the new subclass，新的子类的构造函数
                        methods,     // Instance methods: copied to prototype，实例方法：复制至原型中
                        statics)     // Class properties: copied to constructor，类属性：复制至构造函数中
{
    // Set up the prototype object of the subclass
    // 建立子类的原型对象
    constructor.prototype = inherit(superclass.prototype);
    constructor.prototype.constructor = constructor;
    // Copy the methods and statics as we would for a regular class
    //像对常规类一样复制方法和类属性
    if (methods) extend(constructor.prototype, methods);
    if (statics) extend(constructor, statics);
    // Return the class，返回这个类
    return constructor;
}

// We can also do this as a method of the superclass constructor
// 也可以通过父类构造函数的方法来做到这一点
Function.prototype.extend = function(constructor, methods, statics) {
    return defineSubclass(this, constructor, methods, statics);
};
```

例9-12展示了不使用defineSubclass()函数如何“手动”实现子类。这里定义了Set的子类SingletonSet。SingletonSet是一个特殊的集合，它是可读的，而且含有单独的常量成员。
例9-12：SingletonSet一个简单的子类
```javascript
// The constructor function ，构造函数
function SingletonSet(member) {
    this.member = member;   // Remember the single member of the set，记住集合中这个唯一的成员
}

// Create a prototype object that inherits from the prototype of Set.
// 创建一个原型对象，这个原型对象继承自Set的原型
SingletonSet.prototype = inherit(Set.prototype);

// Now add properties to the prototype，给原型添加属性
// These properties override the properties of the same name from Set.prototype.
// 如果有同名的属性就覆盖Set.prototype中的同名属性
extend(SingletonSet.prototype, {
           // Set the constructor property appropriately
           // 设置合适的constructor属性
           constructor: SingletonSet,
           // This set is read-only: add() and remove() throw errors
           // 这个集合是可读的：调用add()和remove()都会报错
           add: function() { throw "read-only set"; },    
           remove: function() { throw "read-only set"; }, 
           // A SingletonSet always has size 1
           // SingletonSet的实例中永远只有一个元素
           size: function() { return 1; },                
           // Just invoke the function once, passing the single member.
           // 这个方法只调用一次，传入这个集合的唯一成员
           foreach: function(f, context) { f.call(context, this.member); },
           // The contains() method is simple: true only for one value
           // contains()方法非常简单：只须检查传入的值是否匹配这个集合唯一的成员即可
           contains: function(x) { return x === this.member; }
       });
```
这里的SingleSet类是一个比较简单的实现，它包含5个简单的方法定义。它实现了5个核心的set方法，但从它的父类中继承了toString()、toArray()和equals()方法。定义子类就是为了继承这些方法。比如，Set类的equals()方法（在9.4节中定义）用来对Set实例进行比较，只要Set的实例包含size()和foreach()方法，就可以通过equals()比较。因为SingletonSet是Set的子类，所以它自动继承了equals()的实现，不用再实现一次。当然，如果想要最简单的实现方式，那么给SingletonSet类定义它自己的equals()版本就会更高效一些：
```javascript
SingletonSet.prototype.euqals = function(that) {
    return that instanceof Set && that.size() == 1 && that.contains(this.member);
}
```
需要注意的是，SingletonSet不是将Set中的方法列表静态地借用过来，而是动态从Set类继承方法。如果给Set.prototype添加新的方法，Set和SingletonSet的所有实例就会立即拥有这个方法（假定SingletonSet没有定义与同名的方法）。

**9.7.2 构造函数和方法链**

最后一节的SingletonSet类定义了全新的集合实现，而且将它继承自其父类的核心方法全部替换。然而定义子类时，我们往往希望对父类的行为进行修改或扩充，而不是完全替换掉它们。为了做到这一点，构造函数和子类的方法需要调用或链接到父类构造函数和父类方法。

例9-13对此做了展示。它定义了Set的子类NonNullSet，它不允许null和undefined作为它的成员。为了使用这种方式对成员做限制，NonNullSet需要在其add()方法中对null和undefined值做检测。但它需要完全重新实现一个add()方法，因此它调用了父类中的这个方法。注意，NonNullSet()构造函数同样不需要重新实现，它只须将它的参数传入父类构造函数（作为函数来调用它，而不是通过构造函数来调用），通过父类的构造函数来初始化新创建的对象。
例9-13 在子类中调用父类的构造函数和方法
```javascript
/*
 * NonNullSet is a subclass of Set that does not allow null and undefined
 * as members of the set.
 * NonNullSet 是set的子类，它的成员不能是null和undefined
 */
function NonNullSet() {
    // Just chain to our superclass，仅链接到父类
    // Invoke the superclass constructor as an ordinary function to initialize
    // the object that has been created by this constructor invocation.
    //作为普通函数调用父类的构造函数来初始化通过该构造函数调用创建的对象
    Set.apply(this, arguments);
}

// Make NonNullSet a subclass of Set:
//将NonNullSet设置为Set的子类
NonNullSet.prototype = inherit(Set.prototype);
NonNullSet.prototype.constructor = NonNullSet;

// To exclude null and undefined, we only have to override the add() method
// 为了将null和undefined排除在外，只须重写add()方法
NonNullSet.prototype.add = function() {
    // Check for null or undefined arguments
    // 检查参数是不是null或undefined
    for(var i = 0; i < arguments.length; i++)
        if (arguments[i] == null)
            throw new Error("Can't add null or undefined to a NonNullSet");

    // Chain to the superclass to perform the actual insertion
    // 调用父类的add()方法以执行实际插入操作
    return Set.prototype.add.apply(this, arguments);
};
```
让我们将这个非null集合的概念推而广之，称为“过滤后的集合”，这个集合中的成员必须首先传入一个过滤函数再执行添加操作。为此，定义一个类工厂函数（类似例9-7中的enumeration()函数），传入一个过滤函数，返回一个新的Set子类。实际上，可以对此做进一步的通用化的处理，定义一个可以接收两个参数的类工厂：子类和用于add()方法的过滤函数。这个工厂方法称为filteredsetSubclass()，并通过这样的代码来使用它：
```javascript
//定义一个只能保存字符串的“集合”类
var StringSet = filteredSetSubclass(set, function(x) {return typeof x === "string";});
//这个集合类的成员不能是null、undefined或函数
var MySet = filteredSetSubclass(NonNullSet, function(x) {return typeof x !== "function";});
```
例9-14是这个类工厂函数的实现代码。注意 ，这个例子中的方法链和构造函数链和NonNullset中的实现是一样的。

例9-14 类工厂和方法链
```javascript
/*
 * This function returns a subclass of specified Set class and overrides 
 * the add() method of that class to apply the specified filter.
 * 这个函数返回具体Set类的子类
 * 并重写该类的add()方法用以对添加的元素做特殊的过滤
 */
function filteredSetSubclass(superclass, filter) {
    var constructor = function() {          // The subclass constructor，子类构造函数
        superclass.apply(this, arguments);  // Chains to the superclass，调用父类构造函数
    };
    var proto = constructor.prototype = inherit(superclass.prototype);
    proto.constructor = constructor;
    proto.add = function() {
        // Apply the filter to all arguments before adding any
        // 在添加任何成员之前首先使用过滤器将所有参数进行过滤
        for(var i = 0; i < arguments.length; i++) {
            var v = arguments[i];
            if (!filter(v)) throw("value " + v + " rejected by filter");
        }
        // Chain to our superclass add implementation
        // 调用父类的add()方法
        superclass.prototype.add.apply(this, arguments);
    };
    return constructor;
}
```
例9-14中一个比较有趣的事情是，用一个函数将创建子类的代码包装起来，这样就可以在构造函数和方法链中使用父类的参数，而不是通过写死某个父类的名字来使用它的参数。也就是说如果想修改父类，只须修改一处代码即可，而不必对每个用到父类类名的地方都做修改。已经有充足的理由证明这种技术的可行性，即使不是定义类工厂的场景中，这种技术也是值得提倡使用的。比如，可以这样使用包装函数和例9-11的Function.prototype.extend()方法来重写NonNullSet：
```javascript
var NonNullSet = (function(){ //定义并立即调用这个函数
    var superclass = Set;       //仅指定父类
    return superclass.extend(
        function() {superclass.apply(this, arguments);},  //构造函数
        {
            add: function() {
                //检查参数是否是null或undefined
                for (var i = 0; i < arguments.length; i++)
                    if (arguments[i] == null)
                        throw new Error("can't add null or undefined");
                //调用父类的add()方法以执行实际插入操作
                return superclass.prototype.add.apply(this, arguments);
            }
        });
}());
```
最后，值得强调的是，类似这种创建类工厂的能力是javascript语言动态特性的一个体现，类工厂是一种非常强大和有用的特性，这在java和c++语言中是没有的。

**9.7.3 组合vs子类**

在前一节中，定义的集合可以根据特定的标准对集合成员做限制，而且使用了子类的技术来实现这种功能，所创建的自定义子类使用了特定的过滤函数来对集合中的成员做限制。父类和过滤函数的每个组合都需要创建一个新的类。

然而还有另一种更好的方法来完成这种需求，即面向对象编程中一条广为人知的设计原则：“组合优于继承”。这样，可以利用组合的原理定义一个新的集合实现，它“包装”了另外一个集合对象，在将受限制的成员过滤掉之后会用到这个（包装的）集合对象。例9-15展示了其工作原理：
例9-15：使用组合代替继承的集合的实现
```javascript
/*
 * A FilteredSet wraps a specified set object and applies a specified filter
 * to values passed to its add() method.  All of the other core set methods 
 * simply forward to the wrapped set instance.
 * 实现一个FilteredSet，它包装某个指定的“集合”对象，并对传入add()方法的值应用了某种指定的过滤器
 * “范围”类中其他所有的核心方法延续到包装后的实例中
 */
var FilteredSet = Set.extend(
    function FilteredSet(set, filter) {  // The constructor
        this.set = set;
        this.filter = filter;
    }, 
    {  // The instance methods，实例方法
        add: function() {
            // If we have a filter, apply it，如果已有过滤器，直接使用它
            if (this.filter) {
                for(var i = 0; i < arguments.length; i++) {
                    var v = arguments[i];
                    if (!this.filter(v))
                        throw new Error("FilteredSet: value " + v +
                                        " rejected by filter");
                }
            }

            // Now forward the add() method to this.set.add()，调用set中的add()方法
            this.set.add.apply(this.set, arguments);
            return this;
        },
        // The rest of the methods just forward to this.set and do nothing else.，剩下的方法都保持不变
        remove: function() {
            this.set.remove.apply(this.set, arguments);
            return this;
        },
        contains: function(v) { return this.set.contains(v); },
        size: function() { return this.set.size(); },
        foreach: function(f,c) { this.set.foreach(f,c); }
    });
```
在这个例子中使用组合的一个好处是，只须创建一个单独的FilteredSet子类即可。可以利用这个类的实例来创建任意带有成员限制的集合实例。比如，不用上文中定义的NonNullSet类，可以这样做：

    var s = new FilteredSet(new Set(), function(x) { return x !== null; });
    
甚至还可以对已经过滤后的集合进行过滤：

    var t = new FilteredSet(s, { function(x) {return !(x instanceof Set); }});


**9.7.4 类的层次结构和抽象类**

在上一节中给出了“组合优于继承”的原则，但为了将这条原则阐述清楚，创建了Set的子类。这样做的原因是最终得到的类是Set的实例，它会从Set继承有用的辅助方法，比如toString()和equals()。尽管这是一个很实际的原因，但不用创建类似Set类这种具体类的子类也可以很好的用组合来实现“范围”。例9-12中的SingletonSet类可以有另外一种类似的实现，这个类还是继承自Set，因此它可以继承很多辅助方法，但它的实现和其父类的实现完全不一样。SingletonSet并不是Set类的专用版本，而是完全不同的另一种Set。在类层次结构中的SingletonSet和Set应当是兄弟的关系，而非父子关系。

不管是在经典的面向对象编程语言中还是在javascript中，通行的解决方法是“从实现中抽离出接口”。假定定义了一个AbstractSet类，其中定义了一些辅助方法比如toString(),但并没有实现诸如foreach()的核心方法。这样，实现的Set、SingletonSet和FilteredSet都是这个抽象类的子类，FilteredSet和SingletonSet都不必再实现为某个不相关的类的子类了。

例9-16在这个思路上更近一步，定义了一个层次结构的抽象的集合类。AbstractSet只定义了一个抽象方法：contains()。任何类只要“声称”自己是一个表示范围的类，就必须至少定义这个contains()方法。然后，定义AbstractSet的子类AbstractEnumerableSet。这个类增加了抽象的size()和foreach()方法，而且定义了一些有用的非抽象方法（toString()、toArray()、equals()等），AbstractEnumerableSet并没有定义add()和remove()方法，它只代表只读集合。SingletonSet可以实现为非抽象子类。最后，定义了AbstractEnumerableSet的子类AbstractWritableSet。这个final抽象集合定义了抽象方法add()和remove()，并实现了诸如union()和intersection()等非具体方法，这两个方法调用了add()和remove()。AbstractWritableSet是Set和FilteredSet类相应的父类。但这个例子中并没有实现它，而是实现了一个新的名叫ArraySet的非抽象类。
例9-16中的代码很长，但还是应当完整地阅读一遍。注意这里用到了Function.prototype.extend()作为创建子类的快捷方式。
例9-16：抽象类和非抽象Set类的层次结构
```javascript
// A convenient function that can be used for any abstract method
// 这个函数可以用做任何抽象方法，非常方便
function abstractmethod() { throw new Error("abstract method"); }

/*
 * The AbstractSet class defines a single abstract method, contains().
 * AbstractSet类定义了一个抽象方法：contains()
 */
function AbstractSet() { throw new Error("Can't instantiate abstract classes");}
AbstractSet.prototype.contains = abstractmethod;

/*
 * NotSet is a concrete subclass of AbstractSet.
 * The members of this set are all values that are not members of some
 * other set. Because it is defined in terms of another set it is not
 * writable, and because it has infinite members, it is not enumerable.
 * All we can do with it is test for membership.
 * Note that we're using the Function.prototype.extend() method we defined
 * earlier to define this subclass.
 * NotSet是AbstractSet的一个非抽象子类
 * 所有不在其他集合中的成员都在这个集合中
 * 因为它是在其他集合是不可写的条件下定义的
 * 同时由于它的的成员是无限个，因此它是不可枚举的
 * 我们只能用它来检测元素成员的归属情况
 * 注意，我们使用了Function.prototype.extend()方法来定义这个子类
 */
var NotSet = AbstractSet.extend(
    function NotSet(set) { this.set = set; },
    {
        contains: function(x) { return !this.set.contains(x); },
        toString: function(x) { return "~" + this.set.toString(); },
        equals: function(that) {
            return that instanceof NotSet && this.set.equals(that.set);
        }
    }
);


/*
 * AbstractEnumerableSet is an abstract subclass of AbstractSet.
 * It defines the abstract methods size() and foreach(), and then implements
 * concrete isEmpty(), toArray(), to[Locale]String(), and equals() methods
 * on top of those. Subclasses that implement contains(), size(), and foreach() 
 * get these five concrete methods for free.
 * AbstractEnumerableSet是AbstractSet的一个抽象子类
 * 它定义了抽象方法size()和foreach()
 * 然后实现了非抽象方法isEmpty()、toArray()、to[Locale]String()和equals()方法
 * 子类实现了contains()、size()和foreach()，这三个方法可以很轻易地调用这5个非抽象方法
 */
var AbstractEnumerableSet = AbstractSet.extend(
    function() { throw new Error("Can't instantiate abstract classes"); }, 
    {
        size: abstractmethod,
        foreach: abstractmethod,
        isEmpty: function() { return this.size() == 0; },
        toString: function() {
            var s = "{", i = 0;
            this.foreach(function(v) {
                             if (i++ > 0) s += ", ";
                             s += v;
                         });
            return s + "}";
        },
        toLocaleString : function() {
            var s = "{", i = 0;
            this.foreach(function(v) {
                             if (i++ > 0) s += ", ";
                             if (v == null) s += v; // null & undefined
                             else s += v.toLocaleString(); // all others，其他的情况
                         });
            return s + "}";
        },
        toArray: function() {
            var a = [];
            this.foreach(function(v) { a.push(v); });
            return a;
        },
        equals: function(that) {
            if (!(that instanceof AbstractEnumerableSet)) return false;
            // If they don't have the same size, they're not equal
            // 如果他们的大小不同，则它们不相等
            if (this.size() != that.size()) return false;
            // Now check whether every element in this is also in that.
            // 检查每一个元素是否也在that中
            try {
                this.foreach(function(v) {if (!that.contains(v)) throw false;});
                return true;  // All elements matched: sets are equal，所有的元素都匹配：集合相等
            } catch (x) {
                if (x === false) return false; // Sets are not equal，集合不相等
                throw x; // Some other exception occurred: rethrow it，发生了其他的异常：重新抛出异常
            }
        }
    });

/*
 * SingletonSet is a concrete subclass of AbstractEnumerableSet.
 * A singleton set is a read-only set with a single member.
 * SingletonSet是AbstractEnumerableSet的非抽象子类
 * singleton集合是只读的，它只包含一个成员
 */
var SingletonSet = AbstractEnumerableSet.extend(
    function SingletonSet(member) { this.member = member; },
    {
        contains: function(x) {  return x === this.member; },
        size: function() { return 1; },
        foreach: function(f,ctx) { f.call(ctx, this.member); }
    }
);


/*
 * AbstractWritableSet is an abstract subclass of AbstractEnumerableSet.
 * It defines the abstract methods add() and remove(), and then implements
 * concrete union(), intersection(), and difference() methods on top of them.
 * AbstractWritableSet是AbstractEnumerableSet的抽象子类
 * 它定义了抽象方法add()和remove()
 * 然后实现了非抽象方法union()、intersection()和difference()
 */
var AbstractWritableSet = AbstractEnumerableSet.extend(
    function() { throw new Error("Can't instantiate abstract classes"); }, 
    {
        add: abstractmethod,
        remove: abstractmethod,
        union: function(that) {
            var self = this;
            that.foreach(function(v) { self.add(v); });
            return this;
        },
        intersection: function(that) {
            var self = this;
            this.foreach(function(v) { if (!that.contains(v)) self.remove(v);});
            return this;
        },
        difference: function(that) {
            var self = this;
            that.foreach(function(v) { self.remove(v); });
            return this;
        }
    });

/*
 * An ArraySet is a concrete subclass of AbstractWritableSet.
 * It represents the set elements as an array of values, and uses a linear
 * search of the array for its contains() method. Because the contains()
 * method is O(n) rather than O(1), it should only be used for relatively
 * small sets. Note that this implementation relies on the ES5 Array methods
 * indexOf() and forEach().
 * ArraySet是AbstractWritableSet的非抽象子类
 * 它以数组的形式表示集合中的元素
 * 对于它的contains()方法使用了数组的线性查找
 * 因为contains()方法的算法复杂度是O(n)而不是O(1)
 * 它非常适用于相对小型的集合，注意，这里的实现用到了ES5的数组方法indexOf()和forEach()
 */
var ArraySet = AbstractWritableSet.extend(
    function ArraySet() {
        this.values = [];
        this.add.apply(this, arguments);
    },
    {
        contains: function(v) { return this.values.indexOf(v) != -1; },
        size: function() { return this.values.length; },
        foreach: function(f,c) { this.values.forEach(f, c); },
        add: function() { 
            for(var i = 0; i < arguments.length; i++) {
                var arg = arguments[i];
                if (!this.contains(arg)) this.values.push(arg);
            }
            return this;
        },
        remove: function() {
            for(var i = 0; i < arguments.length; i++) {
                var p = this.values.indexOf(arguments[i]);
                if (p == -1) continue;
                this.values.splice(p, 1);
            }
            return this;
        }
    }
);
```


**9.8ECMAScript5中的类**

ECMAScript5给属性特性增加了方法支持（getter、setter、可枚举性、可写性和可配置性），而且增加了对象可扩展性的限制。这些方法在6.6节、6.7节和6.8.3节都有详细的讨论，然而这些方法非常适合用于类的定义。下面几节讲述了如何使用ECMAScript5的特性来使类更加健壮。

**9.8.1让属性不可枚举**

例9-6中的Set类使用了一个小技巧，将对象存储为“集合”的成员：它给添加至这个“集合”的任何对象定义了“对象id”属性。之后如果在for/in循环中对这个对象做遍历，这个新添加的属性也会遍历到。ECMAScript5可以通过设置属性为“不可枚举”（nonenumerable）来让属性不会遍历到。例9-17展示了如何通过Object.defineProperty()来做这一点，同时也展示了如何定义一个getter函数以及检测对象是否可扩展的（extensible）。

例9-17：定义不可枚举的属性
```javascript
// Wrap our code in a function so we can define variables in the function scope
// 将代码包装在一个匿名函数中，这样定义的变量就在这个函数作用域内
(function() { 
     // Define objectId as a nonenumerable property inherited by all objects.
     // 定义一个不可枚举的属性objectId，它可以被所有对象继承
     // When this property is read, the getter function is invoked.
     // 当读取这个属性时调用getter函数
     // It has no setter, so it is read-only.
     // 它没有定义setter，因此它是只读的
     // It is nonconfigurable, so it can't be deleted.
     // 它是不可配置的，因此它是不能删除的
     Object.defineProperty(Object.prototype, "objectId", {
                               get: idGetter,       // Method to get value，取值器
                               enumerable: false,   // Nonenumerable，不可枚举
                               configurable: false  // Can't delete it，不可删除的
                           });

     // This is the getter function called when objectId is read
     // 当读取objectId的时候直接调用这个getter函数
     function idGetter() {             // A getter function to return the id，getter函数返回该id
         if (!(idprop in this)) {      // If object doesn't already have an id，如果对象中不存在id
             if (!Object.isExtensible(this)) // And if we can add a property，并且可以增加属性
                 throw Error("Can't define id for nonextensible objects");
             Object.defineProperty(this, idprop, {         // Give it one now.，给它一个值
                                       value: nextid++,    // This is the value，就是这个值
                                       writable: false,    // Read-only，只读的
                                       enumerable: false,  // Nonenumerable，不可枚举的
                                       configurable: false // Nondeletable，不可删除的
                                   });
         }
         return this[idprop];          // Now return the existing or new value，返回已有的或新的值
     };

     // These variables are used by idGetter() and are private to this function
     // idGetter()用到了这些变量，这些都属于私有变量的
     var idprop = "|**objectId**|";    // Assume this property isn't in use，假设这个属性没有用到
     var nextid = 1;                   // Start assigning ids at this #，给它设置初始值

}()); // Invoke the wrapper function to run the code right away，立即执行这个包装函数
```

**9.8.2定义不可变的类**

除了可以设置属性为不可枚举的，ECMAScript5还可以设置属性为只读的，当我们希望类的实例都是不可变的，这个特性非常有帮助。例9-18使用Object.defineProperties()和Object.create()定义不可变的Range类。它同样使用Object.defineProperties()来为类创建原型对象，并将（原型对象的）实例方法设置为不可枚举的，就像内置类的方法一样。不仅如此，它还将这些实例方法设置为“只读”和“不可删除”，这样就可以防止类做任何修改（monkey-patching）。最后，例9-18展示了一个有趣的技巧，其中实现的构造函数也可以用做工厂函数，这样不论调用函数之前是否带有new关键字，都可以正确地创建实例。
例9-18 创建一个不可变得类，它的属性和方法都是只读的
```javascript
// This function works with or without 'new': a constructor and factory function
// 这个方法可以使用new调用，也可以省略new，它可以用做构造函数也可以用做工厂函数
function Range(from,to) {
    // These are descriptors for the read-only from and to properties.
    // 这些是对from和to只读属性的描述符
    var props = {
        from: {value:from, enumerable:true, writable:false, configurable:false},
        to: {value:to, enumerable:true, writable:false, configurable:false}
    };
    
    if (this instanceof Range)                // If invoked as a constructor，如果作为构造函数来调用
        Object.defineProperties(this, props); // Define the properties，定义属性
    else                                      // Otherwise, as a factory ，否则，作为工厂方法来调用
        return Object.create(Range.prototype, // Create and return a new，创建并返回这个新的Range对象，
                             props);          // Range object with props，属性由props指定
}

// If we add properties to the Range.prototype object in the same way,
// 如果用同样的方法给Rang.prototype对象添加属性
// then we can set attributes on those properties.  Since we don't specify
// 那么我们需要给这些属性设置它们的特性
// enumerable, writable, or configurable, they all default to false.
// 因为我们无法识别它们的可枚举性、可写性或可配置性，这些属性特性默认都是false
Object.defineProperties(Range.prototype, {
    includes: {
        value: function(x) { return this.from <= x && x <= this.to; }
    },
    foreach: {
        value: function(f) {
            for(var x = Math.ceil(this.from); x <= this.to; x++) f(x);
        }
    },
    toString: {
        value: function() { return "(" + this.from + "..." + this.to + ")"; }
    }
});
```
例9-18用到了Object.defineProperties()和Object.create()来定义不可变的和不可枚举的属性。这两个方法非常强大，但属性描述符对象让代码的可读性变得更差。另一种改进的做法是将修改这个已定义属性的特性的操作定义为一个工具函数，例9-19展示了两个这样的工具函数：
例9-19 属性描述符工具函数
```javascript
// Make the named (or all) properties of o nonwritable and nonconfigurable.
// 将o的指定名字（或所有）的属性设置为不可写的和不可配置的
function freezeProps(o) {
    var props = (arguments.length == 1)              // If 1 arg，如果只有一个参数
        ? Object.getOwnPropertyNames(o)              //  use all props，使用所有的属性
        : Array.prototype.splice.call(arguments, 1); //  else named props，否则传入了指定名字的属性
    props.forEach(function(n) { // Make each one read-only and permanent，将它们都设置为只读的和不可变的
        // Ignore nonconfigurable properties，忽略不可配置的属性
        if (!Object.getOwnPropertyDescriptor(o,n).configurable) return;
        Object.defineProperty(o, n, { writable: false, configurable: false });
    });
    return o;  // So we can keep using it，所以我们可以继续使用它   
}

// Make the named (or all) properties of o nonenumerable, if configurable.
// 将o的指定名字（或所有）属性设置为不可枚举的和可配置的
function hideProps(o) {
    var props = (arguments.length == 1)              // If 1 arg，如果只有一个参数
        ? Object.getOwnPropertyNames(o)              //  use all props，使用所有的属性
        : Array.prototype.splice.call(arguments, 1); //  else named props，否则传入了指定名字的属性
    props.forEach(function(n) { // Hide each one from the for/in loop，将它们设置为不可枚举的
        // Ignore nonconfigurable properties，忽略不可配置的属性
        if (!Object.getOwnPropertyDescriptor(o,n).configurable) return;
        Object.defineProperty(o, n, { enumerable: false });
    });
    return o;
}
```
Object.defineProperty()和Object.defineProperties()可以用来创建新属性，也可以修改已有属性的特性。当用它们创建新属性时，默认的属性特性的值都是false。但当用它们修改已经存在的属性时，默认的属性特性依然保持不变。比如，在上面的hideProps()函数中，只指定了enumerable特性，因为我们只想修改enumerable特性。

使用这些工具函数，就可以充分利用ECMAScriptd5的特性来实现一个不可变的类，而且不用动态地修改这个类。例9-20中不可变的Range类就用到了刚才定义的工具函数。
例9-20 一个简单的不可变类
```javascript
function Range(from, to) {    // Constructor for an immutable Range class，不可变的类Range的构造函数
    this.from = from;
    this.to = to;
    freezeProps(this);        // Make the properties immutable，将属性设置为不可变的
}

Range.prototype = hideProps({ // Define prototype with nonenumerable properties，使用不可枚举的属性来定义原型
    constructor: Range,
    includes: function(x) { return this.from <= x && x <= this.to; },
    foreach: function(f) {for(var x=Math.ceil(this.from);x<=this.to;x++) f(x);},
    toString: function() { return "(" + this.from + "..." + this.to + ")"; }
});
```

**9.8.3封装对象状态**

如9.6.6节和例9-10所示，构造函数中的变量和参数可以用做它创建的对象的私有状态。该方法在ECMAScript3的一个缺点是，访问这些私有状态的存取器方法是可以替换的。在ECMAScript5中可以通过定义属性getter和setter方法将状态变量更健壮地封装起来，这两个方法是无法删除的，如例9-21所示。
例9-21 将Range类的端点严格封装起来
```javascript
// This version of the Range class is mutable but encapsulates its endpoint
// 这个版本的Range类是可变的，但将端点变量进行了良好的封装
// variables to maintain the invariant that from <= to.
// 当端点的大小顺序还是固定的：from <= to
function Range(from, to) {
    // Verify that the invariant holds when we're created，如果from大于to
    if (from > to) throw new Error("Range: from must be <= to");

    // Define the accessor methods that maintain the invariant，定义存取器方法以维持不变
    function getFrom() {  return from; }
    function getTo() {  return to; }
    function setFrom(f) {  // Don't allow from to be set > to，设置from的值时，不允许from大于to
        if (f <= to) from = f;
        else throw new Error("Range: from must be <= to");
    }
    function setTo(t) {    // Don't allow to to be set < from，设置to的值时，不允许to小于from
        if (t >= from) to = t;
        else throw new Error("Range: to must be >= from");
    }

    // Create enumerable, nonconfigurable properties that use the accessors
    // 将使用取值器的属性设置为可枚举的、不可配置的
    Object.defineProperties(this, {
        from: {get: getFrom, set: setFrom, enumerable:true, configurable:false},
        to: { get: getTo, set: setTo, enumerable:true, configurable:false }
    });
}

// The prototype object is unchanged from previous examples.
// 和前面的例子相比，原型对象没有做任何修改
// The instance methods read from and to as if they were ordinary properties.
// 实例方法可以像读取普遍的属性一样读取from和to
Range.prototype = hideProps({
    constructor: Range,
    includes: function(x) { return this.from <= x && x <= this.to; },
    foreach: function(f) {for(var x=Math.ceil(this.from);x<=this.to;x++) f(x);},
    toString: function() { return "(" + this.from + "..." + this.to + ")"; }
});
```

**9.8.4防止类的扩展**

通常认为，通过给原型对象添加方法可以动态地对类进行扩展，这是javascript本身的特性。ECMAScript5可以根据需要对此特性加以限制。Object.preventExtensions()可以将对象设置为不可扩展的（见6.8.3节），也就是说不能给对象添加任何新属性。Object.seal()则更加强大，它除了能阻止用户给对象添加新属性，还能将当前已有的属性设置为不可配置的，这样就不能删除这些属性了（但不可配置的属性可以是可写的，也可以转换为只读属性）。可以通过这样一句简单的代码来阻止对Object.prototype的扩展：

    Object.seal(Object.prototype);
    
javascript的另外一个动态特性是“对象的方法可以随时替换”（或称为“monkey-patch”）：
```javascript
var original_sort_method = Array.prototype.sort;
Array.prototype.sort = function() {
    var start = new Date();
    original_sort_method.apply(this, arguments);
    var end = new Date();
    console.log("Array sort took " + (end - start) + " milliseconds.");
};
```
可以通过将实例方法设置为只读来防止这类修改，一种方法就是使用上面代码所定义的freezeProps()工具函数。另外一种方法是使用Object.freeze()，它的功能和Object.seal()完全一样，它同样会把所有属性都设置为只读的和不可配置的。

理解类的只读属性的特性至关重要。如果对象o继承了只读属性p，那么给o.p的赋值操作将会失败，就不会给o创建新属性。如果你想重写一个继承来的只读属性，就必须使用Object.definePropertiy()、Object.defineProperties()或Object.create()来创建这个新属性。也就是说，如果将类的实例方法设置为只读的，那么重写它的子类的这些方法的难度会更大。

这种锁定原型对象的做法往往没有必要，但的确有一些场景是需要阻止对象的扩展的。回想一下例9-7中的enumeration()，这是一个类工厂函数。这个函数将枚举类型的每个实例都保存在构造函数对象的属性里，以及构造函数的values数组中。这些属性和数组是表示枚举类型实例的正式实例列表，是可以执行“冻结”（freezing）操作的，这样就不能给它添加新的实例，已有实例也无法删除或修改。可以给enumeration()函数添加几行简单的代码：
```javascript
Object.freeze(enumeration.values);
Object.freeze(enumeration);
```
需要注意的是，通过在枚举类型中调用Object.freeze()，例9-17中定义的objectId属性之后也无法使用了。这个问题的解决方法是，在枚举类型被“冻结”之前读取一次它的objectId属性（调用潜在的存取器方法并设置内部属性）。

**9.8.5 子类和ECMAScript5**

例9-22使用ECMAScript5的特性实现子类。这里使用例9-16中的AbstractWritableSet类来做进一步的说明，来定义这个类的子类StringSet。下面这个例子的最大特点是使用Object.create()创建原型对象，这个原型对象继承自父类的原型，同时给新创建的对象定义属性。这种实现方法的困难之处在于，正如上文所提到的，它需要使用难看的属性描述符。

这个例子中另外一个有趣之处在于，使用Object.create()创建对象时传入了参数null，这个创建的对象没有任何继承任何成员。这个对象用来存储集合的成员，同时，这个对象没有原型，这样我们就能对它直接使用in运算符，而不须使用hasOwnPropery()方法。

例9-22：StringSet：利用ECMAScript5的特性定义的子类
function StringSet() {
    this.set = Object.create(null); //创建一个不包含原型的对象
    this.n = o;
    this.add.apply(this, arguments);
}
//注意，使用Object.create()可以继承父类的原型
//而且可以定义单独调用的方法，因为我们没有指定属性的可写性、可枚举性和可配置性
//因此这些属性特性的默认值都是false
//只读方法让这个类难于子类化（被继承）
StringSet.prototype = Object.create(AbstractWritableSet.prototype,{
    constructor: { value: StringSet },
    contains: { value: function(x) {return x in this.set;} },
    size: { value: function(x) { return this.n; } },
    foreach: { value: function(f, c) { Object.keys(this.set).forEach(f, c); } },
    add: {
        value: function(){
            for (var i = 0; i< arguments.length; i++) {
                if (!(arguments[i] in this.set)) {
                    this.set[arguments[i]] = true;
                    this.n++;
                }
            }
        }
    },
    remove: {
        value: function() {
            for (var i = 0; i < arguments.length; i++) {
                if (arguments[i] in this.set) {
                    delete this.set[arguments[i]];
                    this.n--
                }
            }
            return this;
        }
    }
});

**9.8.6属性描述符**

6.7节讨论了ECMAScript5中的属性描述符，但没有给出它们的示例代码。本节给出一个例子，用来讲述基于ECMAScript5如何对属性进行各种操作。在例9-23中给Object.prototype添加了properties()方法（这个方法是不可枚举的）。这个方法的返回值是一个对象，用以表示属性的列表，并定义了有用的方法用来输出属性和属性特征（对于调试非常有用），用来获得属性描述符（当复制属性同时复制属性特性时特别有用）以及用来设置属性的特性（是上文定义的hideProps()和freezeProps()函数不错的替代方案。）这个例子展示了ECMAScript5的大多数属性相关的特性，同时使用了一种模块编程技术，这将在下一节讨论。

例9-23：ECMAScript5 属性操作
```javascript
/*
 * Define a properties() method in Object.prototype that returns an
 * object representing the named properties of the object on which it
 * is invoked (or representing all own properties of the object, if
 * invoked with no arguments).  The returned object defines four useful 
 * methods: toString(), descriptors(), hide(), and show().
 * 给Objec.prototype定义properties()方法，这个方法返回一个表示调用它的对象上的属性名列表的对象
 * （如果不带参数调用它，就表示该对象的所有属性）
 * 返回的对象定义了4个有用的方法：toString()、descriptors()、hide()和show()
 */
(function namespace() {  // Wrap everything in a private function scope，将所有逻辑闭包在一个私有函数作用域中
     // This is the function that becomes a method of all object，这个函数成为所有对象的方法
     function properties() {
         var names;  // An array of property names，属性名组成的数组
         if (arguments.length == 0)  // All own properties of this，所有的自有属性
             names = Object.getOwnPropertyNames(this);
         else if (arguments.length == 1 && Array.isArray(arguments[0]))
             names = arguments[0];   // Or an array of names，名字组成的数组
         else                        // Or the names in the argument list，参数列表本身就是名字
             names = Array.prototype.splice.call(arguments, 0);
         // Return a new Properties object representing the named properties，返回一个新的Properties对象，用以表示属性名字
         return new Properties(this, names);
     }
     // Make it a new nonenumerable property of Object.prototype.将它设置为Object.prototype的新的不可枚举的属性
     // This is the only value exported from this private function scope.这是从私有函数作用域导出的唯一一个值
     Object.defineProperty(Object.prototype, "properties", {
         value: properties,  
         enumerable: false, writable: true, configurable: true
     });

     // This constructor function is invoked by the properties() function above.这个构造函数是由上面的properties()函数所调用
     // The Properties class represents a set of properties of an object.Properties类表示一个对象的属性集合
     function Properties(o, names) {
         this.o = o;            // The object that the properties belong to 属性所属的对象
         this.names = names;    // The names of the properties 属性的名字
     }
     // Make the properties represented by this object nonenumerable 将代表这些属性的对象设置为不可枚举的
     Properties.prototype.hide = function() {
         var o = this.o, hidden = { enumerable: false };
         this.names.forEach(function(n) {
                                if (o.hasOwnProperty(n))
                                    Object.defineProperty(o, n, hidden);
                            });
         return this;
     };

     // Make these properties read-only and nonconfigurable 将这些属性设置为只读的和不可配置的
     Properties.prototype.freeze = function() {
         var o = this.o, frozen = { writable: false, configurable: false };
         this.names.forEach(function(n) {
                                if (o.hasOwnProperty(n))
                                    Object.defineProperty(o, n, frozen);
                            });
         return this;
     };

     // Return an object that maps names to descriptors for these properties.返回一个对象，这个对象是名字到属性描述符的映射表
     // Use this to copy properties along with their attributes:使用它来赋值属性，连同属性特性一起复制
     // Object.defineProperties(dest, src.properties().descriptors());
     Properties.prototype.descriptors = function() {
         var o = this.o, desc = {};
         this.names.forEach(function(n) {
                                if (!o.hasOwnProperty(n)) return;
                                desc[n] = Object.getOwnPropertyDescriptor(o,n);
                            });
         return desc;
     };

     // Return a nicely formatted list of properties, listing the 
     // name, value and attributes. Uses the term "permanent" to mean
     // nonconfigurable, "readonly" to mean nonwritable, and "hidden"
     // to mean nonenumerable. Regular enumerable, writable, configurable 
     // properties have no attributes listed.
     //返回一个格式化良好的属性列表，列表中包含名字、值和属性特性，使用“permanent”表示不可配置
     //使用“readonly”表示不可写，使用“hidden”表示不可枚举
     //普通的可枚举、可写和可配置属性不包含特性列表
     Properties.prototype.toString = function() {
         var o = this.o; // Used in the nested function below
         var lines = this.names.map(nameToString);
         return "{\n  " + lines.join(",\n  ") + "\n}";
         
         function nameToString(n) {
             var s = "", desc = Object.getOwnPropertyDescriptor(o, n);
             if (!desc) return "nonexistent " + n + ": undefined";
             if (!desc.configurable) s += "permanent ";
             if ((desc.get && !desc.set) || !desc.writable) s += "readonly ";
             if (!desc.enumerable) s += "hidden ";
             if (desc.get || desc.set) s += "accessor " + n
             else s += n + ": " + ((typeof desc.value==="function")?"function"
                                                                   :desc.value);
             return s;
         }
     };

     // Finally, make the instance methods of the prototype object above 
     // nonenumerable, using the methods we've defined here.
     // 最后，将原型对象中的实例方法设置为不可枚举的
     // 这里用到了刚定义的方法
     Properties.prototype.properties().hide();
}()); // Invoke the enclosing function as soon as we're done defining it. 立即执行这个匿名函数
```

**9.9模块**

将代码组织到类中的一个重要原因是，让代码更加“模块化”，可以在很多不同场景中实现代码的重用。但类不是唯一的模块化代码的方式。一般来讲，模块是一个独立的JavaScript文件。模块文件可以包含一个类定义、一组相关的类、一个实用函数库或者是一些待执行的代码。只要以模块的形式编写代码，任何JavaScript代码段就可以当做一个模块。JavaScript中并没有定义用以支持模块的语言结构（但imports和exports的确是JavaScript保留的关键字，因此JavaScript的未来版本可能会支持），这也意味着在JavaScript中编写模块化的代码更多的是遵循某一种编码约定。

很多JavaScript库和客户端编程框架都包含一些模块系统。比如，Dojo工具包和Google的Closure库定义了provide()和require()函数，用以声明和加载模块。并且，CommonJS服务器端JavaScript标准规范（参照http://commonjs.org）创建了一个模块规范，后者同样使用require()函数。这种模块系统通常用来处理模块加载和依赖性管理，这些内容已经超出本书的讨论范围。如果使用这些框架，则必须按照框架提供的模块编写约定来定义模块。本节仅对模块约定做一些简单的讨论。

模块化的目标是支持大规模的程序开发，处理分散源中代码的组装，并且能让代码正确运行，哪怕包含了作者所不期望出现的模块代码，也可以正确执行代码。为了做到这一点，不同的模块必须避免修改全局执行上下文，因此后续模块应当在它们所期望运行的原始（或接近原始）上下文（这里的“原始上下文”是指调用模块时所在的上下文，可能处在一个很深的闭包当中，但这个模块的逻辑不应该影响到其他的上下文特别是全局上下文。）中执行。这实际上意味着模块应当尽可能少地定义全局标识，理想状况是，所有模块都不应当定义超过一个（全局标识）。接下来我们给出的一种简单的方法可以做到这一点。你会发现在JavaScript中实现一个模块代码并不困难：在本书中很多示例代码都用到了这种技术。

**9.9.1用做命名空间的对象**

在模块创建过程中避免污染全局变量的一种方法是使用一个对象作为命名空间。它将函数和值作为命名空间对象属性存储起来（可以通过全局变量引用），而不是定义全局函数和变量。拿例9-6的Set类来说，它定义了一个全局构造函数Set()。然后给这个类定义了很多实例方法，但将这些实例方法存储为Set.prototype的属性，因此这些方法不是全局的。示例代码也包含一个_v2s()工具函数，但也没有定义它为全局函数，而是把它存储为Set的属性。

接下来看一下例9-16，这个例子定义了很多抽象类和非抽象类。每个类都只包含一个全局标识，但整个模块（这个JavaScript文件）定义了很少的全局变量。基于这种“保持干净的全局命名空间”的观点，一种更好的做法是将“集合”类定义为一个单独的全局对象：
```javascript
var sets = {};
```
这个sets对象是模块的命名空间，并且将每个“集合”类都定义为这个对象的属性：
```javascript
sets.SingletonSet = sets.AbstractEnumerableSet.extend(...);    
```
如果想使用这样定义的类，需要通过命名空间来调用所需的构造函数：
```javascript
var s = new sets.SingletonSet(1);
```
模块的作者并不知道他的模块会和哪些其他模块一起工作，因此尤为注意这种命名空间的用法带来的命名冲突。然而，使用这个模块的开发者是知道它用了哪些模块、用到了哪些名字。程序员并不一定要严格遵守命名空间的写法，只需将常用的值“导入”到全局命名空间中。程序员如果要经常使用sets命名空间中的Set类，可以这样将它导入：
```javascript
var Set = sets.Set; //将Set导入到全局命名空间中
var s = new Set(1,2,3); //这样每次使用它就不必加set前缀了
```
有时模块作者会使用更深层嵌套的命名空间。如果sets模块是另外一组更大的模块集合的话，它的命名空间可能会是collections.sets，模块代码的开始会这样写：
```javascript
var collection; //声明（或重新声明）这个全局变量
if (!collections) //如果它原本不存在
    collections = {}; //创建一个顶层的命名空间对象
collections.sets = {} //将sets命名空间创建在它的内部
//在collections.sets内定义set类
collections.sets.AbstractSet = function() {...}
```
最顶层的命名空间往往用来标识创建模块的作者或组织，并避免命名空间的命名冲突。比如，Google的Closure库在它的命名空间goog.structs中定义了Set类。每个开发者都反转互联网域名的组成部分，这样创建的命名空间前缀是全局唯一的，一般不会被其他模块作者采用。比如我的网站是davidflanagan.com，我可以通过命名空间来发布我的sets模块：com.davidflanagan.collections.sets。

使用很长的命名空间来导入模块的方式非常重要，然而程序员往往将整个模块导入全局命名空间，而不是导入（命名空间中的某个）单独的类。
```javascript
var sets = com.davidflanagan.collections.sets;
```

**9.9.2 作为私有命名空间的函数**

模块对外导出一些公用API，这些API是提供给其他程序员使用的，它包括函数、类、属性和方法。但模块的实现往往需要一些额外的辅助函数和方法，这些函数和方法并不需要在模块外部可见。比如，例9-6中的Set._v2s()函数，模块作者不希望Set类的用户在某时刻调用这个函数，因此这个方法最好在类的外部是不可访问。

可以通过将模块（本例中的Set类）定义在某个函数的内部来实现。正如8.5节所描述的一样，在一个函数中定义的变量和函数都属于函数的局部成员  ，在函数的外部是不可见的。实际上，可以将这个函数作用域用做模块的私有命名空间（有时称为“模块函数”）。例9-24展示了如何使用“模块函数”来实现Set类：
例9-24：模块函数中的Set类
```javascript
//声明全局变量Set，使用一个函数的返回值给它赋值
//函数结束时紧跟的一对圆括号说明这个函数定义后立即执行
//它的返回值将赋值给Set，而不是将这个函数赋值给Set
//注意它是一个函数表达式，不是一条语句，因此函数"invocation"并没有创建全局变量
var Set = (function invocation(){
    function Set() {  //这个构造函数是局部变量
        this.values = {}; //这个对象的属性用来保存这个集合
        this.n = 0; //集合中值得个数
        this.add.apply(this, arguments); //将所有的参数都添加至集合中
    }
    //给Set.prototype定义实例方法
    //这里省略了详细代码
    Set.prototype.contains = function(value) {
        //注意我们调用了v2s()，而不是调用带有笨重的前缀的set._v2s()
        return this.values.hasOwnProperty(v2s(value));
    };
    Set.prototype.size = function() { return this.n; };
    Set.prototype.add = function() {/*...*/};
    Set.prototype.remove = function() {/*...*/};
    Set.prototype.foreach = function(f, context) {/*...*/};
    //这里是上面的方法用到的一些辅助函数和变量
    //它们不属于模块的公有API，但它们都隐藏在这个函数作用域内
    //因此我们不必将它们定义为Set的属性或使用下划线作为其前缀
    function v2s(val) {/*...*/}
    function objectId(o) {/*...*/}
    var nextId = 1;
    //这个模块的共有API是Set()构造函数
    //我们需要把这个函数从私有命名空间中导出来
    //以便在外部也可以使用它，在这种情况下，我们通过返回这个构造函数来导出它
    //它变成第一行代码所指的表达式的值
    return Set;
}()); // 定义函数后立即执行
```

注意，这里使用了立即执行的匿名函数，这在JavaScript中是一种惯用法。如果想让代码在一个私有命名空间中运行，只须给这段代码加上前缀“(function(){”和后缀”}())”。开始的左圆括号确保这是一个函数表达式，而不是函数定义语句，因此可以给该前缀添加一个函数名来让代码变得更加清晰。在例9-24中使用了名字“invocation”，用以强调这个函数应当在定义之后立即执行。名字“namespace”也可以用来强调这个函数被用做命名空间。

一旦将这模块代码封装进一个函数，就需要一些方法导出其公用API，以便在模块函数的外部调用它们。在例9-24中，模块函数返回构造函数，这个构造函数随后赋值给一个全局变量。将值返回已经清楚地表明API已经导出在函数作用域之外。如果模块API包含多个单元，则它可以返回命名空间对象。对于sets模块来说，可以将代码写成这样：
```javascript
//创建一个全局变量用来存放集合相关的模块
var collections;
if (!collections) collections = {};
//定义sets模块
collections.sets = (function namespace() {
    //在这里定义多种“集合”类，使用局部变量和函数
    //……这里省略很多代码……
    //通过返回命名空间对象将API导出
    return {
        //导出的属性名：局部变量名字
        AbstractSet: AbstractSet,
        NotSet: NotSet,
        AbstractEnumerableSet: AbstractEnumerableSet,
        SingletonSet: SingletonSet,
        AbstractWritableSet: AbstractWritableSet,
        ArraySet: ArraySet
    }
}());
```

另外一种类似的的技术是将模块函数当做构造函数，通过new来调用，通过将它们赋值给this来将其导出：
```javascript
var collections;
if (!collections) collections = {};
collections.sets = (new function namespace() {
    //……这里省略很多代码……
    //将API导出至this对象
    this.AbstractSet = AbstractSet;
    this.NotSet = NotSet; //……
    //注意，这里没有返回值
});
```
作为一种替代方案，如果已经定义了全局命名空间对象，这个模块函数可以直接设置那个对象的属性，不用返回任何内容：
```javascript
var collections;
if (!collections) collections = {};
collections.sets = {};
(function namespace(){
//……这里省略很多代码……
//将共用API导出到上面创建的命名空间对象上
collections.sets.AbstractSet = AbstractSet;
collections.sets.NotSet = NotSet; //……
//导出的操作已经执行了，这里不需要再写return语句了
}());
```
有些框架已经实现了模块加载功能，其中包括其他一些导出模块API的方法。比如，使用provides()函数来注册其API，提供exports对象用以存储模块API。由于JavaScript目前还不具备模块管理的能力，因此应当根据所使用的框架和工具包来选择合适的模块创建和导出API的方式。

第10章 正则表达式的模式匹配
---------------------------

正则表达式（regular expression）是一个描述字符模式的对象。JavaScript的RegExp类表示正则表达式，String和RegExp都定义了方法，后者使用正则表达式进行强大的模式匹配和文本检索与替换功能。JavaScript的正则表达式语法是Perl5的正则表达式语法的大型子集，所以对于有Perl编程经验的程序员来说，学习JavaScript中的正则表达式是小菜一碟。

有一些Perl正则表达式语法特性并不被ECMAScript支持，这些特性包括：s（单行模式）和x（扩展语法）标记；\a、\e、\l、\u、\L、\U、\E、\Q、\A、\Z、\z和\G转义字符："(?<=" 正向后行断言和"(?<!" 负向后行断言；"(?#"注释和扩展"(?"的语法。

本章首先介绍用以描述“文本模式”的正则表达式语法。随后讲解了使用正则表达式的String和RegExp方法。

**10.1正则表达式的定义**

JavaScript中的正则表达式用RegExp对象表示，可以使用RegExp()构造函数来创建RegExp对象，不过RegExp对象更多的是通过一种特殊的直接量语法来创建。就像通过引号包裹字符的方式来定义字符串直接量一样，正则表达式直接量定义为包含在一对斜杠（/）（正斜杠）之间的字符，例如：

```javascript
var pattern = /s$/;
```

运行这段代码创建一个新的RegExp对象，并将它赋值给变量pattern。这个特殊的RegExp对象用来匹配所有以字母“s”结尾的字符串。
用构造函数RegExp()也可以定义与之等价的正则表达式，代码如下：

```javascript
var pattern = new RegExp("s$");
```

RegExp直接量和对象的创建：就像字符串和数字一样，程序中每个取值相同的原始类型直接量均表示相同的值。这是显而易见的。程序运行时每次遇到对象直接量（初始化表达式）诸如{}和[]的时候都会创建新对象。比如，如果在循环体中写var a = []，则每次遍历都会创建一个新的空数组。
正则表达式直接量则与此不同，ECMAScript3规范规定，一个正则表达式直接量会在执行到它时转换为一个RegExp对象，同一段代码所表示正则表达式直接量的每次运算都返回一个对象。ECMAScript5规范则做了相反的规定，同一段代码所表示的正则表达式直接量的每次运算都返回新对象。IE一直都是按照ECMAScript5规范实现的，多数最新版本的浏览器也开始遵循ECMAScript5，尽管目前该标准并未全面广泛推行。

作者在这里揭示了一种非常容易忽略的情况，比如，这段代码在Firefox3.6和Firefox4+中的运行结果不一致：
```javascript
function getRE() {
    var re = /[a-z]/;
    re.foo = "bar";
    return re;
}
var reg = getRE(),
re2 = getRE();
console.log(reg == re2)//在Firefox3.6中返回true，在Firefox4+中返回false
reg.foo = "baz";
console.log(re2.foo);//在Firefox3.6中返回"baz"，在Firefox4+中返回"bar"
```
原因可以在ECMAScript5规范第24页和第247页找到，也就是说在ECMAScript3规范中，用正则表达式创建的RegExp对象会共享同一个实例，而在ECMAScript5中则是两个独立的实例。而最新的Firefox4、chrome和Safari5都遵循ECMAScript5标准，以至于IE6~IE8都没有很好地遵循ECMAScript3标准，不过在这个问题上反而处理对了。很明显ECMAScript5的规范更符合开发者的期望。

正则表达式的模式规则是由一个字符序列组成的。包括所有字母和数字在内，大多数的字符都是按照直接量仅描述待匹配的字符的。如此说来，正则表达式/java/可以匹配任何包含”java“子串的字符串。除此之外，正则表达式中还有其他具有特殊语义的字符，这些字符并不按照字面含义进行匹配。比如，正则表达式/s$/包含两个字符，第一个字符“s”按照字面含义匹配，第二个字符$是一个具有特殊语义的元字符，用以匹配字符串的结束。因此这个正则表达式可以匹配任何以"s"结束的字符串。

接下来的几节会进一步讲解JavaScript正则表达式中使用的各种字符和元字符。

**10.1.1直接量字符**

正如上文提到的，正则表达式中的所有字母和数字都是按照字面含义进行匹配的。JavaScript正则表达式语法也支持非字母的字符匹配，这些字符需要通过反斜线（\）作为前缀进行转义。比如，转义字符\n用以匹配换行符。表10-1中列出了这些转义字符。

表10-1：正则表达式中的直接量字符

|字符|匹配|
|----|----|
|字母和数字字符|自身|
|\o|NUL字符（\u0000）|
|\t|水平制表符（\u0009）|
|\n|换行符（\u000A）|
|\v|垂直制表符（\u000B）|
|\f|换页符（\u000C）|
|\r|回车符（\u000D）|
|\xnn|由十六进制数nn指定的拉丁字符，例如，\x0A等价于\n|
|\uxxxx|由十六进制数xxxx指定的Unicode字符，例如，\u0009等价于\t|
|\cX|控制字符^X，例如，\cJ等价于换行符\n|

在正则表达式中，许多标点符号具有特殊含义，它们是：

    ^ $ . * + ? = ! : | \ / () [] {}
    
在接下来的几节里，我们将学习这些符号的含义。某些符号只有在正则表达式的某些上下文中才具有某种特殊含义，在其他上下文中则被当成直接量处理。然而，如果想在正则表达式中使用这些字符的直接量进行匹配，则必须使用前缀\，这是一条通行规则。其他标点符号（比如@和引号）没有特殊含义，在正则表达式中按照字面含义进行匹配。

如果不记得哪些标点符号需要反斜线转义，可以在每个标点符号前都加上反斜线。另外需要注意，许多字母和数字在有反斜线做前缀时也有特殊含义，所以对于想按照直接量进行匹配的字母和数字，尽量不要用反斜线对其转义。当然，要想在正则表达式中按照直接量匹配反斜线本身，则必须使用反斜线将其转义。比如，正则表达式```"/\\/"```用以匹配任何包含反斜线的字符串。

**10.1.2字符类**

将直接量字符单独放进方括号内就组成了字符类（character class）。

一个字符类可以匹配它所含的任意字符。因此，正则表达式/[abc]/就和“a”、“b”、“c”中的任意一个都匹配。另外，可以通过“^”符号来定义否定字符类，它匹配所有不包含在方括号内的字符。定义否定字符类时，将一个“^”符号作为左方括号内的第一个字符。正则表达式/[^abc]/匹配的是“a”、“b”、“c”之外的所有字符。字符类可以使用连字符来表示字符范围。要匹配拉丁字母表中的小写字母，可以使用/[a-z]/，要匹配拉丁字母表中的任何字母和数字，则使用/[a-zA-Z0-9]/。

由于某些字符类非常常用，因此在JavaScript的正则表达式语法中，使用了这些特殊字符的转义字符来表示它们。例如，\s匹配的是空格符、制表符和其他Unicode空白符，\S匹配的是非Unicode空白符的字符。表10-2列出了这些字符，并且总结了字符类的语法（注意，有些字符类转义字符只能匹配ASCII字符，还没有扩展到可以处理Unicode字符，但可以通过十六进制表示方法来显式定义Unicode字符集，例如：/[\u0400-\u04FF]/用以匹配所有的Cyrillic字符）。cyrillic字符是一种斯拉夫语字母。

表10-2：正则表达式的字符类

|字符|匹配|
|----|----|
|[...]|方括号内的任意字符|
|[^...]|不在方括号内的任意字符|
|.|除换行符和其他Unicode行终止符之外的任意字符|
|\w|任何ASCII字符组成的单词，等价于[a-zA-Z0-9]|
|\W|任何不是ASCII字符组成的单词，等价于[^a-zA-Z0-9]|
|\s|任何Unicode空白符|
|\S|任何非Unicode空白符的字符，注意\w和\S不同|
|\d|任何ASCII数字，等价于[0-9]|
|\D|除了ASCII数字之外的任何字符，等价于[^0-9]|
|[\b]|退格直接量（特例）|

注意，在方括号之内也可以写这些特殊转义字符。比如，由于\s匹配所有的空白字符，\d匹配的是所有数字，因此/[\s\d]/就匹配任意空白符或者数字。注意，这里有一个特例。下面我们将会看到转义符\b具有的特殊含义，当用在字符类中时，它表示的是退格符，所以要在正则表达式中按照直接量表示一个退格符，只需要使用具有一个元素的字符类/[\b]/。

**10.1.3重复**

用刚刚学过的正则表达式的语法，可以把两位数描述成/\d\d/，四位数描述成/\d\d\d\d/。到目前为止，还没有一种方法可以用来描述任意多位的数字，或者描述由三个字母和一个数字构成的字符串。这些正则表达式语法中较为复杂模式都提到了正则表达式中某元素的“重复出现次数”。

我们在正则模式之后跟随用以指定字符重复的标记。由于某些重复种类非常常用，因此就有一些专门用于表示这种情况的特殊字符。例如，“+”用以匹配前一个模式的一个或多个副本。表10-3总结了这些表示重复的正则语法。

表10-3：正则表达式的重复字符语法

|字符|含义|
|----|----|
|{n,m}|匹配前一项至少n次，但不能超过m次|
|{n,}|匹配前一项n次或者更多次|
|{n}|匹配前一项n次|
|?|匹配前一项0次或者1次，也就是说前一项是可选的，等价于{0,1}|
|+|匹配前一项1次或多次，等价于{1,}|
|*|匹配前一项0次或者多次，等价于{0,}|

这里有一些例子：

```javascript
/\d{2,4}/  //匹配2-4个数字
/\W{3}\d?/ //精确匹配三个单词和一个可选的数字
/\s+java\s+/ //匹配前后带有一个或多个空格的字符串“java”
/[^(]*/ //匹配零个或多个非左括号的字符
```

在使用“*”和“?”时要注意，由于这些字符可能匹配0个字符，因此它们允许什么都不匹配。例如，正则表达式/a*/实际上与“bbbb”匹配，因为这个字符串含有0个a。

非贪婪的重复：表10-3中列出的匹配重复字符是尽可能多地匹配，而且允许后续的正则表达式继续匹配。因此，我们称之为“贪婪的”匹配。我们同样可以使用正则表达式进行非贪婪匹配。。只须在待匹配的字符后跟随一个问号即可：“??”、“+?”、“*?”或“{1,5}?”。比如，正则表达式/a+/可以匹配一个或多个连续的字母a。当使用“aaa”作为匹配字符串时，正则表达式会匹配它的三个字符。但是/a+?/也可以匹配一个或多个连续字母a，但它是尽可能少地匹配。我们同样将“aaa”作为匹配字符串，但后一个模式只能匹配第一个a。

使用非贪婪的匹配模式所得到的结果可能和期望并不一致。考虑以下正则表达式/a+b/，它可以匹配一个或多个a，以及一个b。当使用“aaab”作为匹配字符串时，它会匹配整个字符串。现在再试一下非贪婪匹配的版本/a+?b/，它匹配尽可能少的a和一个b。当用它来匹配“aaab”时，你期望它能匹配一个a和最后一个b。但实际上，这个模式却匹配了整个字符串，和该模式的贪婪匹配一模一样。这是因为正则表达式的模式匹配总是会寻找字符串中第一个可能匹配的位置。由于该匹配是从字符串的第一个字符开始的，因此在这里不考虑它的子串中更短的匹配。

**10.1.4选择、分组和引用**

正则表达式的语法还包括指定选择项、子表达式分组和引用前一子表达式的特殊字符。字符“|”用于分隔供选择的字符。例如，/ab|cd|ef/可以匹配字符串“ab”，也可以匹配字符串“cd”，还可以匹配字符串“ef”。/\d{3}|[a-z]{4}/匹配的是三位数字或者四个小写字母。

注意，选择项的尝试匹配次序是从左到右，直到发现了匹配项。如果左边的选择项匹配，就忽略右边的匹配项，即使它产生更好的匹配。因此，当正则表达式/a|ab/匹配字符串“ab”时，它只能匹配第一个字符。

正则表达式中的圆括号有多种作用。一个作用是把单独的项组合成子表达式，以便可以像处理一个独立的单元那样用“|”、“*”、“?”等来对单元内的项进行处理。例如，/java(script)?/可以匹配字符串“java”，其后可以有“script”也可以没有。/(ab|cd)+|ef/可以匹配字符串“ef”，也可以匹配字符串“ab”或“cd”的一次或多次重复。

在正则表达式中，圆括号的另一个作用是在完整的模式中定义子模式。当一个正则表达式成功地和目标字符串相匹配的时，可以从目标串中抽出圆括号中的子模式相匹配的部分（我们将在本章随后的部分中看到如何取得这些匹配的子串）。例如，假定我们正在检索的模式是一个或多个小写字母后面跟随了一位或多位数字，则可以使用模式/[a-z]+\d+/。但假定我们真正关心的是每个匹配尾部的数字，那么如果将模式的数字部分放在括号中（/[a-z]+(\d+)/），就可以从检索到的匹配中抽取数字了，之后我们会有详尽的解释。

带圆括号的表达式的另一个用途是允许在同一正则表达式的后部引用前面的子表达式。这是通过在字符“\”后加一位或多位数字来实现的。这个数字指定了带圆括号的子表达式在正则表达式中的位置。例如，\1引用的是第一个带圆括号的子表达式，\3引用的是第三个带圆括号的子表达式。注意，因为子表达式可以嵌套另一个子表达式，所以它的位置是参与计数的左括号的位置。例如，在下面的正则表达式中，嵌套的子表达式（[Ss]cript）可以用\2来指代：

    /([Jj]ava([Ss]cript)?)\sis\s(fun\w*)/

对正则表达式中前一个子表达式的引用，并不是指对子表达式模式的引用，而指的是与那个模式相匹配的文本的引用。这样，引用可以用于实施一条约束，即一个字符串各个单独部分包含的是完全相同的字符。例如，下面的正则表达式匹配的就是位于单引号或双引号之内的0个或多个字符。但是，它并不要求左侧和右侧的引号匹配（即，加入的两个引号都是单引号或都是双引号）：

    /['"][^'"]*['"]/
    
如果要匹配左侧和右侧的引号，可以使用如下的引用：

    /(['"])[^'"]*\1/
    
\1匹配的是第一个带圆括号的子表达式所匹配的模式。在这个例子中，存在这样一条约束，那就是左侧的引号必须和右侧的引号相匹配。正则表达式不允许用双引号括起的内容中有单引号，反之亦然。不能在字符类中使用这种引用，所以下面的写法是非法的：

    /(['"])[^\1]*\1/
    
在本章随后的几节中，我们会看到一种对带圆括号的子表达式的引用，这是正则表达式的检索和替换操作的强大特性之一。

同样，在正则表达式中不用创建带数字编码的引用，也可以对子表达式进行分组。它不是以“(”和“)”进行分组，而是以“(?:”和“)”来进行分组，比如，考虑下面这个模式：

    /([Jj]ava(?:[Ss]cript)?)\sis\s(fun\w*)/
    
这里，子表达式(?:[Ss]cript)仅仅用于分组，因此复制符号“?”可以应用到各个分组。这种改进的圆括号并不生成引用，所以在这个正则表达式中，\2引用了与(fun\w*)匹配的文本。

表10-4对正则表达式的选择、分组和引用运算符做了总结。

表10-4：正则表达式的选择、分组和引用字符。

|字符|含义|
|----|----|
| | |选择，匹配的是该符号左边的子表达式或右边的子表达式|
|(...)|组合，将几个项组合为一个单元，这个单元可通过“*”、“+”、“?”和“|”等符号加以修饰，而且可以记住和这个组合相匹配的字符串以供此后的引用使用|
|(?:...)|只组合，把项组合到一个单元，但不记忆与该组相匹配的字符|
|\n|和第n个分组第一次匹配的字符相匹配，组是圆括号中的子表达式（也有可能是嵌套的），组索引是从左到右的左括号数，“?:”形式的分组不编码|


**10.1.5指定匹配位置**

正如前面所介绍的，正则表达式中的多个元素才能匹配字符串的一个字符。例如，\s匹配的只是一个空白符。还有一些正则表达式的元素匹配的是字符之间的位置，而不是实际的字符。例如，\b匹配一个单词的边界，即位于\w（ASCII单词）字符和\W（非ASCII单词）之间的边界，或位于一个ASCII单词与字符串的开始或结尾之间的边界。像\b这样的元素不匹配某个可见的字符，它们指定匹配发生的合法位置。有时我们称这些元素为正则表达式的锚，因为它们将模式定位在搜索字符串的特定位置上。最常用的锚元素是^，它用来匹配字符串的开始，锚元素$用以匹配字符串的结束。

例如，要匹配单词“JavaScript”，可以使用正则表达式/^JavaScript$/。如果想匹配“Java”这个单词本身（不像在“JavaScript”中作为单词的前缀），可以使用正则表达式/\sJava\s/，可以匹配前后都有空格的单词“Java”。但是这样做有两个问题，第一，如果“Java”出现在字符串的开始或结尾，就匹配不成功，除非开始和结尾处各有一个空格。第二个问题是，当找到了与之匹配的字符串时，它返回的匹配字符串的前端和后端都有空格，这并不是我们想要的。因此我们使用单词的边界\b来代替真正的空格符\s进行匹配（或定位）。这样正则表达式就写成了/\bJava\b/。元素 \B将把匹配的锚点定位在不是单词的边界之处。因此，正则表达式/\B[Ss]cript/与“JavaScript”和“postscript”匹配，但不与“script”和“Scripting”匹配。

任意正则表达式都可以作为锚点条件。如果在符号“(?=”和“)”之间加入一个表达式，它就是一个先行断言，用以说明圆括号内的表达式必须正确匹配，但并不是真正意义上的匹配。比如，要匹配一种常用的程序设计语言的名字，但只在其后有冒号时才匹配，可以使用/[Jj]ava([Ss]cript)?(?=\:)/。这个正则表达式可以匹配“JavaScript: The Definitive Guide”中的“JavaScript”，但是不能匹配“Java in a Nutshell”中的“Java”，因为它后面没有冒号。

带有“(?!”的断言是负向先行断言，用以指定接下来的字符都不必匹配。例如，/Java(?!Script)([A-Z]\w*)/可以匹配“Java”后跟随一个大写字母和任意多个ASCII单词，但Java后面不能跟随“Script”。它可以匹配“JavaBeans”，但不能匹配“Javanese”；它可以匹配“JavaScript”，但不能匹配“JavaScripter”。

表10-5总结了正则表达式中的锚。

表10-5：正则表达式中的锚字符

|字符|含义|
|----|----|
| ^ |匹配字符串的开头，在多行检索中，匹配一行的开头|
| $ |匹配字符串的结尾，在多行检索中，匹配一行的结尾|
|\b|匹配一个单词的边界，简言之，就是位于字符\w和\W之间的位置，或位于字符\w和字符串的开头或者结尾之间的位置（但需要注意，[\b]匹配的是退格符）|
|\B|匹配非单词边界的位置|
|(?=p)|零宽正向先行断言，要求接下来的字符都与p匹配，但不能包括匹配p的那些字符|
|(?!p)|零宽负向先行断言，要求接下来的字符不与p匹配|

**10.1.6修饰符**

正则表达式中的语法还有最后一个知识点，即正则表达式的修饰符，用以说明高级匹配模式的规则。和之前讨论的正则表达式语法不同，修饰符是放在“/”符号之外的，也就是说，它们不是出现在两条斜线之间，而是第二条斜线之后。JavaScript支持三个修饰符，修饰符“i”用以说明模式匹配是不区分大小写的。修饰符“g”说明模式匹配应该是全局的，也就是说，应该找出被检索字符串中所有的匹配。修饰符“m”用以在多行模式中执行匹配，在这种模式下，如果待检索的字符串包含多行，那么^和$锚字符除了匹配整个字符串的开始和结尾之外，还能匹配每行的开始和结尾。比如正则表达式/java$/im可以匹配“java”也可以匹配“Java\nis fun”。

这些修饰符可以任意组合，比如，要想不区分大小写匹配字符串中的第一个单词“java”（“Java”或“JAVA”等），可以使用不区分大小写的修饰符来定义正则表达式/\bjava\b/i。要想匹配字符串中所有的单词，则需要添加修饰符g：/\bjava\b/gi。

表10-6对正则表达式的修饰符做了总结，注意，在本章的后续内容中还会介绍在String和RegExp的方法中使用修饰符g的示例。

表10-6：正则表达式修饰符

|字符|含义|
|----|----|
|i|执行不区分大小写的匹配|
|g|执行一个全局匹配，简言之，即找到所有的匹配，而不是在找到第一个之后就会停止|
|m|多行匹配模式，^匹配一行的开头和字符串的开头，$匹配行的结束和字符串的结束|

**10.2用于模式匹配的String方法**

到目前为止，尽管本章已经讨论过创建正则表达式的语法，但还没有尝试过如何在JavaScript代码中使用这些正则表达式。本节将讨论String对象的一些用以执行正则表达式模式匹配和检索替换操作的方法，后续几节还会继续讨论如何使用JavaScript正则表达式的模式匹配，不过将侧重于RegExp对象和它的方法及属性。注意，下面的讨论只是与正则表达式相关的方法和属性的概述。同样，可以在本书第三部分中查找到完整的介绍。

String支持4种使用正则表达式的方法。最简单的是search()。它的参数是一个正则表达式，返回第一个与之匹配的子串的起始位置，如果找不到匹配的子串，它将返回-1。比如，下面的调用返回值为4：

```javascript
  "JavaScript".search(/script/i);
```

如果search()的参数不是正则表达式，则首先会通过RegExp构造函数将它转换成正则表达式，search()方法不支持全局检索，因为它忽略正则表达式参数中的修饰符g。

replace()方法用以执行检索与替换操作。其中第一个参数是一个正则表达式，第二个参数是要进行替换的字符串。这个方法会对调用它的字符串进行检索，使用指定的模式来匹配。如果正则表达式中设置了修饰符g，那么源字符串中所有与模式匹配的子串都将替换成第二个参数指定的字符串；如果不带修饰符g，则只替换所匹配的的第一个子串。如果replace()的第一个参数是字符串而不是正则表达式，则replace()将直接搜索这个字符串，而不是像search()一样首先通过RegExp()将它转换为正则表达式。比如，可以使用下面的方法，利用replace()将文本中的所有javascript（不区分大小写）统一替换为“JavaScript”：

```javascript
//将所有不区分大小写的javascript都替换成大小写正确的JavaScript
text.replace(/javascript/gi,"JavaScript");
```

但replace()的功能远不止这些。回忆一下前文所提到的，正则表达式中使用圆括号括起来的子表达式是带有从左到右的索引编号的，而且正则表达式会记忆与每个子表达式匹配的文本。如果在替换字符串中出现了$加数字，那么replace()将用与指定的子表达式相匹配的文本来替换这两个字符。这是一个非常有用的特性。比如，可以用它将一个字符串中的英文引号替换为中文半角引号：

```javascript
//一段引用文本起始于引号，结束于引号
//中间的内容区域不能包含引号
var quote = /"([^"]*)"/g;
//用中文半角引号替换英文引号，同时要保持引号之间的内容（存储在$1中）没有被修改
text.replace(quote,' “$1” ');
```

replace()方法还有一些其他重要特性，这些特性将在本书第三部分关于String.replace()的主题页中进行介绍。最值得注意的是，replace()方法的第二个参数可以是函数，该函数能够动态地计算替换字符串。

match()方法是最常用的String正则表达式方法。它的唯一参数就是一个正则表达式（或通过RegExp()构造函数将其转换为正则表达式），返回的是一个由匹配结果组成的的数组。如果该正则表达式设置了修饰符g，则该方法返回的数组包含字符串中的所有匹配结果。例如：

```javascript
"1 plus 2 equals 3".match(/\d+/g) //返回["1", "2", "3"]
```

如果这个正则表达式没有设置修饰符g，match()就不会进行全局检索，它只检索第一个匹配。但即使match()执行的不是全局检索，它也返回一个数组。在这种情况下，数组的第一个元素就是匹配的字符串，余下的元素则是正则表达式中用圆括号括起来的子表达式。因此，如果match()返回一个数组a，那么a[0]存放的是完整的匹配，a[1]存放的则是与第一个用圆括号括起来的表达式相匹配的子串，以此类推。为了和方法replace()保持一致，a[n]存放的是$n的内容。
例如，使用如下的代码来解析一个URL：

```javascript
var url = /(\w+):\/\/([\w.]+)\/(\S*)/;
var text = "Visit my blog at http://www.example.com/~david";
var result = text.match(url);
if (result!-null) {
  var fullurl = result[0]; //包含“http://www.example.com/~david”
  var protocol = result[1]; //包含“http”
  var host = result[2]; //包含“www.example.com”
  var path = result[3]; //包含“~david”
}
```

值得注意的是，给字符串的match()方法传入一个非全局的正则表达式，实际上和给这个正则表达式的exec()方法传入的字符串是一模一样的，它返回的数组带有两个属性：index和input，接下来对exec()方法的讨论中会提到：

String对象的最后一个和正则表达式相关的方法是split()。这个方法用以将调用它的字符串拆分为一个子串组成的数组，使用的分隔符是split()的参数，例如：

```javascript
"123,456,789".split(",");//返回["123","456","789"]
```

split()方法还有其他一些特性，本书第三部分有关于String.split()更详尽的说明。

**10.3RegExp对象**

正如本章开始所讲到的，正则表达式是通过RegExp对象来表示的。除了RegExp()构造函数之外，RegExp对象还支持三个方法和一些属性。接下来的两节会对RegExp模式匹配方法和属性展开讲述。

RegExp()构造函数带有两个字符串参数，其中第二个参数是可选的，RegExp()用以创建新的RegExp对象。第一个参数包含正则表达式的主体部分，也就是正则表达式直接量中两条斜线之间的文本。需要注意的是，不论是字符串直接量还是正则表达式，都使用“\”字符作为转义字符的前缀，因此当给RegExp()传入一个字符串表述正则表达式时，必须将“\”替换成“\\”。RegExp()的第二个参数是可选的，如果提供第二个参数，它就指定正则表达式的修饰符。不过只能传入修饰符g、i、m或者它们的组合。比如：

//全局匹配字符串中的5个数字，注意这里使用了“\\”，而不是“\”
var zipcode = new RegExp("\\d{5}", "g");

RegExp()构造函数非常有用，特别是在需要动态创建正则表达式的时候，这种情况往往没办法通过写死在代码中的正则表达式直接量来实现。例如，如果待检索的字符串是由用户输入的，就必须使用RegExp()构造函数，在程序运行时创建正则表达式。其实通过eval()也可以实现运行时动态创建正则表达式，但不推荐使用eval()。

**10.3.1RegExp的属性**

每个RegExp对象都包含5个属性。属性source是一个只读的字符串，包含正则表达式的文本。属性global是一个只读的布尔值，用以说明这个正则表达式是否带有修饰符g。属性ignoreCase也是一个只读的布尔值，用以说明正则表达式是否带有修饰符i。属性multiline是一个只读的的布尔值，用以说明正则表达式是否带有修饰符m。最后一个属性lastIndex，它是一个可读/写的整数。如果匹配模式带有g修饰符，这个属性存储在整个字符串中下一次检索的开始位置，这个属性会被exec()和test()方法用到，下面会讲到。

**10.3.2RegExp的方法**

RegExp对象定义了两个用于执行模式匹配操作的方法。它们的行为和上文介绍过的String方法很类似。RegExp最主要的执行模式匹配的方法是exec()，它与10.2节介绍过的String方法match()相似，只是RegExp方法的参数是一个字符串，而String方法的参数是一个RegExp对象。exec()方法对一个指定的字符串执行了一个正则表达式，简言之，就是在一个字符串中执行匹配检索。如果它没有找到任何匹配，它就返回null，但如果它找到了一个匹配，它将返回一个数组，就像match()方法为非全局检索返回的数组一样。这个数组的第一个元素包含的是与正则表达式相匹配的字符串，余下的元素是与圆括号内的子表达式相匹配的子串。属性index包含了发生匹配的字符位置，属性input引用的是正在检索的字符串。

和match()方法不同，不管正则表达式是否具有全局修饰符g，exec()都会返回一样的数组。回忆一下，当match()的参数是一个全局正则表达式时，它返回由匹配结果组成的数组。相比之下，exec()总是返回一个匹配结果，并提供关于本次匹配的完整信息。当调用exec()的正则表达式对象具有修饰符g时，它将把当前正则表达式对象的lastIndex属性设置为紧挨着匹配子串的字符位置，当同一个正则表达式第二次调用exec()时，它将从lastIndex属性所指示的字符处开始检索。如果exec()没有发现任何匹配结果，它会将lastIndex重置为0（在任何时候都可以将lastIndex属性设置为0，每当在字符串中找最后一个匹配项后，在使用这个RegExp对象开始新的字符串查找之前，都应当将lastIndex设置为0）。这种特殊的行为使我们可以在用正则表达式匹配字符串的过程中反复调用exec()，比如：

```javascript
var pattern = /Java/g;
var text = "JavaScript is more fun than Java!";
var result;
while((result = pattern.exec(text)) != null) {
  alert("Matched'" + result[0] + "'" + " at position " + result.index + "; next search begins at " + pattern.lastIndex);
}
```

另外一个RegExp方法是test()，它比exec()更简单一些。它的参数是一个字符串，用test()对某个字符串进行检测，如果包含正则表达式的一个匹配结果，则返回true：

```javascript
var pattern = /java/i;
pattern.test("JavaScript"); //返回 true
```

调用test()和调用exec()等价，当exec()的返回结果不是null时，test()返回true。由于这种等价性，当一个全局正则表达式调用方法test()时，它的行为和exec()相同，因为它从lastIndex指定的位置处开始检索某个字符串，如果它找到了一个匹配结果，那么它就立即设置lastIndex为当前匹配子串的结束位置。这样一来，就可以使用test()来遍历字符串，就像用exec()方法一样。

与exec()和test()不同，String方法search()、replace()和match()并不会用到lastIndex属性。实际上，String方法只是简单地将lastIndex属性重置为0。如果让一个带有修饰符g的正则表达式对多个字符串执行exec()或test()，要么在每个字符串中找出所有的匹配以便将lastIndex自动重置为零，要么显式将lastIndex手动设置为0（当最后一次检索失败时需要手动设置lastIndex）。如果忘了手动设置lastIndex的值，那么下一次对新字符串进行检索时，执行检索的起始位置可能就不是字符串的开始位置，而可能是任意位置（这里所说的任意位置实际上是由lastIndex的值决定的，如果lastIndex的值不为0，必定会对新开始的正则表达式匹配检索造成不确定的影响）。当然，如果RegExp不带有修饰符g，则不必担心会发生这种情况。同样要记住，在ECMAScript5中，正则表达式直接量的每次计算都会创建一个新的RegExp对象，每个新RegExp对象具有各自的lastIndex属性，这势必会大大减少“残留”lastIndex对程序造成的意外影响。
