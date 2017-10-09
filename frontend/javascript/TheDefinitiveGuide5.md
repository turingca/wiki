第19章 jQuery类库
----------------

jQuery类库被广泛地使用，作为Web开发者，我们必须熟悉它，即便没有在自己的代码中使用它，也很有可能在他人写的代码中遇见。幸运的是，jQuery足够小巧和稳定。

jQuery能让你在文档中轻松找到关心的元素，并对这些元素进行操作：添加内容、编辑hmtl属性和css属性、定义事件处理程序，以及执行动画。它还拥有Ajax工具来动态地发起HTTP请求，以及一些通用的工具函数来操作对象和数组。

正如其名，jQuery类库聚焦于查询。一个典型查询使用css选择器来识别一组文档元素，并返回一个对象来表示这些元素。返回的对象提供了大量有用的方法来批量操作匹配的元素。这些方法会尽可能返回调用对象本身，这使得简洁的链式调用成为可能。jQuery如此强大和好用，关键得益于以下特性：

* 丰富强大的语法（css选择器），用来查询文档元素
* 高效的查询方法，用来找到与css选择器匹配的文档元素集
* 一套有用的方法，用来操作选中的元素
* 强大的函数式编程技巧，用来批量操作元素集，而不是每次只操作单个
* 简洁的语言用法（链式调用），用来表示一系列顺序操作

本章首先会介绍如何使用jQuery来实现简单查询并操作其结果。接下来的章节会讲解：
* 如何设置HTML属性，CSS样式和类、HTML表单的值和元素内容、位置高宽，以及数据
* 如何改变文档结构：对元素进行插入、替换、包装盒删除操作
* 如何使用jQuery的跨浏览器事件模型
* 如何用jQuery来实现动画视觉效果
* jQuery的Ajax工具，如何用脚本来发起HTTP请求
* jQuery的工具函数
* jQuery选择器的所有语法，以及如何使用jQuery的高级选择方法
* 如何使用和编写插件来对jQuery进行扩展
* jQuery UI类库

**19.1 jQuery基础**

jQuery类库定义了一个全局函数：jQuery()。该函数使用频繁，因此在类库中还给它定义了一个快捷别名：$。这是jQuery在全局命名空间中定义的唯一两个变量。（如果你在自己的代码中有使用$作为变量，或者引入了Prototype等使用$作为全局变量的类库，这时，为了避免冲突，可以调用jQuery.noConflict()来释放$变量，让其指向原始值。）

这个拥有两个名字的全局方法是jQuery的核心查询方法。例如，下面的代码能获取文档中的所有div元素：
```javascript
var divs = $("div");
```
该方法返回的值表示零个或多个DOM元素，这就jQuery对象。注意：jQuery()是工厂函数，不是构造函数，它返回一个新创建的对象，但并没有和new关键字一起使用。jQuery对象定义了很多方法，可以用来操作它们表示的这组元素，本章中的大部分文字将用来阐释这些方法。例如，下面这段代码可以用来找到所有拥有details类的p元素，将其高亮显示，并将其中隐藏的p元素快速显示出来：
```javascript
$("p.details").css("background-color", "yellow").show("fast");
```
上面的css()方法操作的jQuery对象是由$()返回的，css()方法返回的也是这个对象，因此可以继续调用show()方法，这就是链式调用，很简洁紧凑。在jQuery编程中，链式调用这个习惯用语很普遍。再举个例子，下面的代码可以找到文档中拥有“clicktohide”CSS类的所有元素，并给每一个元素都注册一个事件处理函数。当用户单击元素时，会调用事件处理程序，使得该元素缓慢向上收缩，最终消失：
```javascript
$(".clicktohide").click(function() { $(this).slideUp("slow"); });
```

**19.1.1jQuery()函数**

在jQuery类库中，最重要的方法是jQuery()方法（也就是$()）。它的功能很强大，有4种不同的调用方式。

第一种也是最常用的调用方式是传递css选择器（字符串）给$()方法。当通过这种方式调用时，$()方法会返回当前文档中匹配该选择器的元素集。jQuery支持大部分CSS3选择器语法，还支持一些自己的扩展语法。19.8.1节将详细阐述jQuery选择器语法。还可以将一个元素或jQuery对象作为第二参数传递给$()方法，这时返回的是该特定元素或元素集的子元素中匹配选择器的部分。这第二个参数是可选的，定义了元素查询的起始点，经常称为上下文（context）。

第二种调用方式是传递一个Element、Document或Window对象给$()方法。在这种情况下，$()方法只须简单地将

**19.2jquery的getter和setter**
**19.3修改文档结构**
**19.4使用jquery处理事件**
**19.5动画效果**
**19.6jquery中的ajax**
**19.7工具函数**
**19.8jquery选择器和选取方法**

在本章中，我们已经使用了带有简单CSS选择器的jQuery选取函数；$()。现在是时候深入了解jQuery选择器语法，以及一些提取和扩充选中元素集的方法了。

***19.8.1jQuery选择器***

在CSS3选择器标准草案定义的选择器语法中，jQuery支持相当完整的一套子集，同时还添加了一些非标准但很有用的伪类。15.2.5节描述过基本的CSS选择器。在此我们会重复一下，并增加对更多高级选择器的阐释。注意：本节描述的是jQuery选择器。其中有不少选择器（但不是全部）可以在CSS样式表中使用。

选择器语法有三层结构。你肯定已经见过选择器中最简单的形式。“#test”选取id属性为“test”的元素。“blockquote”选取文档中的所有blockquote元素，而“div.note”则选取所有class属性为“note”的div元素。简单选择器可以组合成“组合选择器”，比如“div.note>p”和“blockquote i”，只要用组合字符做分隔符就行。简单选择器和组合选择器还可以分组成逗号分隔的列表。这种选择器组是传递给$()函数最常见的形式。在解释组合选择器和选择器组之前，我们必须先了解简单选择器的语法。

1.简单选择器

简单选择器的开头部分（显式或隐式地）是标签类型声明。例如，如果只对p元素感兴趣，简单选择器可以用“p”开头。如果选取的元素和标签名无关，则可以使用通配符“*”号来代替。如果选择器没有以标签名或通配符开头，则隐式含有一个通配符。

标签名或通配符指定了备选文档元素的一个初始集。在简单选择器中，标签类型声明之后的部分由零个或多个过滤器组成。过滤器从左到右应用，和书写顺序一致，其中每一个都会缩小选中元素集。表19-1列举了jQuery支持的过滤器。

**19.9jQuery的插件扩展**

jQuery的写法使得添加新功能很方便。添加新功能的模块称为插件（plug-in），可以在这里找到很多插件： http://plugins.jquery.com 。jQuery插件是普通的Javascript代码文件，在网页中使用时，只需要script元素引入就好，就和引用任何其他javascript类库一样（注意，必须在jQuery之后引入插件）。

开发jQuery插件非常简单。关键点是要知道jQuery.fn是所有jQuery对象的原型对象。如果给该对象添加一个函数，该函数会成为一个jQuery方法。例子如下：
```javascript
jQuery.fn.println = funciton() {
    //将所有参数合并成空格分隔的字符串
    var msg = Array.prototype.join.call(arguments, "");
    //遍历jQuery对象中的每一个元素
    this.each(function() {
        //将参数字符串作为纯文本添加到每一个元素后面，并添加一个br
        jQuery(this).append(document.createTextNode(msg).append("<br/>"));
    });
    //返回这个未加修改的jQuery对象，以便链式调用
    return this;
}
```
通过上面对jQuery.fn.println()函数的定义，我们可以在任何jQuery对象上类似如下调用println()方法了：
```javascript
$("#debug").println("x = ", x, "; y = ", y);
```
这是添加新方法到jQuery.fn中的常见开发方式。如果发现自己在使用each()方法“手动”遍历jQuery对象中的元素，并在元素上执行某些操作时，就可以问问自己，是否可以将代码重构一下，使得这些each()回调移动到一个扩展方法里（jQuery插件的这种扩展方式是全局性的，带来方便的同时，也污染了jQuery对象，容易造成潜在的冲突。译者不推荐“随时随想”使用这种扩展方式）。在开发扩展功能时，如果遵守基本的模块化代码实践，以及遵守jQuery特定的一些传统约定，就可以将该扩展称为插件，并与他人分享。下面是一些值得留意的jQuery插件约定：

