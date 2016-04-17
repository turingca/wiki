#第二部分 客户端javascript

本书第二部分主要讲解javascript是如何在web浏览器中实现的，这些章节介绍了大量的脚本宿主对象，这些对象可以表示浏览器窗口、文档树和文档的内容等。这些章节同样涵盖重要的web应用所需的网络编程API、本地存储和检索数据、画图等。

第13章web浏览器中的javascript
-----------------------

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

对于


**13.4兼容性和互用性**
**13.5可访问性**
**13.6安全性**
**13.7客户端框架**

window对象
----------
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

