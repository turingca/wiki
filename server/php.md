知识体系
============
PHP官方中文手册[http://php.net/manual/zh/](http://php.net/manual/zh/)

入门
-----
***php是什么？***

PHP（Hypertext Preprocessor，超文本预处理器的字母缩写）是一种被广泛应用的开放源代码的多用途脚本语言，它可嵌入到 HTML中，尤其适合 web 开发。

以上是一个简单的回答，不过这是什么意思呢？请看如下例子：

Example #1 一个介绍性的范例
```php
<html>
    <head>
        <title>Example</title>
    </head>
    <body>
        <?php
        echo "Hi, I'm a PHP script!";
        ?>
    </body>
</html>
```
请注意这个范例和其它用C或Perl语言写的脚本之间的区别——与用大量的命令来编写程序以输出HTML不同的是，PHP页面就是 HTML，只不过在其中嵌入了一些代码来做一些事情（在本例中输出了 "Hi, I'm a PHP script!"）。PHP 代码被包含在特殊的起始符和结束符 <?php 和 ?> 中，使得可以进出“PHP模式”。

和客户端的JavaScript不同的是，PHP代码是运行在服务端的。如果在服务器上建立了如上例类似的代码，则在运行该脚本后，客户端就能接收到其结果，但他们无法得知其背后的代码是如何运作的。甚至可以将web服务器设置成让PHP来处理所有的HTML文件，这么一来，用户就无法得知服务端到底做了什么。使用PHP的一大好处是它对于初学者来说极其简单，同时也给专业的程序员提供了各种高级的特性。当看到PHP 长长的特性列表时，请不要害怕。可以很快的入门，只需几个小时就可以自己写一些简单的脚本。

尽管PHP的开发是以服务端脚本为目的，但事实上其功能远不局限与此。请继续读后面的章节，在“PHP能做什么”一节中将获得更多的信息。如果对web 编程感兴趣，也可以阅读简明教程。

***php能做什么？***

PHP能做任何事。PHP主要是用于服务端的脚本程序，因此可以用PHP来完成任何其它的CGI 程序能够完成的工作，例如收集表单数据，生成动态网页，或者发送／接收Cookies。但PHP的功能远不局限于此。

PHP脚本主要用于以下三个领域：

服务端脚本。这是PHP最传统，也是最主要的目标领域。开展这项工作需要具备以下三点：PHP解析器（CGI或者服务器模块）、web服务器和web 浏览器。需要在运行web服务器时，安装并配置PHP，然后，可以用web浏览器来访问PHP程序的输出，即浏览服务端的PHP页面。如果只是实验PHP 编程，所有的这些都可以运行在自己家里的电脑中。请查阅安装一章以获取更多信息。

命令行脚本。可以编写一段PHP脚本，并且不需要任何服务器或者浏览器来运行它。通过这种方式，仅仅只需要PHP解析器来执行。这种用法对于依赖 cron（Unix或者Linux环境）或者Task Scheduler（Windows 环境）的日常运行的脚本来说是理想的选择。这些脚本也可以用来处理简单的文本。请参阅 PHP 的命令行模式以获取更多信息。

编写桌面应用程序。对于有着图形界面的桌面应用程序来说，PHP或许不是一种最好的语言，但是如果用户非常精通 PHP，并且希望在客户端应用程序中使用PHP的一些高级特性，可以利用PHP-GTK来编写这些程序。用这种方法，还可以编写跨平台的应用程序。PHP-GTK 是 PHP的一个扩展，在通常发布的PHP 包中并不包含它。如果对PHP-GTK感兴趣，请访问其[网站](http://gtk.php.net/)以获取更多信息。

PHP能够在所有的主流操作系统上使用，包括Linux、Unix的各种变种（包括 HP-UX、Solaris和OpenBSD）、Microsoft Windows、Mac OS X、RISC OS 等。今天，PHP已经支持了大多数的web服务器，包括Apache、Microsoft Internet Information Server（IIS）、Personal Web Server（PWS）、Netscape 以及 iPlant server、Oreilly Website Pro Server、Caudium、Xitami、OmniHTTPd 等。对于大多数的服务器，PHP 提供了一个模块；还有一些PHP支持CGI标准，使得PHP能够作为CGI处理器来工作。

综上所述，使用PHP，可以自由地选择操作系统和web服务器。同时，还可以在开发时选择使用面对过程和面对对象，或者两者混和的方式来开发。尽管 PHP4不支持OOP所有的标准，但很多代码仓库和大型的应用程序（包括PEAR库）仅使用OOP代码来开发。PHP5弥补了PHP4的这一弱点，引入了完全的对象模型。使用 PHP，并不局限于输出 HTML。PHP 还能被用来动态输出图像、PDF文件甚至Flash动画（使用libswf和Ming）。还能够非常简便的输出文本，例如 XHTML以及任何其它形式的XML文件。PHP能够自动生成这些文件，在服务端开辟出一块动态内容的缓存，可以直接把它们打印出来，或者将它们存储到文件系统中。

PHP最强大最显著的特性之一，是它支持很大范围的数据库。使用任何针对某数据库的扩展（例如mysql）编写数据库支持的网页非常简单，或者使用抽象层如 PDO，或者通过 ODBC 扩展连接到任何支持ODBC标准的数据库。其它一些数据库也可能会用cURL或者sockets，例如CouchDB。

PHP还支持利用诸如LDAP、IMAP、SNMP、NNTP、POP3、HTTP、COM（Windows环境）等不计其数的协议的服务。还可以开放原始网络端口，使得任何其它的协议能够协同工作。PHP支持和所有web开发语言之间的WDDX复杂数据交换。关于相互连接，PHP已经支持了对Java对象的即时连接，并且可以透明地将其用作PHP对象。

PHP 具有极其有效的文本处理特性，包括Perl兼容正则表达式（PCRE）以及许多扩展和工具可用于解析和访问XML文档。PHP将所有的XML功能标准化于坚实的libxml2扩展，并且还增加了SimpleXML，XMLReader以及XMLWriter支持以扩充其功能。

另外，还有很多其它有趣的扩展库，在此根据字母和分类归类列出。还有一些附加的PECL扩展可能有也可能没有在PHP手册中列出，例如XDebug。
由于在这里无法列出PHP所有的特性和可提供的便利，请参阅安装以及函数参考有关章节以获取关于这里提到的扩展库更多的信息。




安装与配置
---------

***安装前需要考虑的事项***

安装前，首先需要知道想用PHP来做什么。PHP主要用在三个领域，分别在“PHP能做什么”一节中进行了描述：

*网站和 web 应用程序（服务器端脚本）
*命令行脚本
*桌面（GUI）应用程序

在通常情况下，需要三样东西：PHP自身、一个web服务器和一个web浏览器。可能已经有了一个web浏览器，并且根据操作系统的配置，也很可能已经有了一个 web 服务器（例如Linux和MacOS下的Apache；Windows下的IIS）。也许在某个公司租用了web空间，这样，自己无需设置任何东西，仅需要编写PHP 脚本，并上传到租用的空间中，然后在浏览器中查看结果。

如果需要自己配置服务器和PHP，有两个方法将PHP连接到服务器上。对于很多服务器，PHP 均有一个直接的模块接口（也叫做SAPI）。这些服务器包括 Apache、Microsoft Internet Information Server、Netscape和iPlanet等服务器。其它很多服务器支持ISAPI，即微软的模块接口（OmniHTTPd 就是个例子）。如果PHP不能作为模块支持web服务器，总是可以将其作为CGI或FastCGI处理器来使用。这意味着可以使用PHP的CGI可执行程序来处理所有服务器上的PHP文件请求。

如果对PHP命令行脚本感兴趣（例如在离线状态下，根据传递给脚本的参数，自动生成一些图片，或处理一些文本文件），那一定需要命令行可执行程序。更多信息可以参考PHP的命令行模式。如果是这种情况，不需要服务器和浏览器。

还可以用PHP的PHP-GTK扩展来编写桌面图形界面应用程序。这与编写web页面完全不同，因为无需输出任何HTML，而要管理窗口和窗口中的对象。关于 PHP-GTK 的更多信息，请访问专门为该扩展建立的网站。PHP-GTK没有包含在官方发布的PHP中。

现在，本节开始说明如何在Unix和Windows的web服务器中配置服务器模块接口和CGI可执行程序。也将在下面几节中了解到有关命令行可执行程序安装的信息。PHP源代码包和二进制包可以在[http://www.php.net/downloads.php](http://www.php.net/downloads.php)找到。建议选择一个最近的镜象服务器下载。


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
***include***
(PHP 4, PHP 5)
include 语句包含并运行指定文件。
以下文档也适用于 require。
被包含文件先按参数给出的路径寻找，如果没有给出目录（只有文件名）时则按照 include_path 指定的目录寻找。
如果在 include_path 下没找到该文件则 include 最后才在调用脚本文件所在的目录和当前工作目录下寻找。
如果最后仍未找到文件则 include 结构会发出一条警告；这一点和 require 不同，后者会发出一个致命错误。

如果定义了路径——不管是绝对路径（在 Windows 下以盘符或者 \ 开头，在 Unix/Linux 下以 / 开头）还是当前目录的相对路径（以 . 或者 .. 开头）include_path 都会被完全忽略。例如一个文件以 ../ 开头，则解析器会在当前目录的父目录下寻找该文件。

有关 PHP 怎样处理包含文件和包含路径的更多信息参见 include_path 部分的文档。

当一个文件被包含时，其中所包含的代码继承了include所在行的变量范围。
从该处开始，调用文件在该行处可用的任何变量在被调用的文件中也都可用。
不过所有在包含文件中定义的函数和类都具有全局作用域。
基本的 include 例子：
```php
vars.php
<?php

$color = 'green';
$fruit = 'apple';

?>

test.php
<?php

echo "A $color $fruit"; // A

include 'vars.php';

echo "A $color $fruit"; // A green apple

?>
```
如果 include 出现于调用文件中的一个函数里，则被调用的文件中所包含的所有代码将表现得如同它们是在该函数内部定义的一样。
所以它将遵循该函数的变量范围。此规则的一个例外是魔术常量，它们是在发生包含之前就已被解析器处理的。
函数中的包含：
```php
<?php

function foo()
{
    global $color;

    include 'vars.php';

    echo "A $color $fruit";
}

/* vars.php is in the scope of foo() so     *
 * $fruit is NOT available outside of this  *
 * scope.  $color is because we declared it *
 * as global.                               */

foo();                    // A green apple
echo "A $color $fruit";   // A green

?>
```
当一个文件被包含时，语法解析器在目标文件的开头脱离 PHP 模式并进入 HTML 模式，到文件结尾处恢复。
由于此原因，目标文件中需要作为 PHP 代码执行的任何代码都必须被包括在有效的 PHP 起始和结束标记之中。

如果“URL fopen wrappers”在 PHP 中被激活（默认配置），可以用URL（通过HTTP或者其它支持的封装协议——见支持的协议和封装协议）而不是本地文件来指定要被包含的文件。
如果目标服务器将目标文件作为 PHP 代码解释，则可以用适用于HTTPGET的URL请求字符串来向被包括的文件传递变量。
严格的说这和包含一个文件并继承父文件的变量空间并不是一回事；该脚本文件实际上已经在远程服务器上运行了，而本地脚本则包括了其结果。

Warning：Windows 版本的 PHP 在 4.3.0 版之前不支持通过此函数访问远程文件，即使已经启用 allow_url_fopen。
通过HTTP进行的include：
```php
<?php

/* This example assumes that www.example.com is configured to parse .php *
 * files and not .txt files. Also, 'Works' here means that the variables *
 * $foo and $bar are available within the included file.                 */

// Won't work; file.txt wasn't handled by www.example.com as PHP
include 'http://www.example.com/file.txt?foo=1&bar=2';

// Won't work; looks for a file named 'file.php?foo=1&bar=2' on the
// local filesystem.
include 'file.php?foo=1&bar=2';

// Works.
include 'http://www.example.com/file.php?foo=1&bar=2';

$foo = 1;
$bar = 2;
include 'file.txt';  // Works.
include 'file.php';  // Works.

?>
```

Warning安全警告
远程文件可能会经远程服务器处理（根据文件后缀以及远程服务器是否在运行PHP而定），但必须产生出一个合法的PHP脚本，因为其将被本地服务器处理。如果来自远程服务器的文件应该在远端运行而只输出结果，那用 readfile() 函数更好。
另外还要格外小心以确保远程的脚本产生出合法并且是所需的代码。

相关信息参见使用远程文件，fopen() 和 file()。

处理返回值：在失败时 include 返回 FALSE 并且发出警告。
成功的包含则返回 1，除非在包含文件中另外给出了返回值。
可以在被包括的文件中使用 return 语句来终止该文件中程序的执行并返回调用它的脚本。
同样也可以从被包含的文件中返回值。可以像普通函数一样获得include调用的返回值。
不过这在包含远程文件时却不行，除非远程文件的输出具有合法的PHP开始和结束标记（如同任何本地文件一样）。
可以在标记内定义所需的变量，该变量在文件被包含的位置之后就可用了。

因为 include 是一个特殊的语言结构，其参数不需要括号。在比较其返回值时要注意。
比较 include 的返回值：
```php
<?php
// won't work, evaluated as include(('vars.php') == 'OK'), i.e. include('')
if (include('vars.php') == 'OK') {
    echo 'OK';
}

// works
if ((include 'vars.php') == 'OK') {
    echo 'OK';
}
?>
```
include 和 return 语句：
```php
return.php
<?php

$var = 'PHP';

return $var;

?>

noreturn.php
<?php

$var = 'PHP';

?>

testreturns.php
<?php

$foo = include 'return.php';

echo $foo; // prints 'PHP'

$bar = include 'noreturn.php';

echo $bar; // prints 1

?>
```

$bar 的值为 1 是因为 include 成功运行了。注意以上例子中的区别。第一个在被包含的文件中用了 return 而另一个没有。如果文件不能被包含，则返回 FALSE 并发出一个 E_WARNING 警告。

如果在包含文件中定义有函数，这些函数不管是在 return 之前还是之后定义的，都可以独立在主文件中使用。
如果文件被包含两次，PHP 5 发出致命错误因为函数已经被定义，但是 PHP 4 不会对在 return 之后定义的函数报错。
推荐使用 include_once 而不是检查文件是否已包含并在包含文件中有条件返回。

另一个将 PHP 文件“包含”到一个变量中的方法是用输出控制函数结合 include 来捕获其输出，例如：
使用输出缓冲来将 PHP 文件包含入一个字符串：
```php
<?php
$string = get_include_contents('somefile.php');

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}

?>
```
要在脚本中自动包含文件，参见 php.ini 中的 auto_prepend_file 和 auto_append_file 配置选项。
Note: 因为是一个语言构造器而不是一个函数，不能被可变函数调用。
参见 require，require_once，include_once，get_included_files()，readfile()，virtual() 和 include_path。

***include_once***
(PHP 4, PHP 5)
include_once 语句在脚本执行期间包含并运行指定文件。此行为和include语句类似，唯一区别是如果该文件中已经被包含过，则不会再次包含。
如同此语句名字暗示的那样，只会包含一次。
include_once 可以用于在脚本执行期间同一个文件有可能被包含超过一次的情况下，想确保它只被包含一次以避免函数重定义，变量重新赋值等问题。
更多信息参见include文档。

Note:在 PHP 4中，_once 的行为在不区分大小写字母的操作系统（例如 Windows）中有所不同，例如：
include_once 在 PHP 4 运行于不区分大小写的操作系统中
```php
<?php
include_once "a.php"; // 这将包含 a.php
include_once "A.php"; // 这将再次包含 a.php！（仅 PHP 4）
?>
```
此行为在 PHP 5 中改了，例如在 Windows 中路径先被规格化，因此C:\PROGRA~1\A.php 和C:\ProgramFiles\a.php的实现一样，文件只会被包含一次。

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
***会话***
［简介］
会话支持在PHP中是在并发访问时由一个方法来保存某些数据.从而使你能够构建更多的定制程序从而提高你的web网站的吸引力.
一个访问者访问你的web网站将被分配一个唯一的id, 就是所谓的会话id. 这个id可以存储在用户端的一个cookie中，也可以通过 URL 进行传递.
会话支持允许你将请求中的数据保存在超全局数组$_SESSION中. 当一个访问者访问你的网站，PHP 将自动检查(如果session.auto_start 被设置为1）或者在你要求下检查(明确通过session_start()或者隐式通过session_register())当前会话id是否是先前发送的请求创建. 如果是这种情况，那么先前保存的环境将被重建.

Caution：如果你打开了session.auto_start那么将对象放入会话的唯一方法是使用auto_prepend_file来加载定义这个对象的类，其中，在加载的定义的类时，你不得不使用serialize()你的对象，并且事后unserialize()它.
$_SESSION (和所有已注册的变量) 将被 PHP 使用内置的序列化方法在请求完成时进行序列化.序列化方法可以通过 session.serialize_handler这个PHP配置选项中来设置一个指定的方法.注册的变量未定义将被标记为未定义.在并发访问时,这些变量不会被会话模块定义除非用户后来定义了它们.

Warning：因为会话数据是被序列化的，resource变量不能被存储在会话中.
序列化句柄 (php和php_binary) 会受到register_globals的限制. 而且，数字索引或者字符串索引包含的特殊字符(| 和 !) 不能被使用. 使用这些字符将脚本执行关闭时的最后出现错误. php_serialize 没有这样的限制.php_serialize 从 PHP 5.5.4 以后可用.

Note：请注意当会话工作时，会话的记录并没有被创建 直到一个变量已经被使用session_register()注册或者被添加一个新元素到 $_SESSION 全局数组中. 这点一直有效，无论是否使用 session_start() 函数 来开始会话.

Note：在 PHP 5.2.2 有一个没有在文档中说明的特性是用文件存储时，即使是 在 open_basedir 被启用，并且 "/tmp" 没有被添加到 允许路径列表中，也能将会话存储到 "/tmp" 目录. 这个特性在 PHP 5.3.0 时已经从 PHP 中被移除了.

***unset***
释放给定的变量
void unset ( mixed $var [, mixed $... ] )
unset() 销毁指定的变量。
unset() 在函数中的行为会依赖于想要销毁的变量的类型而有所不同。
如果在函数中unset()一个全局变量，则只是局部变量被销毁，而在调用环境中的变量将保持调用unset()之前一样的值。

```php
<?php
function destroy_foo() {
    global $foo;
    unset($foo);
}
$foo = 'bar';
destroy_foo();
echo $foo;
?>
```

以上例程会输出：
```php
bar
```

如果您想在函数中unset()一个全局变量，可使用$GLOBALS数组来实现：

```php
<?php
function foo() 
{
    unset($GLOBALS['bar']);
}
$bar = "something";
foo();
?>
```

如果在函数中unset()一个通过引用传递的变量，则只是局部变量被销毁，而在调用环境中的变量将保持调用unset()之前一样的值。

```php
<?php
function foo(&$bar) {
    unset($bar);
    $bar = "blah";
}
$bar = 'something';
echo "$bar\n";
foo($bar);
echo "$bar\n";
?>
```

以上例程会输出：
```php
something
something
```

如果在函数中unset()一个静态变量，那么在函数内部此静态变量将被销毁。但是，当再次调用此函数时，此静态变量将被复原为上次被销毁之前的值。

```php
<?php
function foo()
{
    static $bar;
    $bar++;
    echo "Before unset: $bar, ";
    unset($bar);
    $bar = 23;
    echo "after unset: $bar\n";
}
foo();
foo();
foo();
?>
```
以上例程会输出：

```php
Before unset: 1, after unset: 23
Before unset: 2, after unset: 23
Before unset: 3, after unset: 23
```
【参数】
var 要销毁的变量。
... 其他变量……

【返回值】没有返回值。

【更新日志】

|版本|说明|
|----|----|
|4.0.1|添加了多个参数的支持|

【范例】

Example #1 unset()示例

```php
<?php
// 销毁单个变量
unset ($foo);
// 销毁单个数组元素
unset ($bar['quux']);
// 销毁一个以上的变量
unset($foo1, $foo2, $foo3);
?>
```
Example #2 使用 (unset) 类型强制转换
(unset)类型强制转换常常和函数unset()引起困惑。 为了完整性，(unset)是作为一个NULL类型的强制转换。它不会改变变量的类型。
```php
<?php
$name = 'Felipe';
var_dump((unset) $name);
var_dump($name);
?>
```
以上例程会输出：
```php
NULL
string(6) "Felipe"
```
【注释】

Note:因为是一个语言构造器而不是一个函数，不能被可变函数调用。
Note:It is possible to unset even object properties visible in current context.
Note:在 PHP 5 之前无法在对象里销毁 $this。
Note:在 unset() 一个无法访问的对象属性时，如果定义了 __unset() 则对调用这个重载方法。

【参见】 
isset() 检测变量是否设置
empty() 检查一个变量是否为空
__unset()
array_splice() 把数组中的一部分去掉并用其它值取代


数学拓展
***rand***
产生一个随机整数
int rand ( void )
int rand ( int $min , int $max )
如果没有提供可选参数min和max，rand() 返回0到getrandmax()之间的伪随机整数。例如想要5到15（包括5和15）之间的随机数，用rand(5, 15)。

Note:在某些平台下（例如 Windows）getrandmax()只有32767。如果需要的范围大于32767，那么指定min和max参数就可以生成更大的数了，或者考虑用 mt_rand()来替代之。

【参数】
min 返回的最低值（默认：0）
max 返回的最高值（默认：getrandmax()）

【返回值】
A pseudo random value between min (or 0) and max (or getrandmax(), inclusive).

【更新日志】

|版本|说明|
|----|----|
|4.2.0|随机数发生器自动进行播种|

【范例】 

Example #1 rand()例子

```php
<?php
echo rand() . "\n";
echo rand() . "\n";
echo rand(5, 15);
?>
```

以上例程的输出类似于：

```php
7771
22264
11
```
【参见】
srand() 播下随机数发生器种子
getrandmax() 显示随机数最大的可能值
mt_rand() 生成更好的随机数


其他基本扩展
杂项函数

***exit***
输出一个消息并且退出当前脚本
void exit ([ string $status ] )
void exit ( int $status )
中止脚本的执行。 尽管调用了 exit()， Shutdown函数 以及 object destructors 总是会被执行。

【参数status】
如果 status 是一个字符串，在退出之前该函数会打印 status 。
如果 status 是一个 integer，该值会作为退出状态码，并且不会被打印输出。 退出状态码应该在范围0至254，不应使用被PHP保留的退出状态码255。 状态码0用于成功中止程序。
Note: PHP >= 4.2.0 当 status 是一个 integer，不会打印输出。
【返回值】
没有返回值。
【范例】
Example #1 exit() 例子
```php
<?php
$filename = '/path/to/data-file';
$file = fopen($filename, 'r')
    or exit("unable to open file ($filename)");
?>
```
Example #2 exit() 状态码例子
```php
<?php
//exit program normally
exit;
exit();
exit(0);
//exit with an error code
exit(1);
exit(0376); //octal
?>
```
Example #3 无论如何，Shutdown函数与析构函数都会被执行

```php
<?php
class Foo
{
    public function __destruct()
    {
        echo 'Destruct: ' . __METHOD__ . '()' . PHP_EOL;
    }
}

function shutdown()
{
    echo 'Shutdown: ' . __FUNCTION__ . '()' . PHP_EOL;
}

$foo = new Foo();
register_shutdown_function('shutdown');

exit();
echo 'This will not be output.';
?>
```
以上例程会输出：
```php
 Shutdown: shutdown()
 Destruct: Foo::__destruct()
```
Note: 因为是一个语言构造器而不是一个函数，不能被 可变函数 调用。
Note:该语法结构等同于 die()。

***die***

die等同于exit()
语法结构等同于exit()



文本处理
字符串
字符串函数

***htmlspecialchars***
（转换特殊字符为HTML实体）
***strlen*** 
获取字符串的长度，成功则返回字符串string的长度，如果string为空，则返回0
int strlen ( string $string )
***strstr***
查找字符串的首次出现  
string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )
返回 haystack 字符串从 needle 第一次出现的位置开始到 haystack 结尾的字符串。

Note:该函数区分大小写。如果想要不区分大小写，请使用 stristr()。
Note:如果你仅仅想确定 needle 是否存在于 haystack 中，请使用速度更快、耗费内存更少的 strpos() 函数。

【参数】
haystack 输入字符串。
needle 如果 needle 不是一个字符串，那么它将被转化为整型并且作为字符的序号来使用。
before_needle 若为 TRUE，strstr() 将返回 needle 在 haystack 中的位置之前的部分。

【返回值】
返回字符串的一部分或者 FALSE（如果未发现 needle）。

【更新日志】

|版本|说明|
|-----|:-------|
|5.3.0|新增可选的before_needle参数|
|4.3.0|strstr()成为二进制安全的|

【范例】

Example #1 strstr() 范例
```php
<?php
$email  = 'name@example.com';
$domain = strstr($email, '@');
echo $domain; // 打印 @example.com
$user = strstr($email, '@', true); // 从 PHP 5.3.0 起
echo $user; // 打印 name
?>
```
【参见】
preg_match()  执行一个正则表达式匹配
stristr()  strstr 函数的忽略大小写版本
strpos()  查找字符串首次出现的位置
strrchr()  查找指定字符在字符串中的最后一次出现
substr()  返回字符串的子串


***count***
计算数组中的单元数目或对象中的属性个数
int count ( mixed $var [, int $mode = COUNT_NORMAL ] )
统计一个数组里的所有元素，或者一个对象里的东西。
对于对象，如果安装了SPL，可以通过实现 Countable 接口来调用 count()。
该接口只有一个方法 Countable::count()，此方法返回 count() 函数的返回值。

【参数】
var 数组或者对象。
mode 如果可选的 mode 参数设为 COUNT_RECURSIVE（或 1），count() 将递归地对数组计数。对计算多维数组的所有单元尤其有用。mode 的默认值是 0。count() 识别不了无限递归。

【返回值】
返回 var 中的单元数目。 如果 var 不是数组类型或者实现了 Countable 接口的对象，将返回 1，有一个例外，如果 var 是 NULL 则结果是 0。

Caution：count() 对没有初始化的变量返回 0，但对于空的数组也会返回 0。用 isset() 来测试变量是否已经初始化。

【更新日志】 

|版本|说明|
|----|----|
|4.2.0|添加了可选的 mode 参数|

【范例】

Example #1 count() 例子
```php
<?php
$a[0] = 1;
$a[1] = 3;
$a[2] = 5;
$result = count($a);
// $result == 3
$b[0]  = 7;
$b[5]  = 9;
$b[10] = 11;
$result = count($b);
// $result == 3
$result = count(null);
// $result == 0
$result = count(false);
// $result == 1
?>
```

Example #2 递归 count() 例子
```php
<?php
$food = array('fruits' => array('orange', 'banana', 'apple'),
              'veggie' => array('carrot', 'collard', 'pea'));
// recursive count
echo count($food, COUNT_RECURSIVE); // output 8
// normal count
echo count($food); // output 2
?>
```
【参见】 
is_array() 检测变量是否是数组
isset() 检测变量是否设置
strlen() 获取字符串长度


核心
------


FAQ
-----


附录
-----


框架
-----

[ThinkPHP](thinkphp.md)