* 不要依赖$标识符：包含的页面有可能调用了jQuery.noConflict()函数，$()可能不再等同于jQuery()函数。在上面这种简短的插件里，只要使用jQuery代替$就行。如果开发的扩展很长，则最好用一个匿名函数将扩展代码都包装起来，以避免创建全局变量。如果这样做，可以将jQuery作为参数传递给匿名函数，参数名采用$:
```javascript
(function($) { //带有参数名为$的匿名函数
    //在此书写插件代码
}(jQuery)); //使用jQuery对象作为参数调用该匿名函数
```
* 如果插件代码不返回自己的值，请确保返回jQuery对象以便链式调用。通常这就是this对象，只要不加修改地返回即可。在上面的例子中，方法末尾是"return this;"代码行。遵循jQuery的另一个习俗，可以让上面的方法更简短些（可读性低一些）：返回each()方法的结果。这样，println()方法会包含代码"return this.each(function() {...});"。
* 如果扩展方式拥有两个以上参数或配置选项，请允许用户能使用对象的方式传递选项（就如我们在19.5.2节看到的animate()方法和在19.6.3节看到的jQuery.ajax()函数一样）。
* 不要污染jQuery方法的命名空间。优雅的jQuery插件会用一套有用的API定义最少量的方法。通常，一个jQuery插件只会在jQuery.fn上定义一个方法。该方法会接受字符串作为第一个参数，然后将该字符串作为函数名解析，然后将剩余参数传给该解析函数。当可以将插件限定为一个方法时，该方法名应该与插件同名。如果需要定义多个方法，则使用插件名作为每一个方法名的前缀。
* 如果插件需要绑定事件处理程序，请将所有这些处理程序放在事件命名空间中（参见19.4.4节）。使用插件名作为命名空间名。
* 如果插件需要使用data()方法与元素关联数据，请将所有数据值放在单一对象中，然后用与插件名相同的键值将该对象作为单一值存储。
* 用“jquery.plugin.js”这种文件命名方式保存插件代码到一个文件中（将“plugin”替换为插件名）

插件可以给jQuery自身增加函数来添加新的工具函数。例如：
```javascript
//该方法输出其参数（使用println()插件方法）
//到id为“debug”的元素上。如果不存在该元素，则创建一个并添加到文档中
jQuery.debug = function() {
    var elt = jQuery("#debug"); //查找#debug元素
    if (elt.length == 0) { //如果它不存在则创建之
        elt = jQuery("<div id='debug'><h1>Debugging Output</h1></div>");
        jQuery(document.body).append(elt);
    }
    elt.println.apply(elt, arguments); //将参数输出到元素中
}
```
除了定义新方法，还可以扩展jQuery类库的其他部分。例如，在19.5节中，我们已经看到可以通过给jQuery.fx.speeds添加属性来扩充新的动画时长名（除了“fast”和“slow”），也可以通过给jQuery.easing添加属性来添加新的缓动函数。插件甚至可以扩展jQuery的CSS选择器引擎！可以通过给jQuery.expr[':']对象添加属性来添加新的伪类过滤器（比如:first和:input）。下面这个例子定义了一个新的:draggable过滤器，可用来仅返回拥有draggable=true属性的元素：
```javascript
jQuery.expr[':'].draggable = function(e) {return e.draggable === true;};
```
使用上面定义的这个选择器，可以用$("img:draggable")来选取可拖曳的图片，而不用使用冗长的$("img[draggable=true]")。
从上面的代码中可以看到，自定义选择器函数的第一个参数是候选的DOM元素。如果该元素匹配选择器，则返回true；否则返回false。许多自定义选择器只需要这一个元素参数，但实际上在调用它们时传入了4个参数。第二个参数是整数序号，表示当前元素在候选元素数组中的位置。候选元素数组作为第4个参数传入，选择器不应该修改它。第三个参数很有趣的：这是调用RegExp.exec()方法后返回的数组。如果有的话，该数组的第4个元素（序号是3）是伪类过滤器后面的圆括号中的值。圆括号和里面的如何引号都去除了，只留下参数字符串。下面是一个例子，用来说明如何实现一个:data(x)伪类，该伪类只在元素拥有data-x属性时返回true（参考15.4.3节）：
```javascript
jQuery.expr[':'].data = function(element, index, match, array) {
    //注意，IE7及其以下版本不支持hasAttribute()
    return element.hasAttribute("data-" + match[3]);
};
```

**19.10 jQuery UI类库**

第20章 客户端存储
-----------------
Web应用允许使用浏览器提供的API实现将数据存储到用户的电脑上。这种客户端存储相当于赋予了Web浏览器记忆功能。比方说，Web应用就可以用这种方式来“记住”用户的偏好甚至是用户所有的状态信息，以便准确地“回忆”起用户上一次访问的位置。客户端存储遵循“同源策略”，因此不同站点的页面是无法互相读取对方存储的数据，而同一站点的不同页面之间是可以互相共享存储数据的，它为我们提供了一种通信机制，例如，一个页面上的填写的表单数据可以显示在另外一个页面中。Web应用可以选择它们存储数据的有效期：比如采用临时存储可以让数据保存至当前窗口关闭或者浏览器退出；采用永久存储，可以将数据永久地存储在硬盘上，数年或者数月不失效。

客户端存储有以下几种形式：

Web存储

Web存储最初作为HTML5的一部分被定义成API形式，但是后来被剥离出来作为独立的一份标准了。该标准目前还在草案阶段，但其中的一部分内容已经被包括IE8在内的所有主流浏览器（可交互地）实现了。Web存储标准所描述的API包括localStorage对象和sessionStorage对象，这两个对象实际上是持久化关联数组，是名值对的映射表，“名”和“值”都是字符串。Web存储易于使用、支持大容量（但非无限量）数据存储同时兼容当前所有主流浏览器，但是不兼容早期浏览器。20.1节会对localStorage和sessionStorage这两个对象作详细介绍。

cookie

cookie是一种早期的客户端存储机制，起初是针对服务器端脚本设计使用的。尽管在客户端提供了非常繁琐的JavaScriptAPI来操作cookie，但它们难用至极，而且只适合存储少量的文本数据。不仅如此，任何以cookie形式存储的数据，不论服务端是否需要，每一次HTTP请求都会把这些数据传输到服务器端。cookie目前仍然被客户端程序员大量使用的一个重要原因是：所有的新旧浏览器都支持它。但是，随着WebStorage的普及，cookie最终将会回归到最初的形态：作为一种被服务端脚本使用的客户端存储机制。20.2节会详细介绍cookie。

IE User Data

微软在IE5之后的IE浏览器中实现了它专属的客户端存储机制“userData”。userData可以实现一定量的字符串数据存储，对于IE8以前的IE浏览器中，可以将其用做是Web存储的替代方案。关于userData的API会在20.3节中进行相应介绍。

离线Web应用

HTML5标准中定义了一组“离线Web应用”API，用以缓存Web页面以及相关资源（脚本、CSS文件、图像等）。它实现的是将Web应用整体存储在客户端，而不仅仅是存储数据。它能够让Web应用“安装”在客户端，这样一来，哪怕网络不可用的时候Web应用依然是可用的。离线Web应用相关的内容会在20.4节中介绍。

Web数据库

为了能够让开发者像使用数据库那样来操作大量数据，很多主流的浏览器纷纷在其中开始集成客户端数据库的功能。Safari、Chrome和Opera都内置了SQL数据库的客户端API。遗憾的是，这类API的标准化工作以失败告终，并且Firefox和IE看样子也都不打算实现这种API。目前还有一种正在标准化的数据库API，称为“索引数据库API”（Indexed Database API）。调用该API返回的是一个不包含查询语句的简单数据库对象。这两种客户端数据库API都是异步的，都使用了事件处理机制（类似DOM事件机制），这样的方式多多少少会显得有些复杂。本章不会对它们做介绍，但是22.8节会简要介绍索引数据库API同时会提供一些例子。

文件系统API

本节第8章介绍过现在主流浏览器都支持一个文件对象，用以将选择的文件通过XMLHttpRequest上传到服务器。与之相关的规范（草案阶段）定义了一组API，用于操作一个私有的本地文件系统。在该文件系统中可以进行对文件的读写操作。这些内容正在紧锣密鼓标准化当中，这些API将在22.7节中介绍。随着这些API被广泛地实现和支持，Web应用可以使用类似基于文件的存储机制，这对于大部分程序员来说再熟悉不过了。

存储、安全和隐私：Web浏览器通常会提供“记住Web密码”的功能，这些密码会以加密的形式安全地存储到硬盘上。然而，本章介绍的任何形式的客户端数据存储都不牵扯加密：任何存储在用户硬盘上的数据都是未加密的形式。这样一来，对于拥有电脑访问权限的恶意用户以及计算机上存在的恶意软件（比如：间谍软件）同样也可以获取到存储的数据。因此，任何形式的客户端存储不应该用来保存密码、商业帐号或者其他类似的敏感信息。记住：尽管用户访问你的网站时，愿意在表单中输入一些信息，但绝不代表用户愿意将这些信息保存到硬盘上。就拿信用卡卡号来举例好了，这是用户的隐私，用户并不愿意公开，如果你利用客户端持久性将信息存储起来，这无异于你将信用卡号写在一张便签纸上，随后粘贴在用户的键盘上，让所有人都看到。

