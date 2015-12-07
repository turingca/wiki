知识体系
============
PHP官方中文手册[http://php.net/manual/zh/](http://php.net/manual/zh/)

入门
-----

安装与配置
---------

基本语法
--------

类型
-----

变量
-----

常量
-----

表达式
------

运算符
------

流程控制
-------

函数
-----

类与对象
-------

命名空间（php >= 5.3.0）
-----------------------
***什么是命名空间？***

从广义上来说，命名空间是一种封装事物的方法。在很多地方都可以见到这种抽象概念。
例如，在操作系统中目录用来将相关文件分组，对于目录中的文件来说，它就扮演了命名空间的角色。
举个例子，文件 foo.txt 可以同时在目录/home/greg 和 /home/other 中存在，但在同一个目录中不能存在两个 foo.txt 文件。
另外，在目录 /home/greg 外访问 foo.txt 文件时，我们必须将目录名以及目录分隔符放在文件名之前得到/home/greg/foo.txt。
这个原理应用到程序设计领域就是命名空间的概念。

在PHP中，命名空间用来解决在编写类库或应用程序时创建可重用的代码如类或函数时碰到的两类问题：
1.用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。
2.为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。

PHP 命名空间提供了一种将相关的类、函数和常量组合到一起的途径。
下面是一个说明 PHP 命名空间语法的示例：
```php
<?php
namespace my\name; 

class MyClass {}
function myfunction() {}
const MYCONST = 1;

$a = new MyClass;
$c = new \my\name\MyClass; 

$a = strlen('hi'); 
$d = namespace\MYCONST; // 参考 "namespace操作符和__NAMESPACE__常量”

$d = __NAMESPACE__ . '\MYCONST';
echo constant($d); 
?>
```

Note:名为PHP或php的命名空间，以及以这些名字开头的命名空间（例如PHP\Classes）被保留用作语言内核使用，而不应该在用户空间的代码中使用。


***定义命名空间？***

虽然任意合法的PHP代码都可以包含在命名空间中，但只有以下类型的代码受命名空间的影响，它们是：类（包括抽象类和traits）、接口、函数和常量。
命名空间通过关键字namespace 来声明。如果一个文件中包含命名空间，它必须在其它所有代码之前声明命名空间，除了一个以外：declare关键字。

声明单个命名空间：
```php
<?php
namespace MyProject;

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }

?>
```

在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。
另外，所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前，以下为错误示范
声明单个命名空间:
```php
<html>
<?php
namespace MyProject; // 致命错误 -　命名空间必须是程序脚本的第一条语句
?>
```

另外，与PHP其它的语言特征不同，同一个命名空间可以定义在多个文件中，即允许将同一个命名空间的内容分割存放在不同的文件中。

***定义子命名空间？***

与目录和文件的关系很象，PHP 命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义：

声明分层次的单个命名空间：
```php
<?php
namespace MyProject\Sub\Level;

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }

?>
```
上面的例子创建了常量MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection和函数 MyProject\Sub\Level\connect。

***在同一个文件中定义多个命名空间？***

也可以在同一个文件中定义多个命名空间。
在同一个文件中定义多个命名空间有两种语法形式。
简单组合语法：
```php
<?php
namespace MyProject;

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }

namespace AnotherProject;

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
?>
```
不建议使用这种语法在单个文件中定义多个命名空间。
建议使用下面的大括号形式的语法。

大括号语法:
```php
<?php
namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace AnotherProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}
?>
```
在实际的编程实践中，非常不提倡在同一个文件中定义多个命名空间。
这种方式主要用于将多个 PHP 脚本合并在同一个文件中。
将全局的非命名空间中的代码与命名空间中的代码组合在一起，只能使用大括号形式的语法。
全局非命名空间代码必须用一个不带名称的 namespace 语句加上大括号括起来，例如：
定义多个命名空间和不包含在命名空间中的代码:
```php
<?php
namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace { // global code
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}
?>
```
除了开始的declare语句外，命名空间的括号外不得有任何PHP代码。
定义多个命名空间和不包含在命名空间中的代码:
```php
<?php
declare(encoding='UTF-8');
namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace { // 全局代码
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}
?>
```

***使用命名空间基础***

在讨论如何使用命名空间之前，必须了解 PHP 是如何知道要使用哪一个命名空间中的元素的。
可以将 PHP 命名空间与文件系统作一个简单的类比。在文件系统中访问一个文件有三种方式：

1.相对文件名形式如foo.txt。它会被解析为 currentdirectory/foo.txt，其中 currentdirectory 表示当前目录。
因此如果当前目录是 /home/foo，则该文件名被解析为/home/foo/foo.txt。
2.相对路径名形式如subdirectory/foo.txt。它会被解析为 currentdirectory/subdirectory/foo.txt。
3.绝对路径名形式如/main/foo.txt。它会被解析为/main/foo.txt。

PHP 命名空间中的元素使用同样的原理。例如，类名可以通过三种方式引用：

1.非限定名称，或不包含前缀的类名称，例如 $a=new foo(); 或 foo::staticmethod();。
如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。
如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。
警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。
详情参见下文使用命名空间：后备全局函数名称/常量名称。

2.限定名称,或包含前缀的名称，例如 $a = new subnamespace\foo(); 或 subnamespace\foo::staticmethod();。
如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。
如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。

3.完全限定名称，或包含了全局前缀操作符的名称，例如， $a = new \currentnamespace\foo(); 或 \currentnamespace\foo::staticmethod();。
在这种情况下，foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo。

下面是一个使用这三种方式的实例：

file1.php
```php
<?php
namespace Foo\Bar\subnamespace;

const FOO = 1;
function foo() {}
class foo
{
    static function staticmethod() {}
}
?>
```
file2.php
```php
<?php
namespace Foo\Bar;
include 'file1.php';

const FOO = 2;
function foo() {}
class foo
{
    static function staticmethod() {}
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo。 resolves to function Foo\Bar\foo
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。resolves to class Foo\Bar\foo, method staticmethod
echo FOO; // 解析为常量Foo\Bar\FOO。resolves to constant Foo\Bar\FOO

/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo。
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo, 以及类的方法 staticmethod。
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO。

/* 完全限定名称 */
\Foo\Bar\foo(); // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Foo\Bar\FOO; // 解析为常量 Foo\Bar\FOO
?>
```

注意访问任意全局类、函数或常量，都可以使用完全限定名称，例如 \strlen() 或 \Exception 或 \INI_ALL。
在命名空间内部访问全局类、函数和常量:
```php
<?php
namespace Foo;

function strlen() {}
const INI_ALL = 3;
class Exception {}

$a = \strlen('hi'); // 调用全局函数strlen
$b = \INI_ALL; // 访问全局常量 INI_ALL
$c = new \Exception('error'); // 实例化全局类 Exception
?>
```
***命名空间和动态语言特征***

PHP 命名空间的实现受到其语言自身的动态特征的影响。
因此，如果要将下面的动态访问元素代码转换到访问命名空间中：
动态访问元素代码：
example1.php
```php
<?php
class classname
{
    function __construct()
    {
        echo __METHOD__,"\n";
    }
}
function funcname()
{
    echo __FUNCTION__,"\n";
}
const constname = "global";

$a = 'classname';
$obj = new $a; // prints classname::__construct
$b = 'funcname';
$b(); // prints funcname
echo constant('constname'), "\n"; // prints global
?>
```
必须使用完全限定名称（包括命名空间前缀的类名称）。

注意因为在动态的类名称、函数名称或常量名称中，限定名称和完全限定名称没有区别，因此其前导的反斜杠是不必要的。

动态访问命名空间的元素:
```php
<?php
namespace namespacename;
class classname
{
    function __construct()
    {
        echo __METHOD__,"\n";
    }
}
function funcname()
{
    echo __FUNCTION__,"\n";
}
const constname = "namespaced";

include 'example1.php';

$a = 'classname';
$obj = new $a; // prints classname::__construct
$b = 'funcname';
$b(); // prints funcname
echo constant('constname'), "\n"; // prints global

/* note that if using double quotes, "\\namespacename\\classname" must be used */
$a = '\namespacename\classname';
$obj = new $a; // prints namespacename\classname::__construct
$a = 'namespacename\classname';
$obj = new $a; // also prints namespacename\classname::__construct
$b = 'namespacename\funcname';
$b(); // prints namespacename\funcname
$b = '\namespacename\funcname';
$b(); // also prints namespacename\funcname
echo constant('\namespacename\constname'), "\n"; // prints namespaced
echo constant('namespacename\constname'), "\n"; // also prints namespaced
?>
```

请一定别忘了阅读对字符串中的命名空间名称转义的注解。


***namespace关键字和__NAMESPACE__常量***

PHP支持两种抽象的访问当前命名空间内部元素的方法，__NAMESPACE__ 魔术常量和namespace关键字。
常量__NAMESPACE__的值是包含当前命名空间名称的字符串。
在全局的，不包括在任何命名空间中的代码，它包含一个空的字符串。
__NAMESPACE__ 示例, 在命名空间中的代码:
```php
<?php
namespace MyProject;

echo '"', __NAMESPACE__, '"'; // 输出 "MyProject"
?>
```
__NAMESPACE__ 示例，全局代码:
```php
<?php

echo '"', __NAMESPACE__, '"'; // 输出 ""
?>
```
常量 __NAMESPACE__ 在动态创建名称时很有用，例如：
使用__NAMESPACE__动态创建名称:
 ```php
 <?php
namespace MyProject;

function get($classname)
{
    $a = __NAMESPACE__ . '\\' . $classname;
    return new $a;
}
?>
 ```
关键字namespace可用来显式访问当前命名空间或子命名空间中的元素。它等价于类中的 self 操作符。
namespace操作符，命名空间中的代码:
```php
<?php
namespace MyProject;

use blah\blah as mine; // see "Using namespaces: importing/aliasing"

blah\mine(); // calls function blah\blah\mine()
namespace\blah\mine(); // calls function MyProject\blah\mine()

namespace\func(); // calls function MyProject\func()
namespace\sub\func(); // calls function MyProject\sub\func()
namespace\cname::method(); // calls static method "method" of class MyProject\cname
$a = new namespace\sub\cname(); // instantiates object of class MyProject\sub\cname
$b = namespace\CONSTANT; // assigns value of constant MyProject\CONSTANT to $b
?>
```
namespace操作符, 全局代码:
```php
<?php

namespace\func(); // calls function func()
namespace\sub\func(); // calls function sub\func()
namespace\cname::method(); // calls static method "method" of class cname
$a = new namespace\sub\cname(); // instantiates object of class sub\cname
$b = namespace\CONSTANT; // assigns value of constant CONSTANT to $b
?>
```
 
***使用命名空间：别名/导入***

允许通过别名引用或导入外部的完全限定名称，是命名空间的一个重要特征。这有点类似于在类 unix 文件系统中可以创建对其它的文件或目录的符号连接。

所有支持命名空间的PHP版本支持三种别名或导入方式：为类名称使用别名、为接口使用别名或为命名空间名称使用别名。PHP 5.6开始允许导入函数或常量或者为它们设置别名。

在PHP中，别名是通过操作符 use 来实现的. 下面是一个使用所有可能的五种导入方式的例子：

使用use操作符导入/使用别名:
```php
<?php
namespace foo;
use My\Full\Classname as Another;

// 下面的例子与 use My\Full\NSname as NSname 相同
use My\Full\NSname;

// 导入一个全局类
use ArrayObject;

// importing a function (PHP 5.6+)
use function My\Full\functionName;

// aliasing a function (PHP 5.6+)
use function My\Full\functionName as func;

// importing a constant (PHP 5.6+)
use const My\Full\CONSTANT;

$obj = new namespace\Another; // 实例化 foo\Another 对象
$obj = new Another; // 实例化 My\Full\Classname　对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func
$a = new ArrayObject(array(1)); // 实例化 ArrayObject 对象
// 如果不使用 "use \ArrayObject" ，则实例化一个 foo\ArrayObject 对象
func(); // calls function My\Full\functionName
echo CONSTANT; // echoes the value of My\Full\CONSTANT
?>
```
注意对命名空间中的名称（包含命名空间分隔符的完全限定名称如 Foo\Bar以及相对的不包含命名空间分隔符的全局名称如 FooBar）来说，前导的反斜杠是不必要的也不推荐的，因为导入的名称必须是完全限定的，不会根据当前的命名空间作相对解析。
为了简化操作，PHP还支持在一行中使用多个use语句
通过use操作符导入/使用别名，一行中包含多个use语句:
```php
<?php
use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化 My\Full\Classname 对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func
?>
```
导入操作是在编译执行的，但动态的类名称、函数名称或常量名称则不是。
导入和动态名称:
```php
<?php
use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化一个 My\Full\Classname 对象
$a = 'Another';
$obj = new $a;      // 实际化一个 Another 对象
?>
```




Errors
-------

异常处理
--------

生成器
------

引用的解释
---------

预定义变量
---------

预定义异常
---------

预定义接口
---------

上下文（contxet）选项与参数
---------------------------

支持的协议和封装的协议
----------------------

安全
-----

特点
-----

函数参考
-------

核心
------


FAQ
-----


附录
-----
