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
什么是命名空间？

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


定义命名空间？

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

定义子命名空间？

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

**在同一个文件中定义多个命名空间？**

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