还有要谨记的一点：很多Web用户不信任那些使用cookie和其他客户端存储机制来做类似“跟踪”功能的网站。所以，尽量尝试用本章讨论的存储机制来为网站提升用户体验；用不是用它们来收集和侵犯隐私相关的数据。如果网站滥用客户端存储，用户将会禁用该功能，这样一来不仅起不到效果，还会导致依赖客户端存储的网站完全不可用。

**20.1 localstorage和sessionstorage**

实现了“Web存储”草案标准的浏览器在Window对象上定义了两个属性：localStorage和sessionStorage。这两个属性都代表同一个Storage对象——一个持久化关联数组，数组使用字符串来索引，存储的值也都是字符串形式的。Storage对象在使用上和一般的JavaScript对象没什么区别：设置对象的属性为字符串值，随后浏览器会将该值存储起来。localStorage和sessionStorage两者的区别在于存储的有效期和作用域的不同：数据可以存储多长时间以及谁拥有数据的访问权。

下面，我们会对存储的有效期和作用域进行详细的解释。不过，在此之前，让我们先来看些例子。下面这段代码使用的是localStorage，但是它对sessionStorage也同样适用：

```javascript
var name = localStorage.username; // 查询一个存储的值
name = localStorage["username"];  // 等价于数组表示法
if)(!name) {
    name = prompt("What is your name?"); // 询问用户一个问题
    localStorage.username = name; // 存储用户的答案
}
// 迭代所有存储的name/value对
for (var name in localStorage) {    // 迭代所有存储的名字
    var value = localStorage[name]; // 查询每个名字对应的值
}
```

Storage对象还定义了一些诸如存储、获取、遍历和删除的方法。这些方法会在20.1.2节中介绍。

“Web存储”草案标准指出，我们既可以存储结构化的数据（对象和数组），也可以存储原始类型数据，还可以存储诸如日期、正则表达式甚至文件对象在内的内置类型的数据。但是，截至本书截稿时，浏览器仅仅支持存储字符串类型数据。如果想要存储和获取其他类型的数据，不得不自己手动进行编码和解码。如以下例子所示：

```javascript
// 当存储一个数字的时候，会把它自动转换为一个字符串
// 但是，当获取该值的时候别忘记了手动将其转换成数字类型
localStorage.x = 10;
var x = parseInt(localStorage.x);
// 同样地，存储一个日期类型数据的时候进行编码，获取的时候进行解码
localStorage.lastRead = (new Date()).toUTCString();
var lastRead = new Date(Date.parse(localStorage.lastRead));
// 使用JSON可以使得对基本数据类型编码的工作变得方便
localStorage.data = JSON.stringify(data); // 编码然后存储
var data = JSON.parse(localStorage.data); // 获取数值之后再解码
```

**20.1.1存储有效期和作用域**

localStorage和sessionStorage的区别在于存储的有效期和作用域的不同。通过localStorage存储的数据是永久的，除非Web应用刻意删除存储的数据，或者用户通过设置浏览器配置（浏览器提供的特定UI）来删除，否则数据将一直保留在用户的电脑上，永不过期。

localStorage的作用域是限定在文档源（document origin）级别的。正如13.6.2节所介绍的，文档源是通过协议、主机名以及端口三者来确定的，因此，下面每个URL都拥有不同的文档源：

```javascript
http://www.example.com // 协议：http；主机名：www.example.com
https://www.example.com // 不同协议
http://static.example.com // 不同主机名
http://www.example.com:8000 // 不同端口
```

同源的文档间共享同样的localStorage数据（不论该源的脚本是否真正地访问localStorage）。它们可以互相读取对方的数据，甚至可以覆盖对方的数据。但是，非同源的文档间互相都不能读取或覆盖对方的数据（即使它们运行的脚本是来自同一台第三方服务器也不行）。

需要注意的是localStorage的作用域也受浏览器供应商限制。如果你使用Firefox访问站点，那么下次用另一个浏览器（比如，Chrome）再次访问的时候，那么本次是无法获取上次存储的数据的。

通过sessionStorage存储的数据和通过localStorage存储的数据的有效期也是不同的：前者的有效期和存储数据的脚本所在的最顶层的窗口或者是浏览器标签页是一样的。一旦窗口或者标签页被永久关闭了，那么所有通过sessionStorage存储的数据也都被删除了。（当时要注意的是，现代浏览器已经具备了重新打开最近关闭的标签页随后恢复上一次浏览的会话功能，因此，这些标签页以及与之相关的sessionStorage的有效期可能会更加长些）。

与localStorage一样，sessionStorage的作用域也是限定在文档源中，因此非同源文档间都是无法共享sessionStorage的。不仅如此，sessionStorage的作用域还被限定在窗口中。如果同源的文档渲染在不同的浏览器标签中，那么它们之间拥有的是各自的sessionStorage数据，无法共享；一个标签页中的脚本是无法读取或者覆盖由另一个标签页脚本写入的数据，哪怕这两个标签页渲染的是同一个页面，运行的是同一个脚本也不行。

要注意的是：这里提到的基于窗口作用域的sessionStorage指的窗口只是顶级窗口。如果一个浏览器标签页包含两个iframe元素，它们所包含的文档是同源的，那么这两者之间是可以共享sessionStorage的。

**20.1.2 存储API**

localStorage和sessionStorage通常被当做普通的JavaScript对象使用：通过设置属性来存储字符串值，查询该属性来读取该值。除此之外，这两个对象还提供了更加正式的API。调用setItem()方法，将对应的名字和值传递进去，可以实现数据存储。调用getItem()方法，将名字传递进去，可以获取对应的值。调用removeItem()方法，将名字传递进去，可以删除对应的数据。（在非IE8浏览器中，还可以使用delete操作符来删除数据，就和普通的对象使用delete操作符一样。）调用clear()方法（不需要参数）可以删除所有存储的数据。最后，使用length属性以及key()方法，传入0～length-1的数字，可以枚举所有存储数据的名字。下面是一些使用localStorage的例子。这些代码对sessionStorage也适用：

```javascript
localStorage.setItem("x", 1); // 以“x”的名字存储一个数值
localStorage.getItem("x"); // 获取数值
// 枚举所有存储的名字／值对
for (var i = 0; i < localStorage.length; i++ ) {  // length表示所有名字/值对的总数
    var name = localStorage.key(i); // 获取第i对的名字
    var value = localStorage.getItem(name); // 获取该对的值
}
localStorage.removeItem("x"); // 删除“x”项
localStorage.clear(); // 全部删除
```

尽管通过设置和查询属性能更加方便地存储和获取数据，但是有的时候还是不得不使用上面提到的这些方法的。比方说，其中clear()方法是唯一能删除存储对象中所有名/值对的方式。同样的还有，removeItem()方法也是唯一通用的删除单个名/值对的方式，因为IE8不支持delete操作符。

如果浏览器提供商完全实现了“Web存储”的标准，支持对象和数组类型的数据存储，那么就会又多了一个使用类似于setItem()和getItem()这类方法的理由。对象和数组类型的值通常是可变的，因此存储对象要求存储它们的副本，以确保之后任何对这类对象的改变都不会影响到存储的对象。同样的，在获取该对象的时候也要求获取的是该对象的副本，以确保对已获取对象的改动不会影响到存储的对象。而这类操作如果使用基于属性的API就会令人困惑。考虑下面这段代码（假设浏览器已经支持了结构化数据的存储）：

```javascript
localStorage.o = {x:1}; // 存储一个带有“x”属性的对象
localStorage.o.x = 2; // 试图去设置该对象的属性值
localStorage.o.x; // => 1: x没有变 
```

上述第二行代码想要设置存储的对象的属性值，但是事实上，它获取的只是存储的对象的副本，随后设置了该对象的属性值，然后就将该副本废弃了。真正存储的对象保持不变。像这样的情况，使用getItem()就不会让人困惑了。

```javascript
localStorage.getItem("o").x = 2; // 我们并不想存储2
```

最后，还有另外一个使用显式的机遇方法的存储API的理由就是：在还不支持“Web存储”标准的浏览器中，其他的存储机制的顶层API对其也是兼容的。下面这段代码使用cookie和IEuserData来实现存储API。如果使用基于方法的API，当localStorage可用的时候就可以使用它编写代码，而当它在其他浏览器上不可用的时候依然可以依赖于其他的存储机制。代码如下所示：

```javascript
// 识别出使用的是哪类存储机制
var memory = window.localStorage 
            || (window.UserDataStorage && new UserDataStorage())
            || new cookieStorage();
// 然后在对应的机制中查询数据
var username = memory.getItem("username");
```

**20.1.3 存储事件**

无论什么时候存储在localStorage或者sessionStorage的数据发生改变，浏览器都会在其他对该数据可见的窗口对象上触发存储事件（但是，在对数据进行改变窗口对象上是不会触发的）。如果浏览器有两个标签页都打开了来自同源的页面，其中一个页面在localStorage上存储了数据，那么另外一个标签页就会接收到一个存储事件。要记住的是sessionStorage的作用域是限制在顶层窗口的，因此对sessionStorage的改变只有当有相牵连的窗口的时候才会触发存储事件。还有要注意的是，只有当存储数据真正发生改变的时候才会触发存储事件。像给已经存在的存储项设置一个一摸一样的值，抑或是删除一个本来就不存在的存储项都是不会触发存储事件的。

为存储事件注册处理程序可以通过addEventListener()方法（或者在IE下使用attachEvent()方法）。在绝大数浏览器中，还可以使用给Window对象设置onstorage属性的方式，不过Firefox不支持该属性。

与存储事件相关的事件对象有5个非常重要的属性（遗憾的是，IE8不支持它们）：

key：被设置或者移除的项的名字或者键名。如果调用的是clear()函数，那么该属性值为null。
newValue：保存到该项的新值；或者调用removeItem()时，该属性值为null。
oldValue：改变或者删除该项前，保存该项原先的值；当插入一个新项的时候，该属性值为null。
storageArea：这个属性值就好比是目标Window对象上的localStorage属性或者是sessionStorage属性。
url：触发该存储变化脚本所在的文档URL。

最后要注意的是：localStorage和存储事件都是采用广播机制的，浏览器会对目前正在访问的同样站点的所有窗口发消息。举个例子，如果一个用户要求网站停止动画效果，那么站点可能会在localStorage中存储该用户的首选项，这样依赖，以后再访问该站点的时候就自动停止动画效果了。因为存储了该首选项，导致了触发一个存储事件让其他展现统一站点的窗口也获得了这样的一个用户请求。再比如，一个基于Web的图片编辑应用，通常允许在其他窗口中展现工具条。当用户选择一个工具的时候，应用就可以使用localStorage来存储当前的状态，然后通知其他窗口用户选择了新的工具。

**20.2 cookie**

cookie是指Web浏览器存储的少量数据，同时它是与具体的Web页面或者站点相关的。cookie最早是设计为被服务端所用的，从最底层来看，作为HTTP协议的一种扩展实现它。cookie数据会自动在Web浏览器和Web服务器之间传输的，因此服务端脚本就可以读、写存储在客户端的cookie的值。本节将介绍客户端的脚本如何通过使用Document对象的cookie属性实现对cookie的操作。

为什么叫cookie，cookie这个名字没有太多的含义，但是在计算机历史上其实很早就用到它了。cookie和magic cookie用于代表少量数据，特别是指类似密码这种用于识别身份或者可访问的保密数据。在JavaScript中，cookie用于保存状态以及能够为Web浏览器提供一种身份识别机制。但是，JavaScript中使用cookie不会采用加密机制，因此它们是不安全的。（但是，通过https来传输cookie数据是安全的，不过这和cookie本身无关，而和https协议相关。）

操作cookie的API很早就已经定义和实现了，因此该API的兼容性很好。但是，该API几乎形同虚设。根本就没有提供诸如查询、设置、删除cookie的方法，所有这些操作都要通过以特殊格式的字符串形式读写Document对象的cookie属性来完成。每个cookie的有效期和作用域都可以通过cookie属性来分别指定。这些属性也是通过在同一个cookie属性上以特殊格式的字符串来设定的。

本节剩余部分会解释如何通过cookie属性来指定cookie的有效期和作用域，以及如何通过JavaScript来设置和查询cookie的值。最后，将以一个“实现基于cookie的存储机制API”例子来结束本节的介绍。

检测cookie是否启用：由于滥用第三方cookie（第三方cookie指的是来自于当前访问站点以为的站点设置的cookie）（如：cookie是和网页上的图片相关而非网页本身相关）的缘故，导致cookie在大多数Web用户心目中都留下了很不好的印象。比如，广告公司可以利用第三方cookie来实现跟踪用户的访问行为和习惯，而用户为了禁止这种“窥探”用户隐私的行为会在它们的浏览器中禁用cookie。因此，在JavaScript代码中使用cookie前，首先要确保cookie是启用的。在绝大多数浏览器中，可以通过检测navigator.cookieEnabled这个属性实现。若该值为true，则当前cookie是启用的；反之则是禁用的（但是，只具备“当前浏览会话生命周期”的非持久化cookie仍然是启用的）。但是，该属性不是一个标准的属性（不是所有的浏览器都支持的）。因此在不支持该属性的浏览器上，必须通过使用下面将要介绍的技术尝试着读、写和删除测试cookies数据来测试是否支持cookie。

**20.2.1 cookie属性：有效期和作用域**

除了名（name）和值（value），cookie还有一些可选的属性来控制cookie的有效期和作用域。cookie默认的有效期很短暂，它只能持续在Web浏览器的会话期间，一旦用户关闭浏览器，cookie保存的数据就丢失了。要注意的是：这与sessionStorage的有效期还是有区别的：cookie的作用域并不是局限在浏览器的单个窗口中，它的有效期和整个浏览器进程而不是单个浏览器的窗口的有效期一致。如果想要延长cookie的有效期，可以通过设置max-age属性，但是必须要明确告诉浏览器cookie的有效期是多长（单位是秒）。一旦设置了有效期，浏览器就会将cookie数据存储在一个文件中，并且直到过了指定的有效期才会删除该文件。

和localStorage和sessionStorage类似，cookie的作用域是通过文档源和文档路径来确定的。该作用域通过cookie的path和domain属性也是可配置的。默认情况下，cookie和创建它的Web页面有关，并对该Web页面以及和该Web页面同目录或者子目录的其他Web页面可见。比如，Web页面```http://www.example.com/catalog/index.html```页面创建了一个cookie，那么该cookie对```http://www.example.com/catalog/order.html```页面和```http://www.example.com/catalog/widgets/index.html```页面都是可见的，但它对```http://www.example.com/about.html```页面不可见。

默认的cookie的可见性行为满足了最常见的需求。不过，有的时候，你可能希望让整个网站都能够使用cookie的值，而不管是哪个页面创建它的。比方说，当用户在一个页面表单中输入了他的邮件地址，你想将它保存下来，为了下次该用户回到这个页面填写表单，或者在网站其他页面的任何地方要求输入账单地址的时候，将其作为默认的邮件地址。要满足这样的需求，可以设置cookie的路径（设置cookie的path属性）。

这样一来，来自同一个Web服务器的Web页面，只要其URL是以指定的路径前缀开始的，都可以共享cookie。例如，如果```http://www.example.com/catalog/widgets/index.html```页面创建了一个cookie，并且将该路径设置成“/catalog”，那么该cookie对于```http://www.example.com/catalog/order.html```页面也是可见的。或者，如果把路径设置成“/”，那么该cookie对任何```http://www.example.com```这台服务器上的页面都是可见的。

将cookie的路径设置为“/”，等于是让cookie和localStorage拥有同样的作用域，同时当它请求站点上任何一个Web页面的时候，浏览器都必须将cookie的名字和值传递给服务器。但是，要注意的是，cookie的path属性不能被用做访问控制机制。如果一个Web页面想要读取同一站点其他页面的cookie，只要简单地将其他页面以隐藏iframe的形式加载进来，随后读取对应文档的cookie就可以了。同源策略（参见13.6.2节）限制了跨站的cookie窥探，但是对于同一站点的文档它是完全合法的。

cookie的作用域默认由文档源限制的。但是，有的大型网站想要子域之间能够互相共享cookie。比如，order.example.com下的服务器想要读取catalog.example.com域下设置的cookie值。这个时候就需要通过设置cookie的domain属性来达到目的。如果catalog.example.com域下的一个页面创建了一个cookie，并将其path属性设置为“/”，其domain属性设置为“.example.com”，那么该cookie就对所有catalog.example.com、orders.example.com以及任何其他example.com域下的任何其他服务器都可见。如果没有为一个cookie设置域属性，那么domain属性的默认值是当前Web服务器的主机名。要注意的是，cookie的域只能设置为当前服务器的域。

最后要介绍的cookie属性是secure，它是一个布尔类型的属性，用来表明cookie的值以何种形式通过网络传递。cookie默认是以不安全的形式（通过普通的、不安全的HTTP连接）传递的。而一旦cookie被标识为“安全的”，那就只能当浏览器和服务器通过HTTPS或者其他安全协议连接的时候才能传递它。

**20.2.2 保存cookie**

要给当前文档设置默认有效期的cookie值，非常简单，只须将cookie属性设置为一个字符串形式的值：```name=value```

如下所示：
```javascript
document.cookie = "version=" + encodeURIComponent(document.lastModified);
```

下次读取cookie属性的时候，之前存储的名/值对的数据就在文档的cookie列表中。由于cookie的名/值中的值是不允许包含分号、逗号和空白符，因此，在存储前一般可以采用JavaScript核心的全局函数encodeURIComponent()对值进行编码。相应的，读取cookie值的时候需要采用decodeURIComponent()函数解码。

以简单的名/值对形式存储的cookie数据有效期只在当前Web浏览器的会话内，一旦用户关闭浏览器，cookie数据就丢失了。如果想要延长cookie的有效期，就需要设置max-age属性来指定cookie的有效期（单位是秒）。按照如下的字符串形式设置cookie属性即可：```name=value;max-age=seconds```

下面函数用来设置一个cookie值，同时提供了一个可选的max-age属性：
```javascript
// 以名/值对的形式存储cookie值
// 同时采用encodeURIComponent()函数进行编码，来转义分号、逗号和空白符
// 如果daysToLive是一个数字，设置max-age属性为该数值表示cookie直到指定的天数
// 到了才会过期。如果daysToLive是0就表示删除cookie
function setcookie(name, value, daysToLive) {
    var cookie = name + "=" + encodeURIComponent(value);
    if(typeof daysToLive == "number") {
        cookie += ";max-age=" + (daysToLive*60*60*24);
    }
    document.cookie = cookie;
}
```
同样地，如果要设置cookie的path、domain和secure属性，只须在存储cookie值前，以如下字符串形式追加在cookie值的后面：```;path=path;domain=domain;secure```

要改变cookie的值，需要使用相同的名字、路径和域，但是新的值重新设置cookie的值。同样地，设置新max-age属性就可以改变原来的cookie的有效期。

要删除一个cookie，需要使用相同的名字、路径和域，然后指定一个任意（非空）的值，并且将max-age属性指定为0，再次设置cookie。

**20.2.3 读取cookie**

使用JavaScript表达式来读取cookie属性的时候，其返回的值是一个字符串，该字符串都是由一系列名/值对组成，不同名/值对之间通过“分号和空格”分开，其内容包含了所有作用在当前文档的cookie。但是，它并不包含其他设置的cookie属性。通过document.cookie属性可以获取cookie值，但是为了更好地查看cookie的值，一般会采用split()方法将cookie值中的名/值对都分离出来。

把cookie的值从cookie属性分离出来之后，必须要采用相应的解码方式（取决于之前存储cookie值时采用的编码方式），把值还原出来。比如，先采用decodeURIComponent()方法把cookie值解码出来，之后再利用JSON.parse()方法转化成json对象。

例20-1定义了一个getcookie()函数，该函数将document.cookie属性的值解析出来，将对应的名/值对存储到一个对象中，函数最后返回该对象。

例20-1：解析document.cookie属性值
```javascript
// 将document.cookie的值以名/值对组成的一个对象返回
// 假设存储cookie的值的时候是采用encodeURIComponent()函数编码的
// Return the document's cookies as an object of name/value pairs.
// Assume that cookie values are encoded with encodeURIComponent().
function getCookies() {
    // The object we will return 初始化最后要返回的对象
    var cookies = {};          
    // Get all cookies in one big string 在一个大写字符串中获取所有的cookie值
    var all = document.cookie;
    // If the property is the empty string 如果该cookie属性值为空字符串
    if (all === "")             
        return cookies;         // return an empty object 返回一个空对象
    // Split into individual name=value pairs 分离出名/值对
    var list = all.split("; "); 
    for(var i = 0; i < list.length; i++) {  // For each cookie 遍历每个cookie
        var cookie = list[i];
        // Find the first = sign 查找第一个等号
        var p = cookie.indexOf("=");
        var name = cookie.substring(0,p);   // Get cookie name 获取cookie名字
        // Get cookie value 获取cookie对应的值
        var value = cookie.substring(p+1);
        value = decodeURIComponent(value);  // Decode the value 对其值进行解码
        // Store name and value in object 将名/值对存储到对象中
        cookies[name] = value;
    }
    return cookies;
}
```

**20.2.5 cookie相关的存储**

例20-2展示了如何实现基于cookie的一系列存储API方法。该例定义了一个cookieStorage函数（被实例化的时候具有构造函数特性），通过将max-age和path属性传递给该构造函数，就会返回一个对象，然后就可以像使用localStorage或者sessionStorage一样来使用这个对象了。但是要注意的是，该例并没有实现存储事件，因此，当设置和查询cookieStorage对象的属性的时候，不会实现自动保存和获取对应的值。

例20-2：实现基于cookie的存储API
```javascript
/*
 * CookieStorage.js
 * This class implements the Storage API that localStorage and sessionStorage
 * do, but implements it on top of HTTP Cookies.
 * 本类实现像localStorage和sessionStorage一样的存储API，不同的是基于HTTPcookie实现它
 */
// Arguments specify lifetime and scope 两个参数分别代表存储有效期和作用域
function CookieStorage(maxage, path) {

    // Get an object that holds all cookies
    // 获取一个存储全部cookie信息的对象
    // The getCookies() function shown earlier 类似之前介绍的getcookie()函数
    var cookies = (function() {
        // The object we will return 该对象最终会返回
        var cookies = {};
        // Get all cookies in one big string 以大字符串的形式获取所有cookie信息
        var all = document.cookie;
        // If the property is the empty string 如果该属性为空字符串
        if (all === "") {
            // return an empty object 返回一个空对象 
            return cookies;
        }
        // Split into individual name=value pairs 分离出名/值对
        var list = all.split("; ");
        // For each cookie 遍历每个cookie
        for(var i = 0; i < list.length; i++) {
            var cookie = list[i];
            // Find the first = sign 查找第一个“=”符号
            var p = cookie.indexOf("=");
            // Get cookie name 获取cookie名字
            var name = cookie.substring(0,p);
            // Get cookie value 获取cookie对应的值
            var value = cookie.substring(p+1);
            // Decode the value 对其值进行解码
            value = decodeURIComponent(value);
            // Store name and value 将名值对存储到对象中
            cookies[name] = value;
        }
        return cookies;
    }());

    // Collect the cookie names in an array 将所有cookie的名字存储到一个数组中
    var keys = [];
    for(var key in cookies) {
        keys.push(key);
    }
    // Now define the public properties and methods of the Storage API
    // 现在定义存储API的公共的属性和方法
    // The number of stored cookies 存储的cookie的个数
    this.length = keys.length;
    // Return the name of the nth cookie, or null if n is out of range
    // 返回第n个cookie的名字，如果n越界则返回null
    this.key = function(n) {
        if (n < 0 || n >= keys.length) return null;
        return keys[n];
    };
    // Return the value of the named cookie, or null.
    // 返回指定名字的cookie值，如果不存在则返回null
    this.getItem = function(name) { return cookies[name] || null; };
    // Store a value 存储cookie值
    this.setItem = function(key, value) {
        // If no existing cookie with this name 如果要存储的cookie还不存在
        if (!(key in cookies)) {
            // Add key to the array of keys
            // 将指定的名字加入到存储所有cookie名的数组中
            keys.push(key);
            // And increment the length cookie个数加一
            this.length++;
        }
        // Store this name/value pair in the set of cookies.
        // 将名/值对数据存储到cookie对象中
        cookies[key] = value;
        // Now actually set the cookie.
        // 开始正式设置cookie
        // First encode value and create a name=encoded-value string
        // 首先将要存储的cookie的值进行编码，同时创建一个”名字=编码后的值“形式的字符串
        var cookie = key + "=" + encodeURIComponent(value);
        // Add cookie attributes to that string
        // 将cookie的属性也加入到该字符串中
        if (maxage) cookie += "; max-age=" + maxage;
        if (path) cookie += "; path=" + path;
        // Set the cookie through the magic document.cookie property
        // 通过document.cookie属性来设置cookie
        document.cookie = cookie;
    };
    // Remove the specified cookie
    // 删除指定的cookie
    this.removeItem = function(key) {
        // If it doesn't exist, do nothing
        // 如果cookie不存在，则什么也不做
        if (!(key in cookies)) return;
        // Delete the cookie from our internal set of cookies
        // 从内部维护的cookie组删除指定的cookie
        delete cookies[key];
        // And remove the key from the array of names, too.
        // 同时将cookie中的名字也在内部的数组中删除
        // This would be easier with the ES5 array indexOf() method.
        // 如果使用ES5定义的数组indexOf()方法会更加简单
        // Loop through all keys 遍历所有名字
        for(var i = 0; i < keys.length; i++) {
            // When we find the one we want 当我们找到了要找的那个
            if (keys[i] === key) {
                // Remove it from the array. 将它从数组中删除
                keys.splice(i,1);
                break;
            }
        }
        // Decrement cookie length cookie个数减一
        this.length--;

        // Finally actually delete the cookie by giving it an empty value
        // and an immediate expiration date.
        // 最终通过将该cookie值设置为空字符串以及将有效期设置为0来删除指定的cookie
        document.cookie = key + "=; max-age=0";
    };

    // Remove all cookies 删除所有的cookie
    this.clear = function() {
        // Loop through the keys, removing the cookies
        // 循环所有的cookie的名字，并将cookie删除
        for(var i = 0; i < keys.length; i++)
            document.cookie = keys[i] + "=; max-age=0";
        // Reset our internal state 重置所有的内部状态
        cookies = {};
        keys = [];
        this.length = 0;
    };
}

```

**20.3 利用ie userdata持久化数据**

**20.4 应用程序存储和离线web应用**

HTML5中新增了“应用程序缓存”，允许Web应用将应用程序自身本地保存到用户的浏览器中。不像localStorage和sessionStorage只是保存Web应用程序相关的数据，它是将应用程序自身保存起来——应用程序所需运行的所有文件（HTML、CSS、JavaScript、图片等）。“应用程序缓存”和一般的浏览器缓存不同：它不会随着用户清除浏览器缓存而被清除。同时，缓存起来的应用程序也不会像一般固定大小的缓存那样，老数据会被最近一次访问的新数据代替掉。它其实不是临时存储在缓存中：应用程序更像是被“安装”在那里，除非被用户”卸载“或者“删除”它们，否则它们就会一直“驻扎”在那里。所以，总的来说，“应用程序缓存”在真正意义上不是缓存，更好的说法应该称之为“应用程序存储”。

让Web应用能够实现“本地安装”的目的是要保证它们能够在离线状态（比如，当在飞机上或者手机没信号的时候）下依然可访问。将自己“安装”到应用程序缓存中的Web应用，在离线状态下使用localStorage来保存应用相关的数据，同时还具备一套同步机制，在再次回到在线状态的时候，能够将存储的数据传输给服务器。在20.4.3节我们会看到一个离线Web应用的例子。不过，在这之前，先来介绍下应用程序是如何将自己“安装”到应用程序缓存中的。

**20.4.1 应用程序缓存清单**

想要将应用程序“安装”到应用程序缓存中，首先要创建一个清单：包含了所有应用程序依赖的所有URL列表。然后，通过在应用程序主HTML页面的html标签中设置manifest属性，指向到该清单文件就可以了：
```
<!DOCTYPE html>
<html manifest="myapp.appcache">
<head>...</head>
<body>...</body>
</html>
```

清单文件中的首行内容必须以“CACHE MANIFEST”字符串开始。其余就是要缓存的文件URL列表，一行一个URL。相对路径的URL都相对于清单文件的URL。会忽略内容中的空行，会作为注释而忽略以“#”开始的行。注释前面可以有空格，但是在同一行注释后面是不允许有非空字符的。如下所示是一个简单的清单文件：
```
CACHE MANIFEST
# 上一行标识此文件是一个清单文件。本行是注释

# 下面的内容都是应用程序依赖的资源文件的URL
myapp.html
myapp.js
myapp.css
images/background.png
```

缓存清单的MIME类型：应用程序缓存清单文件约定以```.appcache```作为文件扩展名。但是，这也仅仅只是约定而已，Web服务器真正识别清单文件的方式是通过“text/cache-manifest”这个MIME类型的一个清单。如果服务器将清单文件的Content-Type的头信息设置成其他MIME类型，那么就不会缓存应用程序了。因此，可能需要对Web服务器做一定的配置来使用这个MIME类型，比如，在Web应用目录下创建Apache服务器的一个.htaccess文件。

清单文件包含要缓存的应用的标识。如果一个Web应用有很多Web页面（用户可以访问多个HTML页面），那么每个HTML页面就需要设置```<html manifest>```属性来指向清单文件。事实上，将这些不同的页面都指向同一个清单文件，可以很清楚地表达出它们都是需要缓存起来的，同时它们又是来自同一个Web应用的。如果一个应用只有少量的HTML页面，那么一般会把这些页面都显式地列在清单文件中。但这不是强制的：会认为任何链接到清单文件的文件都是Web应用的一部分，并会随着应用一起缓存起来。

像之前提到的，一个简单的清单必须列出Web应用依赖的所有资源。一旦一个Web应用首次下载下来并缓存，之后的任何加载请求就都来自缓存。从缓存中去载入一个应用资源的时候，就要求它请求的任何资源务必要在清单中。不会载入不在清单中的资源。这种政策有点离线的味道。如果一个简单的缓存起来的应用能够从缓存中载入并运行，那么它也可以在浏览器的离线状态下运行。通常情况下，很多复杂的Web应用无法将它们依赖的所有资源缓存起来。但是，如果它们同时也有一个复杂的清单的话，它们仍然可以使用应用程序缓存。

复杂的清单：

一个应用从应用程序缓存中载入的时候，只有其清单文件中列举出来的资源文件会载入。前面例子中的清单文件一次列举一个资源的URL。事实上，清单文件还有比这更复杂的语法，列举资源的方式也还有另外两种。在清单文件中可以使用特殊的区域头（类似于HTTP头）来标识该头信息之后清单项的类型。像该例中列举的简单缓存项事实上都属于“CACHE:”区域，这也是默认的区域。另外两种区域是以“NETWORK:”和“FALLBACK:”头信息开始的（一个清单可以有任意数量的区域，而且在相邻两个区域之间可以根据需要相互切换）。
“NETWORK:”区域标识了该URL中的资源从不缓存，总要通过网络获取。通常，会将一些服务端的脚本资源放在“NETWORK:”区域中，而实际上该区域中的资源的URL都只是URL前缀，用来表示以此URL前缀开头的资源都应该要通过网络加载。当然，如果浏览器处于离线状态，那么这些资源都将获取失败。“NETWORK:”区域中的URL还支持“*”通配符。该通配符表示对任何不在清单中的资源，浏览器都将通过网络加载。这实际上违背了这样一条规则：缓存应用程序必须要在清单中列举所有应用相关的资源！
“FALLBACK:”区域中的清单项每行都包含两个URL。第二个URL是指需要加载和存储在缓存中的资源，第一个URL是一个前缀。任何能够匹配到该前缀的URL都不会缓存起来，但是可能的话，它们会从网络中载入。如果网络中载入这样一个URL失败的话，就会使用第二个URL指定的缓存资源来代替，从缓存中获取。想象一个Web应用包含一定数量的视频教程。这些视频都很大，显然把它们缓存到本地是不合适的。因此，在离线状态下，通过清单文件中的fallback区域，就可以使用一些机遇文本的帮助文件来代替了。

下面是一个更加复杂的的缓存清单：
```
CACHE MANIFEST

CACHE:
myapp.html
myapp.css
myapp.js

FALLBACK:
videos/ offline_help.html

NETWORK:
cgi/
```

**20.4.2 缓存的更新**

当一个Web应用从缓存中载入的时候，所有与之相关的文件也是直接从缓存中获取。在线状态下，浏览器会异步地检查清单文件是否有更新。如果有更新，新的清单文件以及清单中列举的所有文件都会下载下来重新保存到应用程序缓存中。但是，要注意的是，浏览器只是检查清单文件，而不会去检查缓存的文件是否有更新：只检查清单文件。比如，如果修改了一个缓存的JavaScript文件，并且要想让该文件生效，就必须去更新下清单文件。由于应用程序依赖的文件列表其实并没有变化，因此最简单的方式就是更新版本号：
```
CACHE MANIFEST
# MyApp version 1（更改这个数字以便让浏览器重新下载这个文件）
MyApp.html
MyApp.js
```

同样，如果想要让Web应用从缓存中“卸载”，就要在服务端删除清单文件，使得请求该文件的时候返回HTTP 404无法找到的错误，同时，修改HTML文件以便他们与该清单列表“断开链接”。

要注意的是，浏览器检查清单文件以及更新缓存的操作是异步的，可能是在从缓存中载入应用之前，也有可能同时进行。因此，对于简单的Web应用而言，在更新清单文件之后，用户必须载入应用两次才能保证最新的版本生效：第一次是从缓存中载入老版本随后更新缓存，第二次才从缓存中载入最新的版本。

浏览器在更新缓存过程中会触发一系列事件，可以通过注册处理程序来跟踪这个过程同时提供反馈给用户。如下例所示：
```javascript
applicationCache.onupdateready = function() {
    var reload = confirm("A new version of this application is available\n" 
                        + "and will be used the next time you reload.\n"
                        + "Do you want to reload now?");
    if(reload) {
        location.reload();
    }
}
```

要注意的是，该事件处理程序是注册在ApplicationCache对象上的，该对象是Window的applicationCache属性的值。支持应用程序缓存的浏览器会定义该属性。此外，除了上面例子中的updateready事件之外，还有其他7种应用程序缓存事件可以监控。例20-4展示了一个简单的处理程序通过显示对应的消息来通知用户缓存更新的进度，以及当前缓存的状态。
例20-4：处理应用缓存相关事件
```javascript
// The event handlers below all use this function to display status messages.
// Since the handlers all display status messages this way, they return false
// to cancel the event and prevent the browser from displaying its own status.
// 下面所有的事件处理程序都使用此函数来显示状态消息
// 由于都是通过调用status函数来显示状态，因此所有的处理程序都返回false来阻止浏览器
// 显示其默认状态消息
function status(msg) {
    // Display the message in the document element with id "statusline"
    // 将消息输出到id为“statusline”的文档元素中
    document.getElementById("statusline").innerHTML = msg;
    // And also in the console for debugging 同时在控制台输出此消息，便于调试
    console.log(msg);
}

// Each time the application is loaded, it checks its manifest file.
// The checking event is always fired first when this process begins.
// 每当应用程序载入的时候，都会检查该清单文件
// 也总会首先触发“checking”事件
window.applicationCache.onchecking = function() {
    status("Checking for a new version.");
    return false;
};

// If the manifest file has not changed, and the app is already cached,
// the noupdate event is fired and the process ends.
// 如果清单文件没有改动，同时应用程序也已经缓存了
// “noupdate”事件会被触发，整个过程结束
window.applicationCache.onnoupdate = function() {
    status("This version is up-to-date.")
    return false;
};

// If the application is not already cached, or if the manifest has changed,
// the browser downloads and caches everything listed in the manifest.
// The downloading event signals the start of this download process.
// 如果还未缓存应用程序，或者清单文件有改动
// 那么浏览器会下载并缓存清单中的所有资源
// 触发"downloading"事件，同时意味着下载过程开始
window.applicationCache.ondownloading = function() {
    status("Downloading new version");
    // Used in the progress handler below 在下面的“progress”事件处理程序会用到
    window.progresscount = 0;
    return false;
};

// progress events are fired periodically during the downloading process,
// typically once for each file downloaded. 
// 在下载过程中会间断性地触发“progress”事件
// 通常是在每个文件下载完毕的时候
window.applicationCache.onprogress = function(e) {
    // The event object should be a progress event (like those used by XHR2)
    // that allows us to compute a completion percentage, but if not,
    // we keep count of how many times we've been called.
    // 事件对象应当是“progress”事件（就像那些被XHR2使用的），
    // 通过该对象可以计算出下载完成比例，但是，如果它不是“progress”事件，
    // 我们统计调用的次数
    var progress = "";
    // Progress event: compute percentage
    // “progress”事件：计算下载完成比例
    if (e && e.lengthComputable) {
        progress = " " + Math.round(100*e.loaded/e.total) + "%"
    }
    // Otherwise report # of times called 否则，输出调用次数
    else {
        progress = " (" + ++progresscount + ")";
    }
    status("Downloading new version" + progress);
    return false;
};

// The first time an application is downloaded into the cache, the browser
// fires the cached event when the download is complete.
// 当下载完成并且首次将应用程序下载到缓存中时，浏览器会触发“cached”事件
window.applicationCache.oncached = function() {
    status("This application is now cached locally");
    return false;
};

// When an already-cached application is updated, and the download is complete
// the browser fires "updateready". Note that the user will still be seeing
// the old version of the application when this event arrives.
// 当下载完成并将缓存中的应用程序更新后，浏览器会触发“updateready”事件
// 要注意的是：触发此事件的时候，用户仍然可以看到老版本的应用程序
window.applicationCache.onupdateready = function() {
    status("A new version has been downloaded.  Reload to run it");
    return false;
};

// If the browser is offline and the manifest cannot be checked, an "error"
// event is fired. This also happens if an uncached application references
// a manifest file that does not exist
// 如果浏览器处于离线状态，检查清单列表失败，则会触发“error”事件
// 当一个未缓存的应用程序引用一个不存在的清单文件，也会触发此事件
window.applicationCache.onerror = function() {
    status("Couldn't load manifest or cache application");
    return false;
};

// If a cached application references a manifest file that does not exist,
// an obsolete event is fired and the application is removed from the cache.
// Subsequent loads are done from the network rather than from the cache.
// 如果一个缓存的应用程序引用一个不存在的清单文件
// 会触发“obsolete”事件，同时会将应用从缓存中移除
// 之后都不会从缓存而是通过网络来加载资源
window.applicationCache.onobsolete = function() {
    status("This application is no longer cached. " + 
           "Reload to get the latest version from the network.");
    return false;
};
```

每次载入一个设置了manifest属性的HTML文件，浏览器都会触发“checking”事件，并通过网络载入该清单文件。不过之后，会随着不同的情况触发不同的事件。

没有可用的更新：如果应用程序已经缓存并且清单文件没有改动，则浏览器会触发“noudpate”事件。

有可用的更新：如果应用程序已经缓存了并且清单文件发生了改动，则浏览器会触发“downloading”事件，并开始下载和缓存清单文件中列举的所有资源。随着下载过程的进行，浏览器还会触发“progress”事件，在下载完成后，会触发“updateready”事件。

首次载入新的应用程序：如果还未缓存应用程序，如上所述，“downloading”事件和“progress”事件都会触发。但是，当下载完成后，浏览器会触发“cached”事件而不是“udpateready”事件。

浏览器处于离线状态：如果浏览器处于离线状态，它无法检查清单文件，同时它会触发“error”事件。如果一个未缓存的应用程序引用一个不存在的清单文件，浏览器也会触发该事件。

清单文件不存在：如果浏览器处于在线状态，应用程序也已经缓存起来了，但是清单文件不存在（返回404无法找到错误），浏览器会触发“obsolete”事件，并将应用程序从缓存中移除。

除了使用事件处理程序之外，还可以使用applicationCache.status属性来查看当前缓存状态。该属性有6个可能的属性值：

ApplicationCache.UNCACHED（0）
应用程序没有设置manifest属性：未缓存

ApplicationCache.IDLE（1）
清单文件已经检查完毕，并且已经缓存了最新的应用程序

ApplicationCache.CHECKING（2）
浏览器正在检查清单文件

ApplicationCache.DOWNLOADING（3）
浏览器正在下载并缓存清单中列举的所有文件

ApplicationCache.UPDATEREADY（4）
已经下载和缓存了最新版的应用程序

ApplicationCache.OBSOLETE（5）
清单文件不存在，缓存将被清除

ApplicationCache对象还定义了两个方法：update()方法显式调用了更新缓存算法以检测是否有最新版本的应用程序。这导致浏览器检测同一个清单文件（并触发相同的事件），这和第一次载入应用程序时的效果是一样的。

还有一个方法是swapCache()，该方法更加巧妙。还记得当浏览器下载并缓存更新版本的应用时，用户仍然在运行老版本的应用吧。只有当用户再次载入应用时，才会访问到最新版本。但是如果用户没有重新载入，就必须要保证老版本的应用也要工作正常。同时要注意的是，老版本应用程序的相关资源可能是从缓存中加载的：比如，应用程序可能使用XMLHttpRequest去获取文件，而这些请求也务必要保证能够从老版本缓存中的文件获取到。因此，浏览器在用户再次载入应用前必须在缓存中保留老版本的应用。

swapCache()方法告诉浏览器它可以弃用老的缓存，所有的请求都从新缓存中获取。要注意的是，这并不会重新载入应用程序：所有已经载入的HTML文件、图片、脚本等资源都不会改变。但是，之后的请求都将从最新的缓存中获取。这会导致“版本错乱”的问题，因此，一般不推荐使用，除非应用设计得很好，确保这样的方式没有问题。想象下，比方说，有这么个应用程序，它什么也不做，就只是在浏览器检查清单文件的整个过程中，显示过渡画面（类似于loading图）。触发“noupdate”事件时，它继续“前进”并载入应用程序的首页。触发“downloading”事件，并且更新缓存后，它显示合适的反馈给用户。触发“updateready”事件时，它调用swapCache()方法，然后从最新的缓存中载入更新过的首页。

更注意的是，只有当状态属性是ApplicationCache.UPDATEREADY或者ApplicationCache.OBSOLETE时，调用swapCache()方法才有意义（当状态是OBSOLETE时，调用swapCache()方法可以立即弃用废弃的缓存，让之后所有的请求都通过网络获取）。如果在状态属性是其他数值的时候调用swapCache()方法，它就会抛出异常。

第21章 多媒体和图形编程
----------------------
**21.1脚本化图片**
**21.2脚本化音频和视频**
**21.3svg:可伸缩的矢量图形**
**21.4[canvas]中的图形**

第22章 HTML5 API
----------------

**22.1地理位置**

**22.2历史纪录管理**

**22.3跨域消息传递**

**22.4web worker**

**22.5类型化数组和arraybuffer**

**22.6blob**

**22.7文件系统api**

**22.8客户端数据库**

**22.9web套接字**

第18章介绍过客户端javascript代码如何通过网络进行通信。该章中的例子都使用http协议，这也意味着它们受限于http协议的特性：它是一种无状态的协议，由客户端请求和服务端响应组成。http实际上是相对比较特殊的网络协议。大多数基于因特网（或者局域网）的网络连接通常都包含长连接和基于tcp套接字的双向消息交换。让不信任的客户端脚本访问底层的tcp套接字是不安全的，但是WebSocket API定义了一种安全方案：它允许客户端代码在客户端和支持websocket协议的服务器端创建双向的套接字类型的连接。这让某些网络操作会变得更加简单。
要通过使用javascript使用websocket，只须了解这里要介绍的websocket api。其中并没有用于书写一个websocket服务器的服务器端api，但是本节会有一个简单服务器例子，该例子使用node（见12.2节）和第三方的websocket服务器库来实现。客户端和服务器端的通信是通过tcp套接字长连接实现的，其遵循websocket协议定义的规则。关于websocket协议的细节这里不做详细介绍，但是，值得注意的是，websocket是经过精心设计的协议，实现让web服务器能够很容易地同时处理同一端口上的http连接和websocket连接。
很多浏览器提供商都实现了websocket。但是，由于发现早期草案版本的websocket协议有重要的安全漏洞，因此，一直到撰写本书时，有些浏览器在安全版本的协议未标准化之前，都将它们支持的websocket功能关闭了。比如，在firefox4中，要启用websocket功能，需要访问about:config页面，然后将配置变量“network.websocket.override-security-block”设置为true。

websocket api的使用非常简单。首先，通过websocket()构造函数创建一个套接字：

    var socket = new WebSocket("ws://ws.example.com:1234/resource");
    
创建了套接字之后，通常需要在上面注册一个事件处理程序：
```javascript
    socket.onopen = function(e){/*套接字已经连接*/};
    socket.onclose = function(e){/*套接字已经关闭*/};
    socket.onerror = function(e){/*出错了*/};
    socket.onmessage = function(e){
        var message = e.data;/*服务器发送一条消息*/
    };
```
为了通过套接字发送数据给服务器，可以调用套接字的send()方法：
```javascript
    socket.send("hello,server");
```
当前版本的websocket api仅支持文本消息，并且必须以UTF-8编码形式的字符串传递给该消息。然而，当前websocket协议还包含对二进制消息的支持，未来版本的api可能会允许在客户端和websocket服务器端进行二进制数据的交换。
当完成和服务器的通信之后，可以通过调用close方法来关闭websocket。
websocket完全是双向的，并且一旦建立了websocket连接，客户端和服务器端都可以在任何时候互相传送消息，与此同时，这种通信机制采用的不是请求和响应的形式。每个基于websocket的服务都要定义自己的“子协议”，用于在客户端和服务器端传输数据。慢慢的，这些“子协议”也可能发生演变，可能最终要求客户端和服务器端需要支持多个版本的子协议。幸运的是，websocket协议包含一种协商机制，用于选择客户端和服务器端都能“理解”的子协议。可以传递一个字符串数组给WebSocket()构造函数。服务器端会将该数组作为客户端能够理解的子协议列表。然后，它会选择其中一个使用，并将它传递给客户端。一旦连接建立之后，客户端就能够通过套接字protocol属性监测当前在使用的是哪种子协议。

1.8节介绍了EventSource API，并通过一个在线聊天的客户端和服务器展示了这些api如何使用。有了websocket，写这类应用就变得更加容易了。例22-16就是一个简单的聊天客户端：它和例18-5很像，不同的是它采用了websocket来实现双向通信，而没有使用EventSource来获取消息以及XMLHttpRequest来发送消息。

例22-16：基于WebSocket的聊天客户端：

```javascript
window.onload = function() {
    // Take care of some UI details，关心一些UI细节
    var nick = prompt("Enter your nickname");     // Get user's nickname，获取用户昵称
    var input = document.getElementById("input"); // Find the input field，查找input字段
    input.focus();                                // Set keyboard focus，设置光标
    // Open a WebSocket to send and receive chat messages on，打开一个websocket用于发送和接收聊天消息
    // Assume that the HTTP server we were downloaded from also functions as
    //假设下载的HTTP服务器作为websocket服务器运作，并且使用相同de主机名和端口
    // a websocket server, and use the same host name and port, but change
    //只是协议由http变成了ws
    // from the http:// protocol to ws://
    var socket = new WebSocket("ws://" + location.host + "/");
    // This is how we receive messages from the server through the web socket
    //下面展示了如何通过websocket从服务器获取消息
    socket.onmessage = function(event) {          // When a new message arrives，当收到一条消息
        var msg = event.data;                     // Get text from event object，从事件对象中获取消息内容
        var node = document.createTextNode(msg);  // Make it into a text node，将它标记为一个文本节点
        var div = document.createElement("div");  // Create a <div>，创建一个div
        div.appendChild(node);                    // Add text node to div，将文本节点添加到该div
        document.body.insertBefore(div, input);   // And add div before input，在input前添加该div
        input.scrollIntoView();                   // Ensure input elt is visible，确保输入框可见
    }
    // This is how we send messages to the server through the web socket
    //下面展示了如何通过websocket发送消息给服务器端
    input.onchange = function() {                 // When user strikes return，当用户敲击回车键
        var msg = nick + ": " + input.value;      // Username plus user's input，用户昵称加上用户的输入
        socket.send(msg);                         // Send it through the socket，通过套接字传递该内容
        input.value = "";                         // Get ready for more input，等待更多内容的输入
    }
};
```

```
//The chat UI is just a single, wide text input field 
//聊天窗口UI很简单，一个宽的文本输入框
// New chat messages will be inserted before this element 
// 新的聊天消息会插入到该元素中
<input id="input" style="width:100%"/>
```


例22-17是一个基于websocket的聊天服务器，运行在node中（见12.2节）。通过将该例和例18-17作比较，可以发现，websocket将聊天应用的服务器端简化成和客户端一样。

例22-17：使用websocket和node的聊天服务器

```javascript
/*
 * This is server-side JavaScript, intended to be run with NodeJS.这是运行在nodejs上的服务器端javascript
 * It runs a WebSocket server on top of an HTTP server, using an external
 *在HTTP服务器之上，它运行一个websocket服务器，该服务器使用自https://github.com/miksago/node-websocket-server/的第三方websocket库实现
 * websocket library from https://github.com/miksago/node-websocket-server/
 * If it gets an  HTTP request for "/" it returns the chat client HTML file.
 *如果得到“／”的一个HTTP请求，则返回聊天客户端的HTML文件
 * Any other HTTP requests return 404. Messages received via the 
 *除此之外任何HTTP请求都返回404
 * WebSocket protocol are simply broadcast to all active connections.
 *通过websocket协议接收到的消息都仅广播给所有激活状态的连接
 */
var http = require('http');            // Use Node's HTTP server API，使用node的HTTP服务器api
var ws = require('websocket-server');  // Use an external WebSocket library，使用第三方websocket库

// Read the source of the chat client at startup. Used below.
//启动阶段，读取聊天客户端的资源文件
var clientui = require('fs').readFileSync("wschatclient.html");

// Create an HTTP server，创建一个HTTP服务器
var httpserver = new http.Server();  

// When the HTTP server gets a new request, run this function
//当HTTP服务器获得一个新请求时，运行此函数
httpserver.on("request", function (request, response) {
    // If the request was for "/", send the client-side chat UI.
    //如果请求“／”，则返回客户端聊天UI
    if (request.url === "/") {  // A request for the chat UI，请求聊天UI
        response.writeHead(200, {"Content-Type": "text/html"});
        response.write(clientui);
        response.end();
    }
    else {  // Send a 404 "Not Found" code for any other request，对任何其他的请求返回404无法找到编码
        response.writeHead(404);
        response.end();
    }
});

// Now wrap a WebSocket server around the HTTP server，在HTTP服务器上包装一个websocket服务器
var wsserver = ws.createServer({server: httpserver});

// Call this function when we receive a new connection request，当调用一个新的连接请求的时候，调用此函数
wsserver.on("connection", function(socket) {
    socket.send("Welcome to the chat room."); // Greet the new client，向新客户端打招呼
    socket.on("message", function(msg) {      // Listen for msgs from the client，监听来自客户端的消息
        wsserver.broadcast(msg);              // And broadcast them to everyone，并将它们广播给每个人
    });
});

// Run the server on port 8000. Starting the WebSocket server starts the
//在8000端口运行服务器。启动websocket服务器的时候也会启动HTTP服务器。
// HTTP server as well. Connect to http://localhost:8000/ to use it.
//连接到http://localhost:8000/，并开始使用它
wsserver.listen(8000);
```


第三部分 javascript核心参考
---------------------------
参考文档：包括javascript语言核心定义的类、方法和属性。


第四部分 客户端javascript核心参考
--------------------------------

javascript语言核心怎对文本、数组、日期和正则表达式的操作定义了很少的api，但是这些api不包括输入输出功能。输入和输出功能（类似网络、存储和图形相关的复杂特性）是由javascript所属的宿主环境提供的，这里所说的宿主环境通常是web浏览器，还有其他。
